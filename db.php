<?php
try {
    // connects to the external database
    $db = new PDO('sqlite:./db/skillswap.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // creates users table
    $db->exec("CREATE TABLE IF NOT EXISTS users (
    id INTEGER PRIMARY KEY AUTOINCREMENT, 
    username TEXT UNIQUE,
    email TEXT UNIQUE,
    phone_number TEXT UNIQUE,
    password TEXT
    )");

    // creates skills table
    $db->exec("CREATE TABLE IF NOT EXISTS skills (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    user_id INTEGER, 
    skill TEXT, 
    type TEXT CHECK(type IN('teach','learn')), 
    FOREIGN KEY(user_id) REFERENCES users(id)
    )");

    echo "Database and tables created successfully!";
} catch (PDOException $e) {
    echo "Database Error: " . $e->getMessage();
}
?>