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