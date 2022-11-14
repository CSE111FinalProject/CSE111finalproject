
<?php
    include('accessDatabase.php');
    
    $db = new SQLite3('database/'. $databaseName, SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE) or die("Unable to open database!");
    $query="CREATE TABLE IF NOT EXISTS `cardholder`('c_cardid' INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, 'c_username' TEXT NOT NULL UNIQUE ON CONFLICT IGNORE, 'c_password' TEXT NOT NULL, 'c_address' TEXT NOT NULL, 'c_cityid' INTEGER NOT NULL, 'c_phone' INTEGER NOT NULL, 'c_acctbal' INTEGER, 'c_comment' TEXT)";
    $db->exec($query)or die("Failed to create table! ");//Do not touch
    //example of query when creating database
    if($db->exec($query)){
        $query="CREATE TABLE IF NOT EXISTS `cardholder`('c_cardid' INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, 'c_username' TEXT NOT NULL UNIQUE ON CONFLICT IGNORE, 'c_password' TEXT NOT NULL, 'c_address' TEXT NOT NULL, 'c_cityid' INTEGER NOT NULL, 'c_phone' INTEGER NOT NULL, 'c_acctbal' INTEGER, 'c_comment' TEXT)";
        $db->exec($query)or die("Failed to create table! ");//Do not touch

        //Example - //Do not touch
        $query="CREATE TABLE IF NOT EXISTS `City`('city_cityid' INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, 'city_name' TEXT NOT NULL, 'city_stateid' INTEGER NOT NULL, 'city_comment' TEXT NOT NULL)";
        $db->exec($query)or die("Failed to create table! ");
        

        //Modify these with relevant column attribute and also do insert
        $query="CREATE TABLE IF NOT EXISTS `loans`('l_loanid' INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, 'l_cardid' INTEGER NOT NULL, 'l_loandate' DATE, 'l_loanstatus' TEXT NOT NULL, 'l_loanlength' INTEGER NOT NULL, 'l_fees' INTEGER NOT NULL, 'l_feestatus' TEXT NOT NULL, 'l_comment' TEXT NOT NULL)";
        $db->exec($query)or die("Failed to create table! ");
        

        $query="CREATE TABLE IF NOT EXISTS `books`('b_bookid' INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
        'b_isbn' TEXT NOT NULL, 'b_title' TEXT NOT NULL,'b_year' INTEGER NOT NULL, 'b_genre' TEXT NOT NULL, 'b_condition' TEXT NOT NULL,'b_author' TEXT NOT NULL,  'b_comment' TEXT NOT NULL )";
        $db->exec($query)or die("Failed to create table! ");
        
        




        $query="CREATE TABLE IF NOT EXISTS `movies`('m_movieid' INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
        'm_title' TEXT NOT NULL,'m_length' INTEGER NOT NULL, 'm_star' TEXT NOT NULL, 'm_genre' TEXT NOT NULL, 'm_year' TEXT NOT NULL, 'm_condition' TEXT NOT NULL, 'm_comment' TEXT NOT NULL)";
        $db->exec($query)or die("Failed to create table! ");
        
        
        
        $query="CREATE TABLE IF NOT EXISTS `Loanmovies`('loanmovies_id' INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
        'loanmovies_loanid' INTEGER NOT NULL,'loanmovies_movieid' INTEGER NOT NULL)";
        $db->exec($query)or die("Failed to create table! ");
        
        
        
        $query="CREATE TABLE IF NOT EXISTS `Loanbooks`('loanbooks_id' INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
        'loanbooks_loanid' INTEGER NOT NULL,'loanbooks_bookid' INTEGER NOT NULL)";
        $db->exec($query)or die("Failed to create table! ");
        
        
        
        $query="CREATE TABLE IF NOT EXISTS `library`('lib_libid' INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, 'lib_name' TEXT NOT NULL,  'lib_address' TEXT NOT NULL,'lib_phone' INTEGER NOT NULL, 'lib_cityid' INTEGER NOT NULL, 'lib_comment' TEXT NOT NULL)";
        $db->exec($query)or die("Failed to create table! ");

        
    
        $query="CREATE TABLE IF NOT EXISTS `Libbooks`('libbooks_id' INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
        'libbooks_libid' INTEGER NOT NULL,'libbooks_bookid' INTEGER NOT NULL,'libbooks_amount' INTEGER NOT NULL)";
        $db->exec($query)or die("Failed to create table! ");

        

        $query="CREATE TABLE IF NOT EXISTS `Libmovies`('libmovies_id' INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
        'libmovies_libid' INTEGER NOT NULL,'libmovies_movieid' INTEGER NOT NULL,'libmovies_amount' INTEGER NOT NULL)";
        $db->exec($query)or die("Failed to create table! ");

        
        
        $query="CREATE TABLE IF NOT EXISTS `state`('s_stateid' INTEGER PRIMARY KEY AUTOINCREMENT,
        's_name' TEXT NOT NULL, 's_comment' TEXT NOT NULL)";
        $db->exec($query)or die("Failed to create table! ");

        
        

        // $csvFilepath = "csv/State.csv";
        // $file = fopen($csvFilepath, "r") or die("Unable to open csv file");
        // while(($row = fgetcsv($file))!== FALSE){
        //     $statement = $db->prepare('INSERT OR IGNORE INTO "state" ("s_name", "s_comment") VALUES (?,?)');
        //     $statement->bindParam(1,$row[0]);
        //     $statement->bindParam(2,$row[1]);
        //     $statement->execute()->finalize();
        // }

        
    }
    
    //etc
    $db->close();
    
?>