<?php
/**
 * Listing Model
 * 
 * Handles all database operations for the listing table and related tables.
 */

require_once dirname(__DIR__) . '/core/model.php';

class Listing extends Model
{
    protected string $table = 'listing';
    protected string $primaryKey = 'id';


    public function createListing(array $data): string
    {
        // Generate UUID if not provided
        if (!isset($data['id'])) {
            $data['id'] = $this->generateUuid();
        }
        
        // Set default status
        if (!isset($data['status'])) {
            $data['status'] = 'draft';
        }
        
        return $this->create($data);
    }


    public function getFullListing(string $id): ?array
    {
        $listing = $this->find($id);
        
        if (!$listing) {
            return null;
        }
        
        // Get related data
        $listing['images'] = $this->getImages($id);
        $listing['attributes'] = $this->getAttributes($id);
        $listing['services'] = $this->getServices($id);
        $listing['availability'] = $this->getAvailability($id);
        $listing['host'] = $this->getHost($listing['host_profile_id']);
        
        return $listing;
    }


    public function getListingWithHost(string $id): array|false
    {
        $sql = "SELECT l.*, 
                       p.first_name, p.last_name, p.phone, p.bio, p.city as host_city,
                       a.email as host_email
                FROM listing l
                LEFT JOIN user_profile p ON l.host_profile_id = p.id
                LEFT JOIN account a ON p.account_id = a.id
                WHERE l.id = ?";
        
        return $this->db->fetchOne($sql, [$id]);
    }


    public function getImages(string $listingId): array
    {
        $sql = "SELECT * FROM listing_image 
                WHERE listing_id = ? 
                ORDER BY position ASC";
        
        return $this->db->fetchAll($sql, [$listingId]);
    }


    public function addImage(string $listingId, string $imagePath, int $position): string
    {
        $id = $this->generateUuid();
        
        $this->db->insert('listing_image', [
            'id' => $id,
            'listing_id' => $listingId,
            'image' => $imagePath,
            'position' => $position,
        ]);
        
        return $id;
    }


    public function deleteImage(string $imageId): int
    {
        return $this->db->delete('listing_image', 'id = ?', [$imageId]);
    }


    public function getAttributes(string $listingId): array
    {
        $sql = "SELECT a.* 
                FROM attribute a
                JOIN listing_attribute la ON a.id = la.attribute_id
                WHERE la.listing_id = ?";
        
        return $this->db->fetchAll($sql, [$listingId]);
    }


    public function setAttributes(string $listingId, array $attributeIds): void
    {
        // Remove existing attributes
        $this->db->delete('listing_attribute', 'listing_id = ?', [$listingId]);
        
        // Add new attributes
        foreach ($attributeIds as $attrId) {
            $this->db->insert('listing_attribute', [
                'listing_id' => $listingId,
                'attribute_id' => $attrId,
            ]);
        }
    }


    public function addAttribute(string $listingId, int $attributeId): void
    {
        $this->db->insert('listing_attribute', [
            'listing_id' => $listingId,
            'attribute_id' => $attributeId,
        ]);
    }


    public function removeAttribute(string $listingId, int $attributeId): void
    {
        $this->db->delete(
            'listing_attribute', 
            'listing_id = ? AND attribute_id = ?', 
            [$listingId, $attributeId]
        );
    }


    public function getServices(string $listingId): array
    {
        $sql = "SELECT s.* 
                FROM service s
                JOIN listing_service ls ON s.id = ls.service_id
                WHERE ls.listing_id = ?";
        
        return $this->db->fetchAll($sql, [$listingId]);
    }


    public function setServices(string $listingId, array $serviceIds): void
    {
        // Remove existing services
        $this->db->delete('listing_service', 'listing_id = ?', [$listingId]);
        
        // Add new services
        foreach ($serviceIds as $serviceId) {
            $this->db->insert('listing_service', [
                'listing_id' => $listingId,
                'service_id' => $serviceId,
            ]);
        }
    }


    /**
     * Sync attributes for a listing - accepts simple array of attribute IDs
     * This is a convenient wrapper for setAttributes that handles edge cases
     * 
     * @param string $listingId The listing UUID
     * @param array $attributeIds Array of attribute IDs (can be mixed types, will be sanitized)
     * @return int Number of attributes synced
     */
    public function syncAttributes(string $listingId, array $attributeIds): int
    {
        // Sanitize and filter the attribute IDs
        $cleanIds = array_filter(array_map(function($id) {
            return is_numeric($id) ? (int)$id : null;
        }, $attributeIds));
        
        // Remove duplicates
        $cleanIds = array_unique($cleanIds);
        
        // Use existing setAttributes method
        $this->setAttributes($listingId, $cleanIds);
        
        return count($cleanIds);
    }


    /**
     * Sync services for a listing - accepts simple array of service IDs
     * This is a convenient wrapper for setServices that handles edge cases
     * 
     * @param string $listingId The listing UUID
     * @param array $serviceIds Array of service IDs (can be mixed types, will be sanitized)
     * @return int Number of services synced
     */
    public function syncServices(string $listingId, array $serviceIds): int
    {
        // Sanitize and filter the service IDs
        $cleanIds = array_filter(array_map(function($id) {
            return is_numeric($id) ? (int)$id : null;
        }, $serviceIds));
        
        // Remove duplicates
        $cleanIds = array_unique($cleanIds);
        
        // Use existing setServices method
        $this->setServices($listingId, $cleanIds);
        
        return count($cleanIds);
    }


    /**
     * Save a listing with all its related data in one call
     * Handles images, attributes, services, availability, and verification documents
     * 
     * @param array $listingData Core listing data
     * @param array $relations Optional related data:
     *   - 'attributes' => array of attribute IDs
     *   - 'services' => array of service IDs
     *   - 'images' => array of image paths with positions
     *   - 'availability' => array of availability periods
     * @return string|false The listing ID on success, false on failure
     */
    public function saveWithRelations(array $listingData, array $relations = []): string|false
    {
        try {
            // Create or update the listing
            $isUpdate = isset($listingData['id']) && $this->find($listingData['id']);
            
            if ($isUpdate) {
                $listingId = $listingData['id'];
                unset($listingData['id']);
                $this->update($listingId, $listingData);
            } else {
                $listingId = $this->createListing($listingData);
            }
            
            if (!$listingId) {
                return false;
            }
            
            // Sync attributes if provided
            if (isset($relations['attributes']) && is_array($relations['attributes'])) {
                $this->syncAttributes($listingId, $relations['attributes']);
            }
            
            // Sync services if provided
            if (isset($relations['services']) && is_array($relations['services'])) {
                $this->syncServices($listingId, $relations['services']);
            }
            
            // Add images if provided
            if (isset($relations['images']) && is_array($relations['images'])) {
                foreach ($relations['images'] as $index => $imagePath) {
                    $position = is_array($imagePath) ? ($imagePath['position'] ?? $index) : $index;
                    $path = is_array($imagePath) ? ($imagePath['path'] ?? $imagePath) : $imagePath;
                    $this->addImage($listingId, $path, $position);
                }
            }
            
            // Add availability periods if provided
            if (isset($relations['availability']) && is_array($relations['availability'])) {
                // Clear existing availability first if updating
                if ($isUpdate) {
                    $this->db->delete('listing_availability', 'listing_id = ?', [$listingId]);
                }
                
                foreach ($relations['availability'] as $period) {
                    $from = is_array($period) ? $period['from'] : $period;
                    $until = is_array($period) ? ($period['until'] ?? null) : null;
                    $this->addAvailability($listingId, $from, $until);
                }
            }
            
            return $listingId;
            
        } catch (Exception $e) {
            error_log("Error saving listing with relations: " . $e->getMessage());
            return false;
        }
    }


    public function getAvailability(string $listingId): array
    {
        $sql = "SELECT * FROM listing_availability 
                WHERE listing_id = ? 
                ORDER BY available_from ASC";
        
        return $this->db->fetchAll($sql, [$listingId]);
    }


    public function addAvailability(string $listingId, string $from, ?string $until = null): string
    {
        $id = $this->generateUuid();
        
        $this->db->insert('listing_availability', [
            'id' => $id,
            'listing_id' => $listingId,
            'available_from' => $from,
            'available_until' => $until,
        ]);
        
        return $id;
    }

    /**
     * Set availability for a listing (replaces existing)
     * 
     * @param string $listingId Listing ID
     * @param string $from Start date
     * @param string|null $until End date
     */
    public function setAvailability(string $listingId, string $from, ?string $until = null): void
    {
        // Delete existing availability
        $this->db->delete('listing_availability', 'listing_id = ?', [$listingId]);
        
        // Add new availability
        $this->addAvailability($listingId, $from, $until);
    }


    public function getHost(string $profileId): array|false
    {
        $sql = "SELECT p.*, a.email
                FROM user_profile p
                JOIN account a ON p.account_id = a.id
                WHERE p.id = ?";
        
        return $this->db->fetchOne($sql, [$profileId]);
    }


    public function search(array $filters = []): array
    {
        $sql = "SELECT l.*, 
                       (SELECT image FROM listing_image WHERE listing_id = l.id ORDER BY position LIMIT 1) as primary_image,
                       p.first_name as host_first_name, p.last_name as host_last_name
                FROM listing l
                LEFT JOIN user_profile p ON l.host_profile_id = p.id
                WHERE 1=1";
        
        $params = [];
        
        // Status filter
        if (!empty($filters['status'])) {
            $sql .= " AND l.status = ?";
            $params[] = $filters['status'];
        }

        // Location filter
        if (!empty($filters['location'])) {
            $sql .= " AND (l.city LIKE ? OR l.country LIKE ?)";
            $params[] = '%' . $filters['location'] . '%';
            $params[] = '%' . $filters['location'] . '%';
        } else {
             // Fallback to specific filters
            if (!empty($filters['city'])) {
                $sql .= " AND l.city LIKE ?";
                $params[] = '%' . $filters['city'] . '%';
            }
            
            if (!empty($filters['country'])) {
                $sql .= " AND l.country LIKE ?";
                $params[] = '%' . $filters['country'] . '%';
            }
        }
        
        // Room type filter
        if (!empty($filters['room_type'])) {
            $sql .= " AND l.room_type = ?";
            $params[] = $filters['room_type'];
        }
        
        // Guests filter
        if (!empty($filters['max_guests'])) {
            $sql .= " AND l.max_guests >= ?";
            $params[] = $filters['max_guests'];
        }
        
        // Host role filter
        if (!empty($filters['host_role'])) {
            $sql .= " AND l.host_role = ?";
            $params[] = $filters['host_role'];
        }
        
        // Attribute filter
        if (!empty($filters['attributes']) && is_array($filters['attributes'])) {
            foreach ($filters['attributes'] as $attrId) {
                $sql .= " AND EXISTS (
                    SELECT 1 FROM listing_attribute la 
                    WHERE la.listing_id = l.id AND la.attribute_id = ?
                )";
                $params[] = $attrId;
            }
        }
        
        // Service filter
        if (!empty($filters['services']) && is_array($filters['services'])) {
            foreach ($filters['services'] as $serviceId) {
                $sql .= " AND EXISTS (
                    SELECT 1 FROM listing_service ls 
                    WHERE ls.listing_id = l.id AND ls.service_id = ?
                )";
                $params[] = $serviceId;
            }
        }
        
        // Availability filter - supports date range
        if (!empty($filters['available_from'])) {
            if (!empty($filters['available_until'])) {
                // Date range: check if listing is available for the entire period
                $sql .= " AND EXISTS (
                    SELECT 1 FROM listing_availability la 
                    WHERE la.listing_id = l.id 
                    AND la.available_from <= ?
                    AND (la.available_until IS NULL OR la.available_until >= ?)
                )";
                $params[] = $filters['available_from'];
                $params[] = $filters['available_until'];
            } else {
                // Single date: check if listing is available on that date
                $sql .= " AND EXISTS (
                    SELECT 1 FROM listing_availability la 
                    WHERE la.listing_id = l.id 
                    AND la.available_from <= ? 
                    AND (la.available_until IS NULL OR la.available_until >= ?)
                )";
                $params[] = $filters['available_from'];
                $params[] = $filters['available_from'];
            }
        }
        
        // Sorting
        $orderBy = match($filters['sort'] ?? 'newest') {
            'oldest' => 'l.created_at ASC',
            'title' => 'l.title ASC',
            default => 'l.created_at DESC',
        };
        $sql .= " ORDER BY {$orderBy}";
        
        // Pagination
        $limit = min((int)($filters['limit'] ?? 20), 100);
        $offset = (int)($filters['offset'] ?? 0);
        $sql .= " LIMIT {$limit} OFFSET {$offset}";
        
        return $this->db->fetchAll($sql, $params);
    }


    public function countSearch(array $filters = []): int
    {
        $sql = "SELECT COUNT(*) as total
                FROM listing l
                WHERE 1=1";
        
        $params = [];
        
        // Status filter
        if (!empty($filters['status'])) {
            $sql .= " AND l.status = ?";
            $params[] = $filters['status'];
        }

        // Use identical logic to search() for filters
        // Location filter
    if (!empty($filters['location'])) {
        $sql .= " AND (l.city LIKE ? OR l.country LIKE ?)";
        $params[] = '%' . $filters['location'] . '%';
        $params[] = '%' . $filters['location'] . '%';
    } else {
        if (!empty($filters['city'])) {
            $sql .= " AND l.city LIKE ?";
            $params[] = '%' . $filters['city'] . '%';
        }
        
        if (!empty($filters['country'])) {
            $sql .= " AND l.country LIKE ?";
            $params[] = '%' . $filters['country'] . '%';
        }
    }
        
        // Room type filter
        if (!empty($filters['room_type'])) {
            $sql .= " AND l.room_type = ?";
            $params[] = $filters['room_type'];
        }
        
        // Guests filter
        if (!empty($filters['max_guests'])) {
            $sql .= " AND l.max_guests >= ?";
            $params[] = $filters['max_guests'];
        }
        
        // Host role filter
        if (!empty($filters['host_role'])) {
            $sql .= " AND l.host_role = ?";
            $params[] = $filters['host_role'];
        }
        
        // Attribute filter
        if (!empty($filters['attributes']) && is_array($filters['attributes'])) {
            foreach ($filters['attributes'] as $attrId) {
                $sql .= " AND EXISTS (
                    SELECT 1 FROM listing_attribute la 
                    WHERE la.listing_id = l.id AND la.attribute_id = ?
                )";
                $params[] = $attrId;
            }
        }
        
        // Service filter
        if (!empty($filters['services']) && is_array($filters['services'])) {
            foreach ($filters['services'] as $serviceId) {
                $sql .= " AND EXISTS (
                    SELECT 1 FROM listing_service ls 
                    WHERE ls.listing_id = l.id AND ls.service_id = ?
                )";
                $params[] = $serviceId;
            }
        }
        
        // Availability filter - supports date range
        if (!empty($filters['available_from'])) {
            if (!empty($filters['available_until'])) {
                // Date range: check if listing is available for the entire period
                $sql .= " AND EXISTS (
                    SELECT 1 FROM listing_availability la 
                    WHERE la.listing_id = l.id 
                    AND la.available_from <= ?
                    AND (la.available_until IS NULL OR la.available_until >= ?)
                )";
                $params[] = $filters['available_from'];
                $params[] = $filters['available_until'];
            } else {
                // Single date: check if listing is available on that date
                $sql .= " AND EXISTS (
                    SELECT 1 FROM listing_availability la 
                    WHERE la.listing_id = l.id 
                    AND la.available_from <= ? 
                    AND (la.available_until IS NULL OR la.available_until >= ?)
                )";
                $params[] = $filters['available_from'];
                $params[] = $filters['available_from'];
            }
        }
        
        $result = $this->db->fetchOne($sql, $params);
        return (int)($result['total'] ?? 0);
    }


    public function getByHostProfile(string $profileId): array
    {
        $sql = "SELECT l.*, 
                       (SELECT image FROM listing_image WHERE listing_id = l.id ORDER BY position LIMIT 1) as primary_image
                FROM listing l
                WHERE l.host_profile_id = ?
                ORDER BY l.created_at DESC";
        
        return $this->db->fetchAll($sql, [$profileId]);
    }


    public function getByStatus(string $status): array
    {
        return $this->findBy('status', $status);
    }

    public function getAllListings(): array
    {
        $sql = "SELECT l.*, p.first_name, p.last_name, a.email as host_email,
                (SELECT GROUP_CONCAT(document) FROM listing_verification_document WHERE listing_id = l.id) as verification_docs,
                (SELECT GROUP_CONCAT(image) FROM listing_image WHERE listing_id = l.id) as listing_photos
                FROM listing l
                LEFT JOIN user_profile p ON l.host_profile_id = p.id
                LEFT JOIN account a ON p.account_id = a.id
                ORDER BY l.created_at DESC";
        
        return $this->db->fetchAll($sql);
    }


    public function updateStatus(string $id, string $status): bool
    {
        $validStatuses = ['draft', 'pending-approval', 'published', 'paused', 'archived'];
        
        if (!in_array($status, $validStatuses)) {
            throw new InvalidArgumentException("Invalid status: {$status}");
        }
        
        return $this->update($id, ['status' => $status]) > 0;
    }


    public function publish(string $id): bool
    {
        return $this->updateStatus($id, 'published');
    }


    public function pause(string $id): bool
    {
        return $this->updateStatus($id, 'paused');
    }


    public function archive(string $id): bool
    {
        return $this->updateStatus($id, 'archived');
    }


    public function isOwner(string $listingId, string $profileId): bool
    {
        $listing = $this->find($listingId);
        return $listing && $listing['host_profile_id'] === $profileId;
    }


    public function countByHost(string $profileId): int
    {
        return $this->count(['host_profile_id' => $profileId]);
    }


    public function getAllListings(): array
    {
        $sql = "SELECT l.*, 
                       p.first_name, p.last_name, 
                       a.email as host_email
                FROM listing l
                LEFT JOIN user_profile p ON l.host_profile_id = p.id
                LEFT JOIN account a ON p.account_id = a.id
                ORDER BY l.created_at DESC";
        
        return $this->db->fetchAll($sql);
    }

    public function getRecent(int $limit = 10): array
    {
        $sql = "SELECT l.*, 
                       (SELECT image FROM listing_image WHERE listing_id = l.id ORDER BY position LIMIT 1) as primary_image
                FROM listing l
                WHERE l.status = 'published'
                ORDER BY l.created_at DESC
                LIMIT ?";
        
        return $this->db->fetchAll($sql, [$limit]);
    }


    public function addVerificationDocument(string $listingId, string $path, ?int $typeId = null): string
    {
        $id = $this->generateUuid();
        
        $this->db->delete('listing_verification_document', 'listing_id = ?', [$listingId]);
        
        $this->db->insert('listing_verification_document', [
            'id' => $id,
            'listing_id' => $listingId,
            'document' => $path,
            'document_type_id' => $typeId
        ]);
        
        return $id;
    }

    public function getVerificationDocument(string $listingId): ?array
    {
        $sql = "SELECT * FROM listing_verification_document WHERE listing_id = ?";
        return $this->db->fetchOne($sql, [$listingId]);
    }

    private function generateUuid(): string
    {
        $data = random_bytes(16);
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80);
        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }
}
