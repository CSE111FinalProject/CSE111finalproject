<?php
    $db = new SQLite3('database/librarydatabase.sqlite') or die("Unable to open database!");
    $query="CREATE TABLE IF NOT EXISTS `login`('user_id' INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, 'username' TEXT NOT NULL UNIQUE ON CONFLICT IGNORE, 'password' TEXT NOT NULL)";
    $db->exec($query);
    $db->close();
    
?>