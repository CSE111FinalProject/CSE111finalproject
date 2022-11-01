<?php
    $db = new SQLite3('database/librarydatabase.sqlite') or die("Unable to open database!");
    //example of query when creating database
    $query="CREATE TABLE IF NOT EXISTS `cardholder`('c_cardid' INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, 'c_username' TEXT NOT NULL UNIQUE ON CONFLICT IGNORE, 'c_password' TEXT NOT NULL, 'c_address' TEXT NOT NULL, 'c_cityid' INTEGER NOT NULL, 'c_phone' INTEGER NOT NULL, 'c_acctbal' INTEGER, 'c_comment' TEXT)";
    $db->exec($query)or die("Failed to create table! ");//Do not touch

    //Example - //Do not touch
    $query="CREATE TABLE IF NOT EXISTS `City`('city_cityid' INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, 'city_name' TEXT  NOT NULL UNIQUE ON CONFLICT IGNORE, 'city_stateid' INTEGER NOT NULL, 'city_comment' TEXT NOT NULL)";
    $db->exec($query)or die("Failed to create table! ");
    $statement = $db->prepare('INSERT INTO "City" ("city_name","city_stateid","city_comment")VALUES ("Merced",1,"No comment")');
    $result = $statement->execute();
    $statement = $db->prepare('INSERT INTO "City" ("city_name","city_stateid","city_comment")VALUES ("Los Angeles",2,"No comment")');
    $result = $statement->execute();
    $statement = $db->prepare('INSERT INTO "City" ("city_name","city_stateid","city_comment")VALUES ("New York",3,"No comment")');
    $result = $statement->execute();
    $statement = $db->prepare('INSERT INTO "City" ("city_name","city_stateid","city_comment")VALUES ("Seatle",4,"No comment")');
    $result = $statement->execute();
    $statement = $db->prepare('INSERT INTO "City" ("city_name","city_stateid","city_comment")VALUES ("Sacramento",5,"No comment")');
    $result = $statement->execute();
    
    // $db->exec($statement)or die("Failed to Insert");
    // $db->exec('COMMIT');

    //Modify these with relevant column attribute and also do insert
    $query="CREATE TABLE IF NOT EXISTS `Borrow`('borrow_id' INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, 'username' TEXT NOT NULL, 'BookName' TEXT NOT NULL,'BookType' TEXT NOT NULL)";
    $db->exec($query)or die("Failed to create table! ");
    
    $query="CREATE TABLE IF NOT EXISTS `Books`('b_bookid' INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
     'b_isbn' TEXT NOT NULL, 'b_title' TEXT NOT NULL,'b_year' INTEGER NOT NULL, 'b_genre' TEXT NOT NULL, 'b_libid' INTEGER NOT NULL, 'b_condition' TEXT NOT NULL, 'b_comment' TEXT NOT NULL )";
    $db->exec($query)or die("Failed to create table! ");
    
    $query="CREATE TABLE IF NOT EXISTS `Movies`('b_bookid' INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
     'b_isbn' TEXT NOT NULL, 'b_title' TEXT NOT NULL,'b_year' INTEGER NOT NULL, 'b_genre' TEXT NOT NULL, 'b_libid' INTEGER NOT NULL, 'b_condition' TEXT NOT NULL, 'b_comment' TEXT NOT NULL )";
    $db->exec($query)or die("Failed to create table! ");
    
    $query="CREATE TABLE IF NOT EXISTS `Library`('library_id' INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, 'libraryname' TEXT NOT NULL UNIQUE ON CONFLICT IGNORE, 'CityName' TEXT NOT NULL, 'NatioName' TEXT NOT NULL)";
    $db->exec($query)or die("Failed to create table! ");
    
    $query="CREATE TABLE IF NOT EXISTS `State`('b_bookid' INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
     'b_isbn' TEXT NOT NULL, 'b_title' TEXT NOT NULL,'b_year' INTEGER NOT NULL, 'b_genre' TEXT NOT NULL, 'b_libid' INTEGER NOT NULL, 'b_condition' TEXT NOT NULL, 'b_comment' TEXT NOT NULL )";
    $db->exec($query)or die("Failed to create table! ");
    //etc
    $db->close();
    
?>