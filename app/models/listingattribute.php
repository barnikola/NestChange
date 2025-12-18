<?php

require_once dirname(__DIR__) . '/core/model.php';

class ListingAttribute extends Model
{
    protected string $table = 'attribute';
        protected string $primaryKey = 'id';


        public function findByName(string $name): array|false
        {
            return $this->findOneBy('name', $name);
        }


        public function getByCategory(string $category): array
        {
            return $this->findBy('category', $category);
        }


        public function getCategories(): array
        {
            $sql = "SELECT DISTINCT category FROM {$this->table} WHERE category IS NOT NULL ORDER BY category";
            $results = $this->db->fetchAll($sql);
            return array_column($results, 'category');
        }


        public function getAllGroupedByCategory(): array
        {
            $attributes = $this->findAll('category, name');
            $grouped = [];
            
            foreach ($attributes as $attr) {
                $category = $attr['category'] ?? 'Other';
                if (!isset($grouped[$category])) {
                    $grouped[$category] = [];
                }
                $grouped[$category][] = $attr;
            }
            
            return $grouped;
        }


        public function createAttribute(string $name, ?string $category = null): string
        {
            return $this->create([
                'name' => $name,
                'category' => $category,
            ]);
        }


        public function getForListing(string $listingId): array
        {
            $sql = "SELECT a.* 
                    FROM {$this->table} a
                    JOIN listing_attribute la ON a.id = la.attribute_id
                    WHERE la.listing_id = ?
                    ORDER BY a.category, a.name";
            
            return $this->db->fetchAll($sql, [$listingId]);
        }


        public function search(string $query): array
        {
            $sql = "SELECT * FROM {$this->table} WHERE name LIKE ? ORDER BY name LIMIT 20";
            return $this->db->fetchAll($sql, ['%' . $query . '%']);
        }


        public function getPopular(int $limit = 10): array
        {
            $sql = "SELECT a.*, COUNT(la.listing_id) as usage_count
                    FROM {$this->table} a
                    LEFT JOIN listing_attribute la ON a.id = la.attribute_id
                    GROUP BY a.id
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
            $defaults = $this->getDefaultAttributesWithDescriptions();
            
            foreach ($defaults as $attr) {
                if (!$this->nameExists($attr['name'])) {
                    $this->create($attr);
                }
            }
        }


        /**
         * Get default attributes with descriptions for tooltips
         * @return array
         */
        public function getDefaultAttributesWithDescriptions(): array
        {
            return [
                // Amenities
                ['name' => 'WiFi', 'category' => 'Amenities', 'description' => 'Wireless internet access available throughout the property'],
                ['name' => 'Air Conditioning', 'category' => 'Amenities', 'description' => 'Climate control system to keep rooms cool during hot weather'],
                ['name' => 'Heating', 'category' => 'Amenities', 'description' => 'Central or portable heating available for cold weather'],
                ['name' => 'Kitchen', 'category' => 'Amenities', 'description' => 'Fully equipped kitchen with stove, fridge, and cooking utensils'],
                ['name' => 'Washing Machine', 'category' => 'Amenities', 'description' => 'In-unit laundry facilities for washing clothes'],
                ['name' => 'Dryer', 'category' => 'Amenities', 'description' => 'Clothes dryer available for convenient laundry'],
                ['name' => 'TV', 'category' => 'Amenities', 'description' => 'Television with cable or streaming services'],
                ['name' => 'Workspace', 'category' => 'Amenities', 'description' => 'Dedicated desk and chair suitable for remote work'],
                
                // Safety
                ['name' => 'Smoke Alarm', 'category' => 'Safety', 'description' => 'Working smoke detectors installed for fire safety'],
                ['name' => 'Carbon Monoxide Alarm', 'category' => 'Safety', 'description' => 'CO detector to alert against dangerous gas levels'],
                ['name' => 'First Aid Kit', 'category' => 'Safety', 'description' => 'Basic medical supplies available for minor injuries'],
                ['name' => 'Fire Extinguisher', 'category' => 'Safety', 'description' => 'Fire extinguisher readily accessible in case of emergency'],
                
                // Location
                ['name' => 'Near Public Transport', 'category' => 'Location', 'description' => 'Bus, metro, or train station within 5 minutes walk'],
                ['name' => 'City Center', 'category' => 'Location', 'description' => 'Located in or near the downtown/city center area'],
                ['name' => 'Near University', 'category' => 'Location', 'description' => 'Close proximity to university campus'],
                ['name' => 'Quiet Neighborhood', 'category' => 'Location', 'description' => 'Peaceful residential area with minimal noise'],
                
                // Room Features
                ['name' => 'Private Bathroom', 'category' => 'Room', 'description' => 'Your own bathroom not shared with other guests'],
                ['name' => 'Balcony', 'category' => 'Room', 'description' => 'Private outdoor space with balcony or terrace'],
                ['name' => 'Garden Access', 'category' => 'Room', 'description' => 'Access to a private or shared garden area'],
                ['name' => 'Furnished', 'category' => 'Room', 'description' => 'Room comes fully furnished with bed, storage, etc.'],
            ];
        }


        /**
         * Get description for a specific attribute by name
         * @param string $name
         * @return string
         */
        public function getDescriptionForAttribute(string $name): string
        {
            $defaults = $this->getDefaultAttributesWithDescriptions();
            
            foreach ($defaults as $attr) {
                if (strtolower($attr['name']) === strtolower($name)) {
                    return $attr['description'] ?? '';
                }
            }
            
            // Generic fallback
            return "This property includes {$name}";
        }


        /**
         * Get attributes with descriptions for a listing (for tooltips)
         * @param string $listingId
         * @return array
         */
        public function getForListingWithDescriptions(string $listingId): array
        {
            $attributes = $this->getForListing($listingId);
            
            foreach ($attributes as &$attr) {
                if (empty($attr['description'])) {
                    $attr['description'] = $this->getDescriptionForAttribute($attr['name']);
                }
            }
            
            return $attributes;
        }
}
