<?php
$host = 'localhost'; 
$dbname = 'my_database';
$user = 'root'; 
$password = ''; 

$dsn = "mysql:host=$host;port=3307"; 

try {
    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Create database if it doesn't exist
    $pdo->exec("CREATE DATABASE IF NOT EXISTS $dbname");
    $pdo->exec("use $dbname");

    // Create tables
    $sql = "
        CREATE TABLE IF NOT EXISTS users (
            email VARCHAR(50) NOT NULL,
            password VARCHAR(255) NOT NULL,
            first_name VARCHAR(30) NOT NULL,
            last_name VARCHAR(30) NOT NULL,
            PRIMARY KEY (email)
        );
    ";
    $pdo->exec($sql);

} catch(PDOException $e) {
    echo "Database connection failed: " . $e->getMessage();
}
?>