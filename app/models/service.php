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
        $defaults = [
            ['name' => 'Cleaning', 'description' => 'Regular cleaning service included'],
            ['name' => 'Laundry', 'description' => 'Laundry service available'],
            ['name' => 'Breakfast', 'description' => 'Breakfast included or available'],
            ['name' => 'Airport Pickup', 'description' => 'Transportation from airport'],
            ['name' => 'Bike Rental', 'description' => 'Bicycles available for rent'],
            ['name' => 'Parking', 'description' => 'Parking space available'],
            ['name' => 'Gym Access', 'description' => 'Access to fitness facilities'],
            ['name' => 'Pool Access', 'description' => 'Access to swimming pool'],
            ['name' => 'Pet Friendly', 'description' => 'Pets are welcome'],
            ['name' => 'Language Exchange', 'description' => 'Opportunity for language practice'],
        ];
        
        foreach ($defaults as $service) {
            if (!$this->nameExists($service['name'])) {
                $this->create($service);
            }
        }
    }
}
