<?php


try {
    $db = new PDO('mysql:host=localhost;dbname=nest-test-2;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch (Exception $e) {
    die('Error: ' . $e->getMessage());
}
