<?php


try {
    $db = new PDO('mysql:host=localhost;dbname=NestChange;charset=utf8', 'newuser', 'password', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch (Exception $e) {
    die('Error: ' . $e->getMessage());
}
