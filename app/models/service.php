<?php

require_once dirname(__DIR__) . '/core/model.php';

class Service extends Model
{
    protected string $table = 'service';
    protected string $primaryKey = 'id';


    public function findByName(string $name): array|false
    {
        return $this->findOneBy('name', $name);
    }


    public function createService(string $name, ?string $description = null): string
    {
        return $this->create([
            'name' => $name,
            'description' => $description,
        ]);
    }


    public function getForListing(string $listingId): array
    {
        $sql = "SELECT s.* 
                FROM {$this->table} s
                JOIN listing_service ls ON s.id = ls.service_id
                WHERE ls.listing_id = ?
                ORDER BY s.name";
        
        return $this->db->fetchAll($sql, [$listingId]);
    }


    public function search(string $query): array
    {
        $sql = "SELECT * FROM {$this->table} WHERE name LIKE ? ORDER BY name LIMIT 20";
        return $this->db->fetchAll($sql, ['%' . $query . '%']);
    }


    public function getPopular(int $limit = 10): array
    {
        $sql = "SELECT s.*, COUNT(ls.listing_id) as usage_count
                FROM {$this->table} s
                LEFT JOIN listing_service ls ON s.id = ls.service_id
                GROUP BY s.id
                ORDER BY usage_count DESC
                LIMIT ?";
        
        return $this->db->fetchAll($sql, [$limit]);
    }


    public function nameExists(string $name): bool
    {
        return $this->findByName($name) !== false;
    }


    public function seedDefaults(): void
    {
        $defaults = $this->getDefaultServicesWithDescriptions();
        
        foreach ($defaults as $service) {
            if (!$this->nameExists($service['name'])) {
                $this->create($service);
            }
        }
    }


    /**
     * Get default services with detailed descriptions for tooltips
     * These are mandatory requirements for guests, not optional services
     * @return array
     */
    public function getDefaultServicesWithDescriptions(): array
    {
        return [
            ['name' => 'Cleaning', 'description' => 'Guest is required to maintain cleanliness and perform regular cleaning during stay'],
            ['name' => 'Laundry', 'description' => 'Guest is responsible for doing their own laundry'],
            ['name' => 'Breakfast', 'description' => 'Guest is required to prepare or provide their own breakfast'],
            ['name' => 'Airport Pickup', 'description' => 'Guest must arrange their own transportation from/to the airport'],
            ['name' => 'Bike Rental', 'description' => 'Guest must rent bicycles themselves if needed'],
            ['name' => 'Parking', 'description' => 'Guest must arrange and pay for parking if bringing a vehicle'],
            ['name' => 'Gym Access', 'description' => 'Guest must arrange gym access themselves if needed'],
            ['name' => 'Pool Access', 'description' => 'Guest must arrange pool access themselves if available'],
            ['name' => 'Pet Friendly', 'description' => 'Guest is responsible for their pet\'s care and any related costs'],
            ['name' => 'Language Exchange', 'description' => 'Guest is expected to participate in language exchange activities'],
        ];
    }


    /**
     * Get description for a specific service by name
     * @param string $name
     * @return string
     */
    public function getDescriptionForService(string $name): string
    {
        $defaults = $this->getDefaultServicesWithDescriptions();
        
        foreach ($defaults as $service) {
            if (strtolower($service['name']) === strtolower($name)) {
                return $service['description'] ?? '';
            }
        }
        
        // Generic fallback - present as guest requirement
        return "Guest is required to handle " . strtolower($name);
    }


    /**
     * Get services with descriptions for a listing (for tooltips)
     * @param string $listingId
     * @return array
     */
    public function getForListingWithDescriptions(string $listingId): array
    {
        $services = $this->getForListing($listingId);
        
        foreach ($services as &$service) {
            if (empty($service['description'])) {
                $service['description'] = $this->getDescriptionForService($service['name']);
            }
        }
        
        return $services;
    }
}
