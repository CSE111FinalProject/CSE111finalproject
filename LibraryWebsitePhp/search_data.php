<?php
    //This is where we would implement the query for our library function
    
    require_once 'vendor/autoload.php';

    include('accessDatabase.php');
    $error = '';
    if(isset($_POST['search'])){
        $searchNation = $_POST['NationSearch'];
        $searchCity = $_POST['citySearch'];
        $searchBook = $_POST['bookSearch'];
        $searchLibrary = $_POST['librarySearch'];
        $db = new SQLite3('database/'. $databaseName, SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
        $db->enableExceptions(true);
        
        //PLEASE KEEP THIS TEMPLATE to add more if condition
        if($searchBook && $searchCity && !$searchNation){
            //fetch book based on city location
            //We can just use if statements or create another file for each functionality and code include('file directory')
            
            $db->exec('BEGIN');
            $statement = $db->prepare('SELECT * FROM "cardholder"');
            // $statement = $db->prepare('SELECT "b_title", "city_name","lib_name", "lib_address","lib_phone" FROM "City","library","Libbooks","books" WHERE "city_name" = ? AND "city_cityid" = "lib_cityid" AND "lib_libid" = "libbooks_libid" AND "libbooks_bookid" ="b_bookid" AND "b_title" LIKE "%".?."%"');
            // $statement->bindValue(1, $searchCity);
            // $statement->bindValue(1, $searchBook);
            $result = $statement->execute() or die("Failed to fetch row!");
            $db->exec('COMMIT');
            //table mutation based on the query. In php, you can use echo to make html be able to be used inside the profile.php instead of being kept permanent in html (no if statement in html)
            echo"<table class='table table-bordered'>";
            echo"<thead class='alert-info'>";
				echo"<tr>";
					echo"<th>Book Title</th>";
					echo"<th>City</th>";
					echo"<th>Library Name</th>";
                    echo"<th>Library Address</th>";
                    echo"<th>Library Phone</th>";
					//add more columns if needed or change column need
				echo"</tr>";
			echo"</thead>";
            while($fetch=$result->fetchArray()){
                echo"<tr><td>".$fetch['b_title']."</td><td>".$fetch['city_name']."</td><td>".$fetch['lib_name']."</td><td>".$fetch['lib_address']."</td><td>".$fetch['lib_phone']."</td></tr>";
             }
             echo"</table>";
        }
        else if($searchBook && $searchLibrary && !$searchCity && !$searchNation){
            //search book by library
            $db->exec('BEGIN');
            // $statement = $db->prepare('SELECT "b_title", "city_name","lib_name", "lib_address","lib_phone" FROM "City","library" WHERE "lib_name" = ? AND "city_cityid" = "lib_cityid" AND "lib_libid" = "libbooks_libid" AND "libbooks_bookid" = "b_bookid" AND "b_title" LIKE "%".?."%"');
            // $statement->bindValue(1, $searchLibrary);
            // $statement->bindValue(1, $searchBook);
            $statement = $db->prepare('SELECT * FROM "cardholder"');
            $result = $statement->execute() or die("Failed to fetch row!");
            // $statement = $db->prepare('SELECT * FROM "login"');
            // $result = $statement->execute() or die("Failed to fetch row!");
            $db->exec('COMMIT');
            // echo"";
            //table mutation based on the query. In php, you can use echo to make html be able to be used inside the profile.php instead of being kept permanent in html (no if statement in html)
            echo"<table class='table table-bordered'>";
            echo"<thead class='alert-info'>";

				echo"<tr>";
				    echo"<th>Id</th>";
					echo"<th>Username</th>";
					echo"<th>Password</th>";
                    echo"<th>Address</th>";
                    echo"<th>CityID</th>";
                    echo"<th>Phone</th>";
                    echo"<th>Account Balance</th>";
                    echo"<th>Comment</th>";
					//add more columns if needed or change column need
				echo"</tr>";
			echo"</thead>";

            while($fetch=$result->fetchArray()){
                echo"<tr><td>".$fetch['c_cardid']."</td><td>".$fetch['c_username']."</td><td>".$fetch['c_password']."</td><td>".$fetch['c_address']."</td><td>".$fetch['c_cityid']."</td><td>".$fetch['c_phone']."</td><td>".$fetch['c_acctbal']."</td><td>".$fetch['c_comment']."</td></tr>";
             }
             echo"</table>";
        }
        else{
            //search book by all option
            // $statement = $db->prepare('SELECT "b_title", "city_name","lib_name", "lib_address","lib_phone" FROM "City","library", "Libbooks" WHERE "city_cityid" = "lib_cityid" AND "lib_libid" = "libbooks_libid"');
            
            $db->exec('BEGIN');
            // $statement = $db->prepare('SELECT * FROM "cardholder"');
            $statement = $db->prepare('SELECT * FROM "state"');
            $result = $statement->execute() or die("Failed to fetch row!");
            // $statement = $db->prepare('SELECT * FROM "login"');
            // $result1 = $statement->execute() or die("Failed to fetch row!");
            // $totalRecords = $result1->fetchArray(PDO::FETCH_COLUMN);
            // $pagination = new Pagination($_GET['page'], $totalRecords, 10);
            $db->exec('COMMIT');
            // $pages = new Paginator;
            //table mutation based on the query. In php, you can use echo to make html be able to be used inside the profile.php instead of being kept permanent in html (no if statement in html)      
            echo"<table class='table table-bordered'>";     
            echo"<thead class='alert-info'>";
            // echo"<col width='10px' />";
            // echo"<col width='30px' />";
            // echo"<col width='30px' />";
            // echo"<col width='40px' />";
            // echo"<col width='30px' />";
            // echo"<col width='30px' />";
            // echo"<col width='30px' />";
            // echo"<col width='30px' />";
				echo"<tr>";
				    echo"<th>State Name</th>";
					echo"<th>State Comment</th>";
					
					//add more columns if needed or change column need
				echo"</tr>";
			echo"</thead>";
            while($fetch=$result->fetchArray()){
                echo"<tr><td>".$fetch['s_name']."</td><td>".$fetch['s_comment']."</td></tr>";
            }
            echo"</table>";
        }
        $db->close();
        //etc

    }

?>
