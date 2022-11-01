<?php
    //This is where we would implement the query for our library function
    $error = '';
    if(isset($_POST['search'])){
        $searchNation = $_POST['NationSearch'];
        $searchCity = $_POST['citySearch'];
        $searchBook = $_POST['bookSearch'];
        $searchLibrary = $_POST['librarySearch'];
        $db = new SQLite3('database/librarydatabase.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
        $db->enableExceptions(true);
        
        //PLEASE KEEP THIS TEMPLATE to add more if condition
        if($searchBook && $searchCity && !$searchNation){
            //fetch book based on city location
            //We can just use if statements or create another file for each functionality and code include('file directory')
            $db->exec('BEGIN');
            $statement = $db->prepare('SELECT * FROM "cardholder"');
            $result = $statement->execute() or die("Failed to fetch row!");
            $db->exec('COMMIT');
            //table mutation based on the query. In php, you can use echo to make html be able to be used inside the profile.php instead of being kept permanent in html (no if statement in html)

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
        }
        else if($searchBook && $searchLibrary && !$searchCity && !$searchNation){
            //search book by library
            $db->exec('BEGIN');
            $statement = $db->prepare('SELECT * FROM "cardholder"');
            $result = $statement->execute() or die("Failed to fetch row!");
            // $statement = $db->prepare('SELECT * FROM "login"');
            $result = $statement->execute() or die("Failed to fetch row!");
            $db->exec('COMMIT');
            // echo"";
            //table mutation based on the query. In php, you can use echo to make html be able to be used inside the profile.php instead of being kept permanent in html (no if statement in html)
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
        }
        else{
            //search book by all option
            $db->exec('BEGIN');
            $statement = $db->prepare('SELECT * FROM "cardholder"');
            $result = $statement->execute() or die("Failed to fetch row!");
            // $statement = $db->prepare('SELECT * FROM "login"');
            $result = $statement->execute() or die("Failed to fetch row!");
            $db->exec('COMMIT');
            //table mutation based on the query. In php, you can use echo to make html be able to be used inside the profile.php instead of being kept permanent in html (no if statement in html)           
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
        }
        $db->close();
        //etc

    }

?>