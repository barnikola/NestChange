<?php
/**
 * Favorite Model
 * 
 * Handles all database operations for user favorites.
 */

require_once dirname(__DIR__) . '/core/model.php';

class Favorite extends Model
{
    protected string $table = 'favorite';
    protected string $primaryKey = 'id';

    /**
     * Add a listing to user's favorites
     * 
     * @param string $profileId User's profile ID
     * @param string $listingId Listing ID to favorite
     * @return string|false The favorite ID on success, false if already exists
     */
    public function add(string $profileId, string $listingId): string|false
    {
        // Check if already favorited
        if ($this->isFavorited($profileId, $listingId)) {
            return false;
        }

        $id = $this->generateUuid();
        
        $this->create([
            'id' => $id,
            'profile_id' => $profileId,
            'listing_id' => $listingId,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        return $id;
    }

    /**
     * Remove a listing from user's favorites
     * 
     * @param string $profileId User's profile ID
     * @param string $listingId Listing ID to unfavorite
     * @return bool True if removed, false if not found
     */
    public function remove(string $profileId, string $listingId): bool
    {
        return $this->db->delete(
            $this->table, 
            "profile_id = ? AND listing_id = ?", 
            [$profileId, $listingId]
        ) > 0;
    }

    /**
     * Check if a listing is favorited by user
     * 
     * @param string $profileId User's profile ID
     * @param string $listingId Listing ID to check
     * @return bool
     */
    public function isFavorited(string $profileId, string $listingId): bool
    {
        $sql = "SELECT 1 FROM {$this->table} WHERE profile_id = ? AND listing_id = ? LIMIT 1";
        return $this->db->fetchOne($sql, [$profileId, $listingId]) !== false;
    }

    /**
     * Get all favorited listings for a user with full listing details
     * 
     * @param string $profileId User's profile ID
     * @return array
     */
    public function getByUser(string $profileId): array
    {
        $sql = "SELECT 
                    f.id as favorite_id,
                    f.created_at as favorited_at,
                    l.*,
                    li.image as primary_image,
                    p.first_name as host_first_name,
                    p.last_name as host_last_name
                FROM {$this->table} f
                JOIN listing l ON f.listing_id = l.id
                LEFT JOIN listing_image li ON l.id = li.listing_id AND li.position = 0
                LEFT JOIN user_profile p ON l.host_profile_id = p.id
                WHERE f.profile_id = ?
                AND l.status = 'published'
                ORDER BY f.created_at DESC";

        return $this->db->fetchAll($sql, [$profileId]);
    }

    /**
     * Get just the listing IDs that a user has favorited
     * Useful for checking multiple listings at once
     * 
     * @param string $profileId User's profile ID
     * @return array Array of listing IDs
     */
    public function getFavoriteIds(string $profileId): array
    {
        $sql = "SELECT listing_id FROM {$this->table} WHERE profile_id = ?";
        $results = $this->db->fetchAll($sql, [$profileId]);
        
        return array_column($results, 'listing_id');
    }

    /**
     * Count favorites for a user
     * 
     * @param string $profileId User's profile ID
     * @return int
     */
    public function countByUser(string $profileId): int
    {
        return $this->count(['profile_id' => $profileId]);
    }

    /**
     * Count how many users have favorited a listing
     * 
     * @param string $listingId Listing ID
     * @return int
     */
    public function countByListing(string $listingId): int
    {
        return $this->count(['listing_id' => $listingId]);
    }

    /**
     * Generate a UUID v4
     * 
     * @return string
     */
    private function generateUuid(): string
    {
        $data = random_bytes(16);
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80);
        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }
}
