<?php
    $db = new SQLite3('database/librarydatabase.sqlite') or die("Unable to open database!");
    //example of query when creating database
    $query="CREATE TABLE IF NOT EXISTS `login`('user_id' INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, 'username' TEXT NOT NULL UNIQUE ON CONFLICT IGNORE, 'password' TEXT NOT NULL)";
    $db->exec($query)or die("Failed to create table! ");
    $query="CREATE TABLE IF NOT EXISTS `library`('library_id' INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, 'libraryname' TEXT NOT NULL UNIQUE ON CONFLICT IGNORE, 'CityName' TEXT NOT NULL, 'NatioName' TEXT NOT NULL)";
    $db->exec($query)or die("Failed to create table! ");
    $query="CREATE TABLE IF NOT EXISTS `Borrow`('borrow_id' INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, 'username' TEXT NOT NULL, 'BookName' TEXT NOT NULL,'BookType' TEXT NOT NULL)";
    $db->exec($query)or die("Failed to create table! ");
    $query="CREATE TABLE IF NOT EXISTS `Books`('b_bookid' INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
     'b_isbn' TEXT NOT NULL, 'b_title' TEXT NOT NULL,'b_year' INTEGER NOT NULL, 'b_genre' TEXT NOT NULL, 'b_libid' INTEGER NOT NULL, 'b_condition' TEXT NOT NULL, 'b_comment' TEXT NOT NULL )";
    $db->exec($query)or die("Failed to create table! ");
    //etc
    $db->close();
    
?>