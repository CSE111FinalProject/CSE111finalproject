
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
        // $statement = $db->prepare('INSERT OR IGNORE INTO "City" ("city_name","city_stateid","city_comment")VALUES ("Merced",5,"No comment")');
        // $result = $statement->execute()->finalize();
        // $statement = $db->prepare('INSERT OR IGNORE INTO "City" ("city_name","city_stateid","city_comment")VALUES ("Los Angeles",5,"No comment")');
        // $result = $statement->execute()->finalize();
        // $statement = $db->prepare('INSERT OR IGNORE INTO "City" ("city_name","city_stateid","city_comment")VALUES ("New York",32,"No comment")');
        // $result = $statement->execute()->finalize();
        // $statement = $db->prepare('INSERT OR IGNORE INTO "City" ("city_name","city_stateid","city_comment")VALUES ("Seatle",37,"No comment")');
        // $result = $statement->execute()->finalize();
        // $statement = $db->prepare('INSERT OR IGNORE INTO "City" ("city_name","city_stateid","city_comment")VALUES ("Sacramento",5,"No comment")');
        // $result = $statement->execute()->finalize();
        // $statement = $db->prepare('INSERT OR IGNORE INTO "City" ("city_name","city_stateid","city_comment")VALUES ("San Deigo",5,"No comment")');
        // $result = $statement->execute()->finalize();
        // $statement = $db->prepare('INSERT OR IGNORE INTO "City" ("city_name","city_stateid","city_comment")VALUES ("Miami",9,"No comment")');
        // $result = $statement->execute()->finalize();
        // $statement = $db->prepare('INSERT OR IGNORE INTO "City" ("city_name","city_stateid","city_comment")VALUES ("Las Vegas",28,"No comment")');
        // $result = $statement->execute()->finalize();
        // $statement = $db->prepare('INSERT OR IGNORE INTO "City" ("city_name","city_stateid","city_comment")VALUES ("Cleveland",35,"No comment")');
        // $result = $statement->execute()->finalize();
        
    
        
        // $db->exec($statement)or die("Failed to Insert");
        // $db->exec('COMMIT');

        //Modify these with relevant column attribute and also do insert
        $query="CREATE TABLE IF NOT EXISTS `loans`('l_loanid' INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, 'l_cardid' INTEGER NOT NULL, 'l_loandate' DATE, 'l_loanstatus' TEXT NOT NULL, 'l_loanlength' INTEGER NOT NULL, 'l_fees' INTEGER NOT NULL, 'l_feestatus' TEXT NOT NULL, 'l_comment' TEXT NOT NULL)";
        $db->exec($query)or die("Failed to create table! ");
        $statement = $db->prepare('INSERT OR IGNORE INTO "loans" ("l_cardid","l_loandate","l_loanstatus","l_loanlength","l_fees","l_feestatus","l_comment")VALUES (1,datetime("now"),"Active",5,0,"F","Loan1")');
        $result = $statement->execute()->finalize();
        $statement = $db->prepare('INSERT OR IGNORE INTO "loans" ("l_cardid","l_loandate","l_loanstatus","l_loanlength","l_fees","l_feestatus","l_comment")VALUES (2,datetime("now"),"Active",5,0,"F","Loan2")');
        $result = $statement->execute()->finalize();
        $statement = $db->prepare('INSERT OR IGNORE INTO "loans" ("l_cardid","l_loandate","l_loanstatus","l_loanlength","l_fees","l_feestatus","l_comment")VALUES (3,datetime("now"),"Active",5,0,"F","Loan3")');
        $result = $statement->execute()->finalize();
        $statement = $db->prepare('INSERT OR IGNORE INTO "loans" ("l_cardid","l_loandate","l_loanstatus","l_loanlength","l_fees","l_feestatus","l_comment")VALUES (4,datetime("now"),"Active",5,0,"F","Loan4")');
        $result = $statement->execute()->finalize();
        $statement = $db->prepare('INSERT OR IGNORE INTO "loans" ("l_cardid","l_loandate","l_loanstatus","l_loanlength","l_fees","l_feestatus","l_comment")VALUES (5,datetime("now"),"Active",5,0,"F","Loan5")');
        $result = $statement->execute()->finalize();
        $statement = $db->prepare('INSERT OR IGNORE INTO "loans" ("l_cardid","l_loandate","l_loanstatus","l_loanlength","l_fees","l_feestatus","l_comment")VALUES (6,datetime("now"),"Active",5,0,"F","Loan6")');
        $result = $statement->execute()->finalize();
        $statement = $db->prepare('INSERT OR IGNORE INTO "loans" ("l_cardid","l_loandate","l_loanstatus","l_loanlength","l_fees","l_feestatus","l_comment")VALUES (7,datetime("now"),"Active",5,0,"F","Loan7")');
        $result = $statement->execute()->finalize();
        $statement = $db->prepare('INSERT OR IGNORE INTO "loans" ("l_cardid","l_loandate","l_loanstatus","l_loanlength","l_fees","l_feestatus","l_comment")VALUES (8,datetime("now"),"Active",5,0,"F","Loan8")');
        $result = $statement->execute()->finalize();
        $statement = $db->prepare('INSERT OR IGNORE INTO "loans" ("l_cardid","l_loandate","l_loanstatus","l_loanlength","l_fees","l_feestatus","l_comment")VALUES (9,datetime("now"),"Active",5,0,"F","Loan9")');
        $result = $statement->execute()->finalize();
        
        // $statement = $db->prepare('');
        // $result = $statement->execute();

        $query="CREATE TABLE IF NOT EXISTS `books`('b_bookid' INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
        'b_isbn' TEXT NOT NULL, 'b_title' TEXT NOT NULL,'b_year' INTEGER NOT NULL, 'b_genre' TEXT NOT NULL, 'b_condition' TEXT NOT NULL,'b_author' TEXT NOT NULL,  'b_comment' TEXT NOT NULL )";
        $db->exec($query)or die("Failed to create table! ");
        
        // $statement = $db->prepare('INSERT OR IGNORE INTO "books" ("b_isbn","b_title","b_year","b_genre","b_condition","b_comment")VALUES ("978-0590353427","Harry Potter and the Sorcerer`s Stone",2015,"Fiction","Good","Review - ")');
        // $result = $statement->execute()->finalize();
        // $statement = $db->prepare('INSERT OR IGNORE INTO "books" ("b_isbn","b_title","b_year","b_genre","b_condition","b_comment")VALUES ("978-1668001226","It Starts with Us: A Novel (It Ends with Us)",2022,"Novel","Good","Review - ")');
        // $result = $statement->execute()->finalize();
        // $statement = $db->prepare('INSERT OR IGNORE INTO "books" ("b_isbn","b_title","b_year","b_genre","b_condition","b_comment")
        // VALUES ("978-0-380-60012-0", "The Indian in the Cupboard", 1980, "Fantasy", "Good", "Review -")');
        // $result = $statement->execute()->finalize();
        // $statement = $db->prepare('INSERT OR IGNORE INTO "books" ("b_isbn","b_title","b_year","b_genre","b_condition","b_comment")
        // VALUES ("978-0-7432-4722-1", "Fahrenheit 451", 1953, "Fantasy", "Good", "Review -")');
        // $result = $statement->execute()->finalize();
        // $statement = $db->prepare('INSERT OR IGNORE INTO "books" ("b_isbn","b_title","b_year","b_genre","b_condition","b_comment")
        // VALUES ("978-0199588220", "The Secret Garden", 2011, "Childrens Novel", "Good", "Review -")');
        // $result = $statement->execute()->finalize();
        // $statement = $db->prepare('INSERT OR IGNORE INTO "books" ("b_isbn","b_title","b_year","b_genre","b_condition","b_comment")
        // VALUES ("978-0-439-02352-8", "The Hunger Games", 2008, "Sci-fi", "Good", "Review -")');
        // $result = $statement->execute()->finalize();
        // $statement = $db->prepare('INSERT OR IGNORE INTO "books" ("b_isbn","b_title","b_year","b_genre","b_condition","b_comment")
        // VALUES ("978-0-545-22724-7", "Catching Fire", 2009, "Sci-fi", "Good", "Review -")');
        // $result = $statement->execute()->finalize();
        // $statement = $db->prepare('INSERT OR IGNORE INTO "books" ("b_isbn","b_title","b_year","b_genre","b_condition","b_comment")
        // VALUES ("978-0-439-02351-1", "Mockingjay", 2010, "Sci-fi", "Good", "Review -")');
        // $result = $statement->execute()->finalize();
        // $statement = $db->prepare('INSERT OR IGNORE INTO "books" ("b_isbn","b_title","b_year","b_genre","b_condition","b_comment")
        // VALUES ("978-0931988653", "Your Atari Computer: A Guide to Atari 400/800 Computers", 1982, "Manual", "Good", "Review -")');
        // $result = $statement->execute()->finalize();
        // $statement = $db->prepare('INSERT OR IGNORE INTO "books" ("b_isbn","b_title","b_year","b_genre","b_condition","b_comment")
        // VALUES ("0-935696-01-6", "Players Handbook", 1978, "Manual", "Good", "Review -")');
        // $result = $statement->execute()->finalize();




        $query="CREATE TABLE IF NOT EXISTS `movies`('m_movieid' INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
        'm_title' TEXT NOT NULL,'m_length' INTEGER NOT NULL, 'm_star' TEXT NOT NULL, 'm_genre' TEXT NOT NULL, 'm_year' TEXT NOT NULL, 'm_condition' TEXT NOT NULL, 'm_comment' TEXT NOT NULL)";
        $db->exec($query)or die("Failed to create table! ");
        
        // $statement = $db->prepare('INSERT OR IGNORE INTO "movies" ("m_title","m_length","m_star","m_genre","m_year","m_condition","m_comment")VALUES ("Top Gun: Maverick",130,"Tom Cruise","Drama, Adventure, Action",2022,"Good","Review - Good Movie")');
        // $result = $statement->execute()->finalize();
        // $statement = $db->prepare('INSERT OR IGNORE INTO "movies" ("m_title","m_length","m_star","m_genre","m_year","m_condition","m_comment")VALUES ("Bullet Train",126,"Brad Pitt","Suspense, Comedy, Action",2022,"Good","Review - Good Movie")');
        // $result = $statement->execute()->finalize();
        // $statement = $db->prepare('INSERT OR IGNORE INTO "movies" ("m_title","m_length","m_star","m_genre","m_year","m_condition","m_comment")VALUES ("The Adventures of Sharkboy and Lavagirl in 3-D", 93, "Taylor Lautner", "Superhero, Adventure", 2005, "Good", "Review - Good Movie")');
        // $result = $statement->execute()->finalize();
        // $statement = $db->prepare('INSERT OR IGNORE INTO "movies" ("m_title","m_length","m_star","m_genre","m_year","m_condition","m_comment")VALUES ("Speed", 116, "Keanu Reeves", "Action", 1994, "Good", "Review - Good Movie")');
        // $result = $statement->execute()->finalize();
        // $statement = $db->prepare('INSERT OR IGNORE INTO "movies" ("m_title","m_length","m_star","m_genre","m_year","m_condition","m_comment")VALUES ("Speed 2: Cruise Control", 126, "Sandra Bullock", "Action", 1997, "not as good", "Review - Good Movie")');
        // $result = $statement->execute()->finalize();
        // $statement = $db->prepare('INSERT OR IGNORE INTO "movies" ("m_title","m_length","m_star","m_genre","m_year","m_condition","m_comment")VALUES ("The Matrix", 136, "Keanu Reeves", "Action, Sci-fi", 1999, "Good", "Review - Very Good Movie")');
        // $result = $statement->execute()->finalize();
        // $statement = $db->prepare('INSERT OR IGNORE INTO "movies" ("m_title","m_length","m_star","m_genre","m_year","m_condition","m_comment")VALUES ("The Matrix Reloaded", 138, "Keanu Reeves", "Action, Sci-fi", 2003, "Good", "Review - Very Good Movie")');
        // $result = $statement->execute()->finalize();
        // $statement = $db->prepare('INSERT OR IGNORE INTO "movies" ("m_title","m_length","m_star","m_genre","m_year","m_condition","m_comment")VALUES ("The Matrix Revolutions", 129, "Keanu Reeves", "Action, Sci-fi", 2003, "Good", "Review - Very Good Movie")');
        // $result = $statement->execute()->finalize();
        // $statement = $db->prepare('INSERT OR IGNORE INTO "movies" ("m_title","m_length","m_star","m_genre","m_year","m_condition","m_comment")VALUES ("The Matrix Resurrections", 148, "Keanu Reeves", "Action, Sci-fi", 2021, "Good", "Review - Very Good Movie")');
        // $result = $statement->execute()->finalize();
        // $statement = $db->prepare('INSERT OR IGNORE INTO "movies" ("m_title","m_length","m_star","m_genre","m_year","m_condition","m_comment")VALUES ("The Matrix Revisited", 123, "Lana & Lilly Wachowski", "Documentory", 2001, "Good", "Review - Good Movie")');
        // $result = $statement->execute()->finalize();
        
        $query="CREATE TABLE IF NOT EXISTS `Loanmovies`('loanmovies_id' INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
        'loanmovies_loanid' INTEGER NOT NULL,'loanmovies_movieid' INTEGER NOT NULL)";
        $db->exec($query)or die("Failed to create table! ");
        
        $statement = $db->prepare('INSERT OR IGNORE INTO "Loanmovies" ("loanmovies_id","loanmovies_loanid","loanmovies_movieid")VALUES (1,1,1)');
        $result = $statement->execute()->finalize();
        $statement = $db->prepare('INSERT OR IGNORE INTO "Loanmovies" ("loanmovies_id","loanmovies_loanid","loanmovies_movieid")VALUES (2,2,2)');
        $result = $statement->execute()->finalize();
        $statement = $db->prepare('INSERT OR IGNORE INTO "Loanmovies" ("loanmovies_id","loanmovies_loanid","loanmovies_movieid")VALUES (3,2,3)');
        $result = $statement->execute()->finalize();
        $statement = $db->prepare('INSERT OR IGNORE INTO "Loanmovies" ("loanmovies_id","loanmovies_loanid","loanmovies_movieid")VALUES (4,3,4)');
        $result = $statement->execute()->finalize();
        $statement = $db->prepare('INSERT OR IGNORE INTO "Loanmovies" ("loanmovies_id","loanmovies_loanid","loanmovies_movieid")VALUES (5,4,5)');
        $result = $statement->execute()->finalize();
        $statement = $db->prepare('INSERT OR IGNORE INTO "Loanmovies" ("loanmovies_id","loanmovies_loanid","loanmovies_movieid")VALUES (6,5,6)');
        $result = $statement->execute()->finalize();
        $statement = $db->prepare('INSERT OR IGNORE INTO "Loanmovies" ("loanmovies_id","loanmovies_loanid","loanmovies_movieid")VALUES (7,6,7)');
        $result = $statement->execute()->finalize();
        $statement = $db->prepare('INSERT OR IGNORE INTO "Loanmovies" ("loanmovies_id","loanmovies_loanid","loanmovies_movieid")VALUES (8,7,8)');
        $result = $statement->execute()->finalize();
        $statement = $db->prepare('INSERT OR IGNORE INTO "Loanmovies" ("loanmovies_id","loanmovies_loanid","loanmovies_movieid")VALUES (9,8,9)');
        $result = $statement->execute()->finalize();
        
        $query="CREATE TABLE IF NOT EXISTS `Loanbooks`('loanbooks_id' INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
        'loanbooks_loanid' INTEGER NOT NULL,'loanbooks_bookid' INTEGER NOT NULL)";
        $db->exec($query)or die("Failed to create table! ");
        
        $statement = $db->prepare('INSERT OR IGNORE INTO "Loanbooks" ("loanbooks_id","loanbooks_loanid","loanbooks_bookid")VALUES (1,1,1)');
        $result = $statement->execute()->finalize();
        $statement = $db->prepare('INSERT OR IGNORE INTO "Loanbooks" ("loanbooks_id","loanbooks_loanid","loanbooks_bookid")VALUES (2,2,2)');
        $result = $statement->execute()->finalize();
        $statement = $db->prepare('INSERT OR IGNORE INTO "Loanbooks" ("loanbooks_id","loanbooks_loanid","loanbooks_bookid")VALUES (3,3,3)');
        $result = $statement->execute()->finalize();
        $statement = $db->prepare('INSERT OR IGNORE INTO "Loanbooks" ("loanbooks_id","loanbooks_loanid","loanbooks_bookid")VALUES (4,4,4)');
        $result = $statement->execute()->finalize();
        $statement = $db->prepare('INSERT OR IGNORE INTO "Loanbooks" ("loanbooks_id","loanbooks_loanid","loanbooks_bookid")VALUES (5,5,5)');
        $result = $statement->execute()->finalize();
        $statement = $db->prepare('INSERT OR IGNORE INTO "Loanbooks" ("loanbooks_id","loanbooks_loanid","loanbooks_bookid")VALUES (6,6,6)');
        $result = $statement->execute()->finalize();
        $statement = $db->prepare('INSERT OR IGNORE INTO "Loanbooks" ("loanbooks_id","loanbooks_loanid","loanbooks_bookid")VALUES (7,7,7)');
        $result = $statement->execute()->finalize();
        $statement = $db->prepare('INSERT OR IGNORE INTO "Loanbooks" ("loanbooks_id","loanbooks_loanid","loanbooks_bookid")VALUES (8,8,8)');
        $result = $statement->execute()->finalize();
        $statement = $db->prepare('INSERT OR IGNORE INTO "Loanbooks" ("loanbooks_id","loanbooks_loanid","loanbooks_bookid")VALUES (9,1,9)');
        $result = $statement->execute()->finalize();
        $statement = $db->prepare('INSERT OR IGNORE INTO "Loanbooks" ("loanbooks_id","loanbooks_loanid","loanbooks_bookid")VALUES (10,9,10)');
        $result = $statement->execute()->finalize();
        
        $query="CREATE TABLE IF NOT EXISTS `library`('lib_libid' INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, 'lib_name' TEXT NOT NULL,  'lib_address' TEXT NOT NULL,'lib_phone' INTEGER NOT NULL, 'lib_cityid' INTEGER NOT NULL, 'lib_comment' TEXT NOT NULL)";
        $db->exec($query)or die("Failed to create table! ");

        // $statement = $db->prepare('INSERT OR IGNORE INTO "library" ("lib_name","lib_address","lib_phone","lib_cityid","lib_comment")VALUES ("UC Merced Library","5200 N. Lake Road, 5200 Lake Rd #275, Merced, CA 95343",209-228-4444,1,"University")');
        // $result = $statement->execute()->finalize();
        // $statement = $db->prepare('INSERT OR IGNORE INTO "library" ("lib_name","lib_address","lib_phone","lib_cityid","lib_comment")
        // VALUES ("UC Berkeley Library", "350 Moffitt Library, Berkeley, CA 94720", 510-642-5072, 1, "University")');
        // $result = $statement->execute()->finalize();
        // $statement = $db->prepare('INSERT OR IGNORE INTO "library" ("lib_name","lib_address","lib_phone","lib_cityid","lib_comment")
        // VALUES ("UC Davis Library", "100 NW Quad, Davis, CA 95616", 530-752-8792, 1, "University")');
        // $result = $statement->execute()->finalize();
        // $statement = $db->prepare('INSERT OR IGNORE INTO "library" ("lib_name","lib_address","lib_phone","lib_cityid","lib_comment")
        // VALUES ("UCI Law Library", "401 E Peltason Dr, Unit 1000, Irvine, CA 92697", 949-824-2404, 1, "University")');
        // $result = $statement->execute()->finalize();

        // $statement = $db->prepare('INSERT OR IGNORE INTO "library" ("lib_name","lib_address","lib_phone","lib_cityid","lib_comment")
        // VALUES ("Geisel Library", "9500 Gilman Dr, La Jolla, CA 92093-5004", 8585343336, 1, "University")');
        // $result = $statement->execute()->finalize();
    
        $query="CREATE TABLE IF NOT EXISTS `Libbooks`('libbooks_id' INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
        'libbooks_libid' INTEGER NOT NULL,'libbooks_bookid' INTEGER NOT NULL,'libbooks_amount' INTEGER NOT NULL)";
        $db->exec($query)or die("Failed to create table! ");

        $statement = $db->prepare('INSERT OR IGNORE INTO "Libbooks" ("libbooks_libid","libbooks_bookid","libbooks_amount")VALUES (1,1,1)');
        $result = $statement->execute()->finalize();
        $statement = $db->prepare('INSERT OR IGNORE INTO "Libbooks" ("libbooks_libid","libbooks_bookid","libbooks_amount")VALUES (3,1,11)');
        $result = $statement->execute()->finalize();
        $statement = $db->prepare('INSERT OR IGNORE INTO "Libbooks" ("libbooks_libid","libbooks_bookid","libbooks_amount")VALUES (1,2,2)');
        $result = $statement->execute()->finalize();
        $statement = $db->prepare('INSERT OR IGNORE INTO "Libbooks" ("libbooks_libid","libbooks_bookid","libbooks_amount")VALUES (2,3,3)');
        $result = $statement->execute()->finalize();
        $statement = $db->prepare('INSERT OR IGNORE INTO "Libbooks" ("libbooks_libid","libbooks_bookid","libbooks_amount")VALUES (2,4,4)');
        $result = $statement->execute()->finalize();
        $statement = $db->prepare('INSERT OR IGNORE INTO "Libbooks" ("libbooks_libid","libbooks_bookid","libbooks_amount")VALUES (3,5,5)');
        $result = $statement->execute()->finalize();
        $statement = $db->prepare('INSERT OR IGNORE INTO "Libbooks" ("libbooks_libid","libbooks_bookid","libbooks_amount")VALUES (4,6,6)');
        $result = $statement->execute()->finalize();
        $statement = $db->prepare('INSERT OR IGNORE INTO "Libbooks" ("libbooks_libid","libbooks_bookid","libbooks_amount")VALUES (4,7,7)');
        $result = $statement->execute()->finalize();
        $statement = $db->prepare('INSERT OR IGNORE INTO "Libbooks" ("libbooks_libid","libbooks_bookid","libbooks_amount")VALUES (4,8,8)');
        $result = $statement->execute()->finalize();
        $statement = $db->prepare('INSERT OR IGNORE INTO "Libbooks" ("libbooks_libid","libbooks_bookid","libbooks_amount")VALUES (5,9,9)');
        $result = $statement->execute()->finalize();
        $statement = $db->prepare('INSERT OR IGNORE INTO "Libbooks" ("libbooks_libid","libbooks_bookid","libbooks_amount")VALUES (5,10,10)');
        $result = $statement->execute()->finalize();

        $query="CREATE TABLE IF NOT EXISTS `Libmovies`('libmovies_id' INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
        'libmovies_libid' INTEGER NOT NULL,'libmovies_movieid' INTEGER NOT NULL,'libmovies_amount' INTEGER NOT NULL)";
        $db->exec($query)or die("Failed to create table! ");

        $statement = $db->prepare('INSERT OR IGNORE INTO "Libmovies" ("libmovies_libid","libmovies_movieid","libmovies_amount")VALUES (1,1,1)');
        $result = $statement->execute()->finalize();
        $statement = $db->prepare('INSERT OR IGNORE INTO "Libmovies" ("libmovies_libid","libmovies_movieid","libmovies_amount")VALUES (1,2,2)');
        $result = $statement->execute()->finalize();
        $statement = $db->prepare('INSERT OR IGNORE INTO "Libmovies" ("libmovies_libid","libmovies_movieid","libmovies_amount")VALUES (2,3,3)');
        $result = $statement->execute()->finalize();
        $statement = $db->prepare('INSERT OR IGNORE INTO "Libmovies" ("libmovies_libid","libmovies_movieid","libmovies_amount")VALUES (3,4,4)');
        $result = $statement->execute()->finalize();
        $statement = $db->prepare('INSERT OR IGNORE INTO "Libmovies" ("libmovies_libid","libmovies_movieid","libmovies_amount")VALUES (4,5,5)');
        $result = $statement->execute()->finalize();
        $statement = $db->prepare('INSERT OR IGNORE INTO "Libmovies" ("libmovies_libid","libmovies_movieid","libmovies_amount")VALUES (4,6,6)');
        $result = $statement->execute()->finalize();
        $statement = $db->prepare('INSERT OR IGNORE INTO "Libmovies" ("libmovies_libid","libmovies_movieid","libmovies_amount")VALUES (4,7,7)');
        $result = $statement->execute()->finalize();
        $statement = $db->prepare('INSERT OR IGNORE INTO "Libmovies" ("libmovies_libid","libmovies_movieid","libmovies_amount")VALUES (5,8,8)');
        $result = $statement->execute()->finalize();
        $statement = $db->prepare('INSERT OR IGNORE INTO "Libmovies" ("libmovies_libid","libmovies_movieid","libmovies_amount")VALUES (5,9,9)');
        $result = $statement->execute()->finalize();
        $statement = $db->prepare('INSERT OR IGNORE INTO "Libmovies" ("libmovies_libid","libmovies_movieid","libmovies_amount")VALUES (1,10,10)');
        $result = $statement->execute()->finalize();
        
        $query="CREATE TABLE IF NOT EXISTS `state`('s_stateid' INTEGER PRIMARY KEY AUTOINCREMENT,
        's_name' TEXT NOT NULL, 's_comment' TEXT NOT NULL)";
        $db->exec($query)or die("Failed to create table! ");

        // $statement = $db->prepare('');
        // $result = $statement->execute();
        

        $csvFilepath = "csv/State.csv";
        $file = fopen($csvFilepath, "r") or die("Unable to open csv file");
        while(($row = fgetcsv($file))!== FALSE){
            $statement = $db->prepare('INSERT OR IGNORE INTO "state" ("s_name", "s_comment") VALUES (?,?)');
            $statement->bindParam(1,$row[0]);
            $statement->bindParam(2,$row[1]);
            $statement->execute()->finalize();
        }

        
    }
    
    //etc
    $db->close();
    
?>