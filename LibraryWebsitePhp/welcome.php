<!DOCTYPE html> 
<html lang="en">
    <head>
        <meta charset="="UTF-8">
        <meta http-equiv="X-UA-Compatile" content="IE=edge">
        <meta name="viewport" content="width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
        <?php
        header('Content-type: text/plain');
            //echo "HelloWorld<br>\n";
            //echo "Date is: ". date('j-m-y,h:i:s');
            
            //$db = new SQLite3('tpch.sqlite');
            // $statement = $db->prepare('SELECT username, password FROM login WHERE username = :username AND password = :password;');
            // $statement->bindValue(':username',$username, ':password',$password);
            // $result = $statement->execute();
            // $row = $result->fetchArray();
            // echo $row;
            //$serverName = "serverName\\sqlexpress"; //serverName\instanceName

// Since UID and PWD are not specified in the $connectionInfo array,
// The connection will be attempted using Windows Authentication.

// $connectionInfo = array( "Database"=>"RalphT");
//$conn = sqlsrv_connect( $serverName, $connectionInfo);  
// if( $conn ) {
//      echo "Connection established.<br />";
// }else{
//      echo "Connection could not be established.<br />";
//      die( print_r( sqlsrv_errors(), true)); 
// }   
// This file walks you through the most common features of PHP's SQLite3 API.
// The code is runnable in its entirety and results in an `analytics.sqlite` file.


// Create a new database, if the file doesn't exist and open it for reading/writing.
// The extension of the file is arbitrary.
$db = new SQLite3('analytics.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);

// Errors are emitted as warnings by default, enable proper error handling.
$db->enableExceptions(true);


// Create a table.

$db->query('CREATE TABLE IF NOT EXISTS "visits" (
    "id" INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    "user_id" INTEGER,
    "url" VARCHAR,
    "time" DATETIME
)');


// Insert some sample data.
//
// INSERTs may seem very slow in SQLite, which happens when not using transactions.
// It's advisable to wrap related queries in a transaction (BEGIN and COMMIT),
// even if you don't care about atomicity.
// If you don't do this, SQLite automatically wraps every single query
// in a transaction, which slows everything down immensely.

$db->exec('BEGIN');
$db->query('INSERT INTO "visits" ("user_id", "url", "time")
    VALUES (42, "/test", "2017-01-14 10:11:23")');
$db->query('INSERT INTO "visits" ("user_id", "url", "time")
    VALUES (42, "/test2", "2017-01-14 10:11:44")');
$db->exec('COMMIT');


// Insert potentially unsafe data with a prepared statement.
// You can do this with named parameters:

$statement = $db->prepare('INSERT INTO "visits" ("user_id", "url", "time")
    VALUES (:uid, :url, :time)');
$statement->bindValue(':uid', 1337);
$statement->bindValue(':url', '/test');
$statement->bindValue(':time', date('Y-m-d H:i:s'));
$statement->execute(); // you can reuse the statement with different values


// Fetch today's visits of user #42.
// We'll use a prepared statement again, but with numbered parameters this time:

$statement = $db->prepare('SELECT * FROM "visits" WHERE "user_id" = ? AND "time" >= ?');
//$statement = $db->prepare('SELECT * FROM "visits"');
$statement->bindValue(1, 42);
$statement->bindValue(2, '2017-01-14');
$result = $statement->execute();
list($id,$user_id,$url,$time) = $result->fetchArray(PDO::FETCH_NUM);
print_r($user_id);

echo("Get the 1st row as an associative array:\n");
//$i = 0;
// while($res = $result->fetchArray(SQLITE3_ASSOC)){
//     if(!isset($res['id'])) {continue;}
//     $row[$i]['id'] = $res['id'];
//     $row[$i]['user_id'] = $res['user_id'];
//     $row[$i]['url'] = $res['url'];
//     $row[$i]['time'] = $res['time'];
//     $i++;
// }
//$res = $result->fetchArray(SQLITE3_ASSOC);
print_r($result->fetchArray(SQLITE3_ASSOC));
//print_r($res[1]['user_id']);
echo("\n");

echo("Get the next row as a numeric array:\n");
print_r($result->fetchArray(SQLITE3_NUM));
echo("\n");

// If there are no more rows, fetchArray() returns FALSE.

// free the memory, this in NOT done automatically, while your script is running
$result->finalize();


// A useful shorthand for fetching a single row as an associative array.
// The second parameter means we want all the selected columns.
//
// Watch out, this shorthand doesn't support parameter binding, but you can
// escape the strings instead.
// Always put the values in SINGLE quotes! Double quotes are used for table
// and column names (similar to backticks in MySQL).

$query = 'SELECT * FROM "visits" WHERE "url" = \'' .
    SQLite3::escapeString('/test') .
    '\' ORDER BY "id" DESC LIMIT 1';

$lastVisit = $db->querySingle($query, true);

echo("Last visit of '/test':\n");
print_r($lastVisit);
echo("\n");


// Another useful shorthand for retrieving just one value.

$userCount = $db->querySingle('SELECT COUNT(DISTINCT "user_id") FROM "visits"');

echo("User count: $userCount\n");
echo("\n");


// Finally, close the database.
// This is done automatically when the script finishes, though.

$db->close();
        ?>
    </body>
</html>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Nations in tpch</title>
	<!-- CSS stylinng -->
	<style>
		table {
			margin: 0 auto;
			font-size: large;
			border: 1px solid black;
		}

		h1 {
			text-align: center;
			color: red;
			font-size: xx-large;
			font-family: 'Gill Sans', 'Gill Sans MT',
			' Calibri', 'Trebuchet MS', 'sans-serif';
		}

		td {
			background-color: tan;
			border: 1px solid black;
		}

		th,
		td {
			font-weight: bold;
			border: 1px solid black;
			padding: 10px;
			text-align: center;
		}

		td {
			font-weight: lighter;
		}
	</style>
</head>


<?php
				// LOOP TILL END OF DATA
				while($rows=$result->fetchArray(PDO::FETCH_NUM))
				{
			?>
			<tr>
				<!-- FETCHING DATA FROM EACH
					ROW OF EVERY COLUMN -->
					<td><?php echo $rows['user_id'];?></td>
					<td><?php echo $rows['username'];?></td>
					<td><?php echo $rows['password'];?></td>
				
			</tr>
			<?php
				}
                $db->close();
			?>
			<?php ?>

 <?php 
                                $db = new SQLite3('../database/librarydatabase.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
                                $db->enableExceptions(true);
                                $db->exec('BEGIN');
                                $statement = $db->prepare('SELECT "city_name" FROM "City"');
                                $result = $statement->execute();                               
                                $db->exec('COMMIT');
                                while($rows=$result->fetchArray(PDO::FETCH_NUM)){
                            ?>
                                <option value=<?php echo $rows['city_name'];?>><?php echo $rows['city_name'];?></option>
                                <?php
                                }
                                $db->close();
                            ?>
							
							



							<?php

require_once 'vendor/autoload.php';

use leoshtika\libs\Pagination;
use leoshtika\libs\Sqlite;
use leoshtika\libs\UserFaker;

$sqliteFile = 'demo.sqlite';

// Create a new sqlite db if not exists and load some dummy data. 
// After the database is created, you don't need this line of code anymore
UserFaker::create($sqliteFile, 120);

$dbh = Sqlite::connect($sqliteFile);

// Get the total number of records
$totalRecords = $dbh->query('SELECT count(*) FROM user')->fetch(PDO::FETCH_COLUMN);

// Instantiate the Pagination
$pagination = new Pagination($_GET['page'], $totalRecords, 10);

// Get records using the pagination
$sth = $dbh->prepare('SELECT * FROM user LIMIT :offset, :records');
$sth->bindValue(':offset', $pagination->offset(), PDO::PARAM_INT);
$sth->bindValue(':records', $pagination->getRecordsPerPage(), PDO::PARAM_INT);
$sth->execute();
$users = $sth->fetchAll(PDO::FETCH_OBJ);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Pagination</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
</head>
<body class="container-fluid">
    
    <h1>Pagination!</h1>
    <table class="table table-bordered table-hover">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Address</th>
            <th>Phone</th>
        </tr>
        <?php foreach ($users as $user) : ?>
            <tr>
                <td><?php echo $user->id; ?></td>
                <td><?php echo $user->name; ?></td>
                <td><?php echo $user->email; ?></td>
                <td><?php echo $user->address; ?></td>
                <td><?php echo $user->phone; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <?php echo $pagination->nav(); ?>
</body>
</html>



<?php
    include('accessDatabase.php');
    
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
    
    // $db->exec($statement)or die("Failed to Insert");
    // $db->exec('COMMIT');

    //Modify these with relevant column attribute and also do insert
    $query="CREATE TABLE IF NOT EXISTS `loans`('l_loanid' INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, 'l_cardid' INTEGER NOT NULL, 'l_bookid' INTEGER NOT NULL,'l_movieid' INTEGER NOT NULL, 'l_loandate' DATE, 'l_loanstatus' TEXT NOT NULL, 'l_loanlength' INTEGER NOT NULL, 'l_fees' INTEGER NOT NULL, 'l_feestatus' TEXT NOT NULL, 'l_comment' TEXT NOT NULL)";
    $db->exec($query)or die("Failed to create table! ");
    
    $query="CREATE TABLE IF NOT EXISTS `books`('b_bookid' INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
     'b_isbn' TEXT NOT NULL, 'b_title' TEXT NOT NULL,'b_year' INTEGER NOT NULL, 'b_genre' TEXT NOT NULL, 'b_libid' INTEGER NOT NULL, 'b_condition' TEXT NOT NULL, 'b_comment' TEXT NOT NULL )";
    $db->exec($query)or die("Failed to create table! ");
    
    $query="CREATE TABLE IF NOT EXISTS `movies`('m_movieid' INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    'm_title' TEXT NOT NULL,'m_length' INTEGER NOT NULL, 'm_star' TEXT NOT NULL, 'm_genre' TEXT NOT NULL, 'm_year' TEXT NOT NULL, 'm_libid' TEXT NOT NULL, 'm_condition' TEXT NOT NULL, 'm_comment' TEXT NOT NULL)";
    $db->exec($query)or die("Failed to create table! ");

    $query="CREATE TABLE IF NOT EXISTS `Loanmovies`('Loanmovies_id' INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    'l_loanid' INTEGER NOT NULL,'m_movieid' INTEGER NOT NULL)";
    $db->exec($query)or die("Failed to create table! ");

    $query="CREATE TABLE IF NOT EXISTS `Loanbooks`('Loanbooks_id' INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    'l_loanid' INTEGER NOT NULL,'b_bookid' INTEGER NOT NULL)";
    $db->exec($query)or die("Failed to create table! ");
    
    $query="CREATE TABLE IF NOT EXISTS `library`('lib_libid' INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, 'lib_name' TEXT NOT NULL UNIQUE ON CONFLICT IGNORE,  'lib_address' TEXT NOT NULL,'lib_phone' INTEGER NOT NULL, 'lib_cityid' INTEGER NOT NULL, 'lib_commend' TEXT NOT NULL)";
    $db->exec($query)or die("Failed to create table! ");
    $csvFilepath = "csv/";

    $query="CREATE TABLE IF NOT EXISTS `Libbooks`('libbooks_id' INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    'lib_libid' INTEGER NOT NULL,'b_bookid' INTEGER NOT NULL)";
    $db->exec($query)or die("Failed to create table! ");

    $query="CREATE TABLE IF NOT EXISTS `Libmovies`('libbooks_id' INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    'lib_libid' INTEGER NOT NULL,'m_movieid' INTEGER NOT NULL)";
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
    $db->close();
    
?>
            $statement = $db->prepare("SELECT 'libbooks_id','b_title','b_year','lib_name' FROM 'Libbooks', 'library','books' WHERE 'libbooks_libid = lib_libid' AND 'libbooks_bookid = b_bookid' AND b_title LIKE '%".$searchBook."%'");












            
