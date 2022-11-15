<?php
    //This is where we would implement the query for our library function
    
    // require_once 'vendor/autoload.php';

    include('accessDatabase.php');
    $error = '';
    if(isset($_POST['search'])){
        $searchState = $_POST['StateSearch'];
        $searchCity = $_POST['citySearch'];
        $searchBook = $_POST['bookSearch'];
        $searchLibrary = $_POST['librarySearch'];
        $isbnSearch = $_POST['isbnSearch'];
        $movieSearch = $_POST['movieSearch'];
        $db = new SQLite3('database/'. $databaseName, SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
        $db->enableExceptions(true);
        
        //PLEASE KEEP THIS TEMPLATE to add more if condition
        if($searchBook && $searchCity && !$searchState){
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
        else if(!$searchBook && $searchLibrary && !$searchCity && !$searchState && !$movieSearch){
            //search book by library
            $db->exec('BEGIN');
            $search1 = "%" .$searchBook."%";
            $search2 = "%" .$searchLibrary."%";
            $statement = $db->prepare('SELECT "libbooks_id","b_title","b_year","lib_name" FROM "Libbooks", "library","books" WHERE "b_bookid" = "libbooks_bookid" AND "libbooks_libid" = "lib_libid" AND "lib_name" LIKE ?');
            $statement->bindValue(1,$search2);
            $result = $statement->execute() or die("Failed to fetch row");
            $db->exec('COMMIT');
            $db->exec('BEGIN');//Movies
            $statement1 = $db->prepare('SELECT "libmovies_id","m_title","m_year","lib_name" FROM "movies","library","Libmovies" WHERE "m_movieid" = "libmovies_movieid"  AND "libmovies_libid" = "lib_libid" AND "lib_name" LIKE ?');
            $statement1->bindValue(1, $search2);
            $result1 = $statement1->execute() or die("Failed to fetch row");
            $db->exec('COMMIT');
            list($id,$material,$Year,$Libname) = $result->fetchArray(PDO::FETCH_NUM);
			list($id1,$material1,$Year1,$Libname1) = $result1->fetchArray(PDO::FETCH_NUM);
            // echo"";
            //table mutation based on the query. In php, you can use echo to make html be able to be used inside the profile.php instead of being kept permanent in html (no if statement in html)
            echo"<table class='table table-bordered'>";
            echo"<thead class='alert-info'>";

				echo"<tr>";
                    echo"<th>Borrow Id</th>";
                    echo"<th>Book Title</th>";
                    echo"<th>Material Published</th>";
                    echo"<th>Library Name</th>";
					//add more columns if needed or change column need
				echo"</tr>";
			echo"</thead>";

            
             if($material){

                echo"<tr><td>".$id."</td><td>".$material."</td><td>".$Year."</td><td>".$Libname."</td></tr>";
                while($fetch=$result->fetchArray()){
                    echo"<tr><td>".$fetch['libbooks_id']."</td><td>".$fetch['b_title']."</td><td>".$fetch['b_year']."</td><td>".$fetch['lib_name']."</td></tr>";
                }
            }
            echo"</table>";
            echo"<table class='table table-bordered'>";
            echo"<thead class='alert-info'>";

				echo"<tr>";
                    echo"<th>Borrow Id</th>";
                    echo"<th>Movie Title</th>";
                    echo"<th>Material Published</th>";
                    echo"<th>Library Name</th>";
					//add more columns if needed or change column need
				echo"</tr>";
			echo"</thead>";
            if($material1){
                
                echo"<tr><td>".$id1."</td><td>".$material1."</td><td>".$Year1."</td><td>".$Libname1."</td></tr>";
                while($fetch=$result1->fetchArray()){
                    echo"<tr><td>".$fetch['libmovies_id']."</td><td>".$fetch['m_title']."</td><td>".$fetch['m_year']."</td><td>".$fetch['lib_name']."</td></tr>";
                }
            }
             echo"</table>";
        }else if($searchBook && !$searchCity && !$searchLibrary && !$searchState && !$movieSearch){
            $db->exec('BEGIN');
            $search = "%" .$searchBook."%";
            $statement = $db->prepare('SELECT "libbooks_id","b_title","b_year","lib_name" FROM "Libbooks", "library","books" WHERE "libbooks_libid" = "lib_libid" AND "libbooks_bookid" = "b_bookid" and "b_title" LIKE ?');
            $statement->bindValue(1, $search);
            $result = $statement->execute() or die("Failed to fetch row!");
            $db->exec('COMMIT');
            echo"<table class='table table-bordered'>";     
            echo"<thead class='alert-info'>";
            echo"<tr>";
				    echo"<th>Borrow Id</th>";
					echo"<th>Book Title</th>";
					echo"<th>Book Published</th>";
                    echo"<th>Library Name</th>";
					//add more columns if needed or change column need
				echo"</tr>";
                echo"</thead>";
                // echo"Hello";
            while($fetch=$result->fetchArray()){
                echo"<tr><td>".$fetch['libbooks_id']."</td><td>".$fetch['b_title']."</td><td>".$fetch['b_year']."</td><td>".$fetch['lib_name']."</td></tr>";
            }
            echo"</table>";
        }else if($movieSearch && !$searchBook && !$searchCity && !$searchLibrary && !$searchState){
            $db->exec('BEGIN');
            $search = "%" .$movieSearch."%";
            $statement = $db->prepare('SELECT * FROM "Libmovies", "library","movies" WHERE "libmovies_libid" = "lib_libid" AND "libmovies_movieid" = "m_movieid" and "m_title" LIKE ?');
            $statement->bindValue(1, $search);
            $result = $statement->execute() or die("Failed to fetch row!");
            $db->exec('COMMIT');
            echo"<table class='table table-bordered'>";     
            echo"<thead class='alert-info'>";
            echo"<tr>";
                    echo"<th>Borrow Id</th>";
                    echo"<th>Movie Title</th>";
                    echo"<th>Movie Published</th>";
                    echo"<th>Library Name</th>";
                    //add more columns if needed or change column need
                echo"</tr>";
                echo"</thead>";
                // echo"Hello";
            while($fetch=$result->fetchArray()){
                echo"<tr><td>".$fetch['libmovies_id']."</td><td>".$fetch['m_title']."</td><td>".$fetch['m_year']."</td><td>".$fetch['lib_name']."</td></tr>";
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
