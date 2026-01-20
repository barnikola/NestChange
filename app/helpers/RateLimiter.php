<?php

class RateLimiter
{
    private const MAX_ATTEMPTS = 5;
    private const LOCKOUT_TIME = 900; // 15 minutes in seconds
    private const STORAGE_DIR = __DIR__ . '/../storage/rate_limits';

    /**
     * Check if the IP is allowed to attempt login
     * @param string $ip
     * @return void
     * @throws Exception if locked out
     */
    public static function check(string $ip): void
    {
        $data = self::load($ip);
        
        if ($data['locked_until'] && time() < $data['locked_until']) {
            $remaining = ceil(($data['locked_until'] - time()) / 60);
            throw new Exception("Too many failed attempts. Please try again in {$remaining} minutes.");
        }
        
        // If lock expired, clear it
        if ($data['locked_until'] && time() >= $data['locked_until']) {
            self::clear($ip);
        }
    }

    /**
     * Increment failed attempts for IP
     * @param string $ip
     * @return int Current attempts
     */
    public static function increment(string $ip): int
    {
        $data = self::load($ip);
        $data['attempts']++;
        
        if ($data['attempts'] >= self::MAX_ATTEMPTS) {
            $data['locked_until'] = time() + self::LOCKOUT_TIME;
        }
        
        self::save($ip, $data);
        return $data['attempts'];
    }

    /**
     * Clear attempts for IP (on success)
     * @param string $ip
     */
    public static function clear(string $ip): void
    {
        $file = self::getFilePath($ip);
        if (file_exists($file)) {
            unlink($file);
        }
    }

    private static function load(string $ip): array
    {
        $file = self::getFilePath($ip);
        if (file_exists($file)) {
            $content = file_get_contents($file);
            if ($content) {
                return json_decode($content, true) ?? ['attempts' => 0, 'locked_until' => null];
            }
        }
        return ['attempts' => 0, 'locked_until' => null];
    }

    private static function save(string $ip, array $data): void
    {
        if (!is_dir(self::STORAGE_DIR)) {
            mkdir(self::STORAGE_DIR, 0777, true);
        }
        file_put_contents(self::getFilePath($ip), json_encode($data));
    }

    private static function getFilePath(string $ip): string
    {
        return self::STORAGE_DIR . '/limit_' . md5($ip) . '.json';
    }
}
