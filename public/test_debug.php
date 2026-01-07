<?php
echo "Current Dir: " . __DIR__ . "<br>";
echo "App Cache Exists: " . (is_dir(__DIR__ . '/../app/cache') ? 'YES' : 'NO') . "<br>";
echo "Env File Exists: " . (file_exists(__DIR__ . '/../.env') ? 'YES' : 'NO') . "<br>";
if (file_exists(__DIR__ . '/../.env')) {
    echo "Env Content:<br><pre>" . file_get_contents(__DIR__ . '/../.env') . "</pre>";
}
