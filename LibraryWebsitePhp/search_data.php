<?php
    //This is where we would implement the query for our library function
    $error = '';
    if(isset($_POST['search'])){
        $searchNation = $_POST['NationSearch'];
        $searchCity = $_POST['citySearch'];
        $searchBook = $_POST['bookSearch'];
        $db = new SQLite3('database/librarydatabase.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
        $db->enableExceptions(true);
        $db->exec('BEGIN');
        $statement = $db->prepare('SELECT * FROM "login"')or die("Failed to fetch row!");;
        $result = $statement->execute();
        $db->exec('COMMIT');
        while($fetch=$result->fetchArray()){
			echo"<tr><td>".$fetch['user_id']."</td><td>".$fetch['username']."</td><td>".$fetch['password']."</td></tr>";
		}

    }

?>