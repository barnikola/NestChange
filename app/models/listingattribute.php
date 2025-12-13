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
            $defaults = [
                // Amenities
                ['name' => 'WiFi', 'category' => 'Amenities'],
                ['name' => 'Air Conditioning', 'category' => 'Amenities'],
                ['name' => 'Heating', 'category' => 'Amenities'],
                ['name' => 'Kitchen', 'category' => 'Amenities'],
                ['name' => 'Washing Machine', 'category' => 'Amenities'],
                ['name' => 'Dryer', 'category' => 'Amenities'],
                ['name' => 'TV', 'category' => 'Amenities'],
                ['name' => 'Workspace', 'category' => 'Amenities'],
                
                // Safety
                ['name' => 'Smoke Alarm', 'category' => 'Safety'],
                ['name' => 'Carbon Monoxide Alarm', 'category' => 'Safety'],
                ['name' => 'First Aid Kit', 'category' => 'Safety'],
                ['name' => 'Fire Extinguisher', 'category' => 'Safety'],
                
                // Location
                ['name' => 'Near Public Transport', 'category' => 'Location'],
                ['name' => 'City Center', 'category' => 'Location'],
                ['name' => 'Near University', 'category' => 'Location'],
                ['name' => 'Quiet Neighborhood', 'category' => 'Location'],
                
                // Room Features
                ['name' => 'Private Bathroom', 'category' => 'Room'],
                ['name' => 'Balcony', 'category' => 'Room'],
                ['name' => 'Garden Access', 'category' => 'Room'],
                ['name' => 'Furnished', 'category' => 'Room'],
            ];
            
            foreach ($defaults as $attr) {
                if (!$this->nameExists($attr['name'])) {
                    $this->create($attr);
                }
            }
        }
}
