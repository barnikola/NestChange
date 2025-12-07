<?php


try {
    $db = new PDO('mysql:host=localhost;dbname=nestchange;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch (Exception $e) {
    die('Error: ' . $e->getMessage());
}
