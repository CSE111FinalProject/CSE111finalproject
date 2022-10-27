<?php
    $db = new SQLite3('database/librarydatabase.sqlite') or die("Unable to open database!");
    //example of query when creating database
    $query="CREATE TABLE IF NOT EXISTS `login`('user_id' INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, 'username' TEXT NOT NULL UNIQUE ON CONFLICT IGNORE, 'password' TEXT NOT NULL)";
    $db->exec($query)or die("Failed to create row!");
    $query="CREATE TABLE IF NOT EXISTS `library`('library_id' INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, 'libraryname' TEXT NOT NULL UNIQUE ON CONFLICT IGNORE, 'CityName' TEXT NOT NULL, 'NatioName' TEXT NOT NULL)";
    $db->exec($query)or die("Failed to create row!");
    $query="CREATE TABLE IF NOT EXISTS `Borrow`('borrow_id' INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, 'username' TEXT NOT NULL, 'BookName' TEXT NOT NULL)";
    $db->exec($query)or die("Failed to create row!");
    //etc
    $db->close();
    
?>