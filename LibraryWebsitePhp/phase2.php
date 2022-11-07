<?php 
    $db = new SQLite3('database/'. $databaseName) or die("Unable to open database!");

    //example of query when creating database
    $query="CREATE TABLE IF NOT EXISTS `cardholder`('c_cardid' INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, 'c_username' TEXT NOT NULL UNIQUE ON CONFLICT IGNORE, 'c_password' TEXT NOT NULL, 'c_address' TEXT NOT NULL, 'c_cityid' INTEGER NOT NULL, 'c_phone' INTEGER NOT NULL, 'c_acctbal' INTEGER, 'c_comment' TEXT)";
    $db->exec($query)or die("Failed to create table! ");//Do not touch

    //Example - //Do not touch
    $query="CREATE TABLE IF NOT EXISTS `City`('city_cityid' INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, 'city_name' TEXT  NOT NULL UNIQUE ON CONFLICT IGNORE, 'city_stateid' INTEGER NOT NULL, 'city_comment' TEXT NOT NULL)";
    $db->exec($query)or die("Failed to create table! ");
    $statement = $db->prepare('INSERT INTO "City" ("city_name","city_stateid","city_comment")VALUES ("Merced",5,"No comment")');
    $result = $statement->execute();
    $statement = $db->prepare('INSERT INTO "City" ("city_name","city_stateid","city_comment")VALUES ("Los Angeles",5,"No comment")');
    $result = $statement->execute();
    $statement = $db->prepare('INSERT INTO "City" ("city_name","city_stateid","city_comment")VALUES ("New York",32,"No comment")');
    $result = $statement->execute();
    $statement = $db->prepare('INSERT INTO "City" ("city_name","city_stateid","city_comment")VALUES ("Seatle",37,"No comment")');
    $result = $statement->execute();
    $statement = $db->prepare('INSERT INTO "City" ("city_name","city_stateid","city_comment")VALUES ("Sacramento",5,"No comment")');
    $result = $statement->execute();
    $statement = $db->prepare('INSERT INTO "City" ("city_name","city_stateid","city_comment")VALUES ("San Deigo",5,"No comment")');
    $result = $statement->execute();
    $statement = $db->prepare('INSERT INTO "City" ("city_name","city_stateid","city_comment")VALUES ("Miami",9,"No comment")');
    $result = $statement->execute();
    $statement = $db->prepare('INSERT INTO "City" ("city_name","city_stateid","city_comment")VALUES ("Las Vegas",28,"No comment")');
    $result = $statement->execute();
    $statement = $db->prepare('INSERT INTO "City" ("city_name","city_stateid","city_comment")VALUES ("Cleveland",35,"No comment")');
    $result = $statement->execute();
    
  
    
    // $db->exec($statement)or die("Failed to Insert");
    // $db->exec('COMMIT');

    //Modify these with relevant column attribute and also do insert
    $query="CREATE TABLE IF NOT EXISTS `loans`('l_loanid' INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, 'l_cardid' INTEGER NOT NULL, 'l_loandate' DATE, 'l_loanstatus' TEXT NOT NULL, 'l_loanlength' INTEGER NOT NULL, 'l_fees' INTEGER NOT NULL, 'l_feestatus' TEXT NOT NULL, 'l_comment' TEXT NOT NULL)";
    $db->exec($query)or die("Failed to create table! ");
    
    $query="CREATE TABLE IF NOT EXISTS `books`('b_bookid' INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
     'b_isbn' TEXT NOT NULL, 'b_title' TEXT NOT NULL,'b_year' INTEGER NOT NULL, 'b_genre' TEXT NOT NULL, 'b_condition' TEXT NOT NULL, 'b_comment' TEXT NOT NULL )";
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
    
    $query="CREATE TABLE IF NOT EXISTS `library`('lib_libid' INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, 'lib_name' TEXT NOT NULL UNIQUE ON CONFLICT IGNORE,  'lib_address' TEXT NOT NULL,'lib_phone' INTEGER NOT NULL, 'lib_cityid' INTEGER NOT NULL, 'lib_commend' TEXT NOT NULL)";
    $db->exec($query)or die("Failed to create table! ");
    $csvFilepath = "csv/";

    $query="CREATE TABLE IF NOT EXISTS `Libbooks`('libbooks_id' INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    'libbooks_libid' INTEGER NOT NULL,'libbooks_bookid' INTEGER NOT NULL,'libbooks_amount' INTEGER NOT NULL)";
    $db->exec($query)or die("Failed to create table! ");

    $query="CREATE TABLE IF NOT EXISTS `Libmovies`('libmovies_id' INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    'libmovies_libid' INTEGER NOT NULL,'libmovies_movieid' INTEGER NOT NULL,'libmovies_amount' INTEGER NOT NULL)";
    $db->exec($query)or die("Failed to create table! ");
    
    $query="CREATE TABLE IF NOT EXISTS `state`('s_stateid' INTEGER PRIMARY KEY AUTOINCREMENT,
     's_name' TEXT NOT NULL UNIQUE ON CONFLICT IGNORE, 's_comment' TEXT NOT NULL)";
    $db->exec($query)or die("Failed to create table! ");




    $csvFilepath = "csv/State.csv";
    $file = fopen($csvFilepath, "r") or die("Unable to open csv file");
    while(($row = fgetcsv($file))!== FALSE){
        $statement = $db->prepare('INSERT INTO "state" ("s_name", "s_comment") VALUES (?,?)');
        $statement->bindParam(1,$row[0]);
        $statement->bindParam(2,$row[1]);
        $statement->execute();
    }
    //etc
    
    
    
    
    
    
    
    $statement = $db->prepare('SELECT "b_title", "city_name","lib_name", "lib_address","lib_phone" FROM "City","library","Libbooks","books" WHERE "city_name" = ? AND "city_cityid" = "lib_cityid" AND "lib_libid" = "libbooks_libid" AND "libbooks_bookid" ="b_bookid" AND "b_title" LIKE "%".?."%"');
    $statement->bindValue(1, $searchCity);
    $statement->bindValue(1, $searchBook);


    $statement = $db->prepare('SELECT "b_title", "city_name","lib_name", "lib_address","lib_phone" FROM "City","library" WHERE "lib_name" = ? AND "city_cityid" = "lib_cityid" AND "lib_libid" = "libbooks_libid" AND "libbooks_bookid" = "b_bookid" AND "b_title" LIKE "%".?."%"');
    $statement->bindValue(1, $searchLibrary);
    $statement->bindValue(1, $searchBook);   
    
    
    $statement = $db->prepare('SELECT "c_cardid","c_username", "c_password" FROM "cardholder" WHERE "c_username" = ? AND "c_password" = ?');

            //binding values for the question mark
            $statement->bindValue(1, $username);
            $statement->bindValue(2, $password);

            
    $statement = $db->prepare('SELECT "city_cityid" FROM "City" WHERE "city_name" = ?');
    $statement->bindValue(1, $city);
    $result = $statement->execute();

    $statement = $db->prepare('INSERT INTO "cardholder" ("c_username","c_password","c_address","c_cityid","c_phone","c_acctbal","c_comment")VALUES (?,?,?,?,?,?,?)');
            $statement->bindValue(1, $username);
            $statement->bindValue(2, $password);
            $statement->bindValue(3, $homeAdress);
            $statement->bindValue(4,$ROW['city_cityid']);
            $statement->bindValue(5, $phoneNumber);
            $statement->bindValue(6, 0);
            $statement->bindValue(7,"No comment");
    

    $db->exec('BEGIN');
            $statement  = $db->prepare('SELECT "city_name" FROM "City"');
            $result = $statement->execute();
            $db->exec('COMMIT');
            
            while($rows=$result->fetchArray()){
                // echo $rows['city_name'];
                echo '<option value="'.$rows['city_name'].'">'.$rows['city_name'].'</option>';
            }
    
    $db->exec('BEGIN');
            $statement = $db->prepare('SELECT "c_cardid","c_username","c_password" FROM "cardholder" WHERE "c_username" = ? AND "c_password" = ?');
            $statement->bindValue(1, $username);
            $statement->bindValue(2, $oldpassword);
            $result = $statement->execute();
            $db->exec('COMMIT');
    
    $db->exec('BEGIN');
            $statement = $db->prepare('UPDATE "cardholder" SET "c_password" = ? WHERE "c_password" = ? AND "c_username" = ?');
            $statement->bindValue(1, $newpassword);
            $statement->bindValue(2,$oldpassword);
            $statement->bindValue(3,$username);
            $result = $statement->execute();
            $db->exec('COMMIT');
    $db->close();

    $db->exec('BEGIN');
            $statement = $db->prepare('DELETE FROM "Libboks" WHERE "lib_books_bookid" = ? ORDER BY "libbooks_libid" LIMIT 1');
            $statement->bindValue(1, $picked);
            $result = $statement->execute();
            $db->exec('COMMIT');
    $db->close();

    $db->exec('BEGIN');
            $statement = $db->prepare('INSERT INTO "Loanmovies"("loanmovies_loanid","loanbooks_bookid") VALUES (?,?)');
            $statement->bindValue(1, $loanid);
            $statement->bindValue(2, $picked);
            $result = $statement->execute();
            $db->exec('COMMIT');
    $db->close();
           
    $statement = $db->prepare('SELECT "b_title", "l_loandate","l_fees" FROM "cardholder", "loans","books","Loanbooks" WHERE "c_cardid" = "l_cardid" AND "l_loanid" = "loanbooks_loanid" AND "loanbooks_bookid" = "b_bookid"');
							
        $statement1 = $db->prepare('SELECT * FROM "cardholder", "loans","movies","Loanmovies" WHERE "c_cardid" = "l_cardid" AND "l_loanid" = "loanmovies_loanid" AND "loanmovies_movieid" = "m_movieid"');
							


?>