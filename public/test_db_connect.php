<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

echo "<h1>DB Connection Test</h1>";

$host = '127.0.0.1';
$port = '3306';
$db = 'nest-test-2';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;port=$port;dbname=$db;charset=$charset";
echo "DSN: $dsn <br>";

try {
    $pdo = new PDO($dsn, $user, $pass);
    echo "<h2>SUCCESS: Connected to database!</h2>";

    $stmt = $pdo->query("SHOW TABLES");
    echo "<h3>Tables:</h3><ul>";
    while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
        echo "<li>" . htmlspecialchars($row[0]) . "</li>";
    }
    echo "</ul>";

} catch (\PDOException $e) {
    echo "<h2>FAILURE: " . htmlspecialchars($e->getMessage()) . "</h2>";
    echo "Code: " . $e->getCode();
}
