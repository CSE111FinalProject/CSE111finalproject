<?php
    //This is where we would implement the query for our library function
    
    // require_once 'vendor/autoload.php';
    // echo "HELLO";
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
        if($searchBook && $searchCity && !$searchState && !$searchLibrary && !$movieSearch && !$isbnSearch){ //search for book and city
            //fetch book based on city location
            //We can just use if statements or create another file for each functionality and code include('file directory')
            if($searchBook == "*"){
                $db->exec('BEGIN');
                // $search1 = "%" .$searchBook."%";
                $search2 = "%" .$searchCity."%";
                $statement = $db->prepare('SELECT "libbooks_id","b_title","b_year","lib_name","city_name", "s_name" FROM "Libbooks", "library","books","City","state" WHERE "b_bookid" = "libbooks_bookid" AND "libbooks_libid" = "lib_libid" AND "lib_cityid" = "city_cityid" AND "city_name" LIKE ? AND s_stateid = city_stateid');
                $statement->bindValue(1,$search2);
                // $statement->bindValue(2,$search1);
                

                
                $result = $statement->execute() or die("Failed to fetch row!");
                $db->exec('COMMIT');
                //table mutation based on the query. In php, you can use echo to make html be able to be used inside the profile.php instead of being kept permanent in html (no if statement in html)
                echo"<table class='table table-bordered'>";
                echo"<thead class='alert-info'>";
                    echo"<tr>";
                        echo"<th>Borrow Id</th>";
                        echo"<th>Book Title</th>";
                        echo"<th>Book Year</th>";
                        echo"<th>Library Name</th>";
                        echo"<th>Library City Location</th>";
                        echo"<th>Library State Location</th>";
                    echo"</tr>";
                echo"</thead>";
                while($fetch=$result->fetchArray()){
                    echo"<tr><td>".$fetch['libbooks_id']."</td><td>".$fetch['b_title']."</td><td>".$fetch['b_year']."</td><td>".$fetch['lib_name']."</td><td>".$fetch['city_name']."</td><td>".$fetch['s_name']."</td></tr>";
                }
                echo"</table>";
            }else{
                $db->exec('BEGIN');
                $search1 = "%" .$searchBook."%";
                $search2 = "%" .$searchCity."%";
                $statement = $db->prepare('SELECT "libbooks_id","b_title","b_year","lib_name","city_name", "s_name" FROM "Libbooks", "library","books","City", "state" WHERE "b_bookid" = "libbooks_bookid" AND "libbooks_libid" = "lib_libid" AND "lib_cityid" = "city_cityid" AND "city_name" LIKE ? AND "b_title" LIKE ? AND s_stateid = city_stateid');
                $statement->bindValue(1,$search2);
                $statement->bindValue(2,$search1);
                

                
                $result = $statement->execute() or die("Failed to fetch row!");
                $db->exec('COMMIT');
                //table mutation based on the query. In php, you can use echo to make html be able to be used inside the profile.php instead of being kept permanent in html (no if statement in html)
                echo"<table class='table table-bordered'>";
                echo"<thead class='alert-info'>";
                    echo"<tr>";
                        echo"<th>Borrow Id</th>";
                        echo"<th>Book Title</th>";
                        echo"<th>Book Year</th>";
                        echo"<th>Library Name</th>";
                        echo"<th>Library City Location</th>";
                        echo"<th>Library State Location</th>";
                    echo"</tr>";
                echo"</thead>";
                while($fetch=$result->fetchArray()){
                    echo"<tr><td>".$fetch['libbooks_id']."</td><td>".$fetch['b_title']."</td><td>".$fetch['b_year']."</td><td>".$fetch['lib_name']."</td><td>".$fetch['city_name']."</td><td>".$fetch['s_name']."</td></tr>";
                }
                echo"</table>";
                }
            
        }
        if(!$searchBook && $searchCity && !$searchState && !$searchLibrary && $movieSearch && !$isbnSearch){ //search for book and city
            //fetch book based on city location
            //We can just use if statements or create another file for each functionality and code include('file directory')
            if($movieSearch == "*"){
                $db->exec('BEGIN');
                // $search1 = "%" .$searchBook."%";
                $search2 = "%" .$searchCity."%";
                
                $statement = $db->prepare('SELECT * FROM "Libmovies", "library","movies","City","state" WHERE "libmovies_libid" = "lib_libid" AND "libmovies_movieid" = "m_movieid" AND "lib_cityid" = "city_cityid" AND "city_name" LIKE ? AND city_stateid = s_stateid');
                $statement->bindValue(1, $search2);
                // $statement->bindValue(2, $search1);
                

                
                $result = $statement->execute() or die("Failed to fetch row!");
                $db->exec('COMMIT');
                //table mutation based on the query. In php, you can use echo to make html be able to be used inside the profile.php instead of being kept permanent in html (no if statement in html)
                echo"<table class='table table-bordered'>";
                echo"<thead class='alert-info'>";
                    echo"<tr>";
                        echo"<th>Borrow Id</th>";
                        echo"<th>Movie Title</th>";
                        echo"<th>Movie Year</th>";
                        echo"<th>Library Name</th>";
                        echo"<th>Library City Location</th>";
                        echo"<th>Library State Location</th>";
                        
                    echo"</tr>";
                echo"</thead>";
                while($fetch=$result->fetchArray()){
                    echo"<tr><td>".$fetch['libmovies_id']."</td><td>".$fetch['m_title']."</td><td>".$fetch['m_year']."</td><td>".$fetch['lib_name']."</td><td>".$fetch['city_name']."</td><td>".$fetch['s_name']."</td></tr>";
                }
                echo"</table>";
            }else{
                $db->exec('BEGIN');
                $search1 = "%" .$movieSearch."%";
                $search2 = "%" .$searchCity."%";
                $statement = $db->prepare('SELECT "libmovies_id","m_title","m_year","lib_name","city_name" FROM "Libbooks", "library","movies","City" WHERE "m_movieid" = "libmovies_movieid" AND "libmovies_libid" = "lib_libid" AND "lib_cityid" = "city_cityid" AND "m_title" LIKE ? AND "city_name" LIKE ? AND city_stateid = s_stateid');
                $statement->bindValue(1,$search1);
                $statement->bindValue(2,$search2);
                

                
                $result = $statement->execute() or die("Failed to fetch row!");
                $db->exec('COMMIT');
                //table mutation based on the query. In php, you can use echo to make html be able to be used inside the profile.php instead of being kept permanent in html (no if statement in html)
                echo"<table class='table table-bordered'>";
                echo"<thead class='alert-info'>";
                    echo"<tr>";
                        echo"<th>Borrow Id</th>";
                        echo"<th>Movie Title</th>";
                        echo"<th>Movie Year</th>";
                        echo"<th>Library Name</th>";
                        echo"<th>Library City Location</th>";
                        echo"<th>Library State Location</th>";
                    echo"</tr>";
                echo"</thead>";
                while($fetch=$result->fetchArray()){
                    echo"<tr><td>".$fetch['libmovies_id']."</td><td>".$fetch['m_title']."</td><td>".$fetch['m_year']."</td><td>".$fetch['lib_name']."</td><td>".$fetch['city_name']."</td><td>".$fetch['s_name']."</td></tr>";
                }
                echo"</table>";
                }
            
        }
        else if(!$searchBook && $searchLibrary && !$searchCity && !$searchState && !$movieSearch && !$isbnSearch){ //search for library
            //search book by library
            $db->exec('BEGIN');
            $search1 = "%" .$searchBook."%";
            $search2 = "%" .$searchLibrary."%";
            $statement = $db->prepare('SELECT "libbooks_id","b_title","b_year","lib_name","city_name" FROM "Libbooks", "library","books","City" WHERE "b_bookid" = "libbooks_bookid" AND "libbooks_libid" = "lib_libid" AND "lib_cityid" = "city_cityid" AND "lib_name" LIKE ?');
            $statement->bindValue(1,$search2);
            $result = $statement->execute() or die("Failed to fetch row");
            $db->exec('COMMIT');
            $db->exec('BEGIN');//Movies
            $statement1 = $db->prepare('SELECT "libmovies_id","m_title","m_year","lib_name","city_name" FROM "movies","library","Libmovies","City" WHERE "m_movieid" = "libmovies_movieid"  AND "libmovies_libid" = "lib_libid" AND "lib_cityid" = "city_cityid" AND "lib_name" LIKE ?');
            $statement1->bindValue(1, $search2);
            $result1 = $statement1->execute() or die("Failed to fetch row");
            $db->exec('COMMIT');
            list($id,$material,$Year,$Libname,$libcity) = $result->fetchArray(PDO::FETCH_NUM);
			list($id1,$material1,$Year1,$Libname1,$libcity1) = $result1->fetchArray(PDO::FETCH_NUM);
            // echo"";
            //table mutation based on the query. In php, you can use echo to make html be able to be used inside the profile.php instead of being kept permanent in html (no if statement in html)
            echo"<table class='table table-bordered'>";
            echo"<thead class='alert-info'>";

				echo"<tr>";
                    echo"<th>Borrow Id</th>";
                    echo"<th>Book Title</th>";
                    echo"<th>Material Published</th>";
                    echo"<th>Library Name</th>";
                    echo"<th>Library City Location</th>";
					//add more columns if needed or change column need
				echo"</tr>";
			echo"</thead>";

            
             if($material){

                echo"<tr><td>".$id."</td><td>".$material."</td><td>".$Year."</td><td>".$Libname."</td><td>".$libcity."</td></tr>";
                while($fetch=$result->fetchArray()){
                    echo"<tr><td>".$fetch['libbooks_id']."</td><td>".$fetch['b_title']."</td><td>".$fetch['b_year']."</td><td>".$fetch['lib_name']."</td><td>".$fetch['city_name']."</td></tr>";
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
                    echo"<th>Library City Location</th>";
					//add more columns if needed or change column need
				echo"</tr>";
			echo"</thead>";
            if($material1){
                
                echo"<tr><td>".$id1."</td><td>".$material1."</td><td>".$Year1."</td><td>".$Libname1."</td><td>".$libcity1."</td></tr>";
                while($fetch=$result1->fetchArray()){
                    echo"<tr><td>".$fetch['libmovies_id']."</td><td>".$fetch['m_title']."</td><td>".$fetch['m_year']."</td><td>".$fetch['lib_name']."</td><td>".$fetch['city_name']."</td></tr>";
                }
            }
             echo"</table>";
        }else if($searchBook && !$searchCity && !$searchLibrary && !$searchState && !$movieSearch && !$isbnSearch){ //search for books
            
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
        }else if($movieSearch && !$searchBook && !$searchCity && !$searchLibrary && !$searchState && !$isbnSearch){ //search for movies
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
        // }else if($movieSearch && !$searchBook && $searchCity && !$searchLibrary && !$searchState && !$isbnSearch){ //search for movie and city

        //     $db->exec('BEGIN');
        //     $search = "%" .$movieSearch."%";
        //     $search1 = "%" .$searchCity."%";
        //     $statement = $db->prepare('SELECT * FROM "Libmovies", "library","movies","City" WHERE "libmovies_libid" = "lib_libid" AND "libmovies_movieid" = "m_movieid" AND "lib_cityid" = "city_cityid"and "m_title" LIKE ?  AND "city_name" LIKE ?');
        //     $statement->bindValue(1, $search);
        //     $statement->bindValue(2, $search1);
        //     $result = $statement->execute() or die("Failed to fetch row!");
        //     $db->exec('COMMIT');
        //     echo"<table class='table table-bordered'>";     
        //     echo"<thead class='alert-info'>";
        //     echo"<tr>";
        //             echo"<th>Borrow Id</th>";
        //             echo"<th>Movie Title</th>";
        //             echo"<th>Movie Published</th>";
        //             echo"<th>Library Name</th>";
        //             echo"<th>Library City Location</th>";
        //             //add more columns if needed or change column need
        //         echo"</tr>";
        //         echo"</thead>";
        //         // echo"Hello";
        //     while($fetch=$result->fetchArray()){
        //         echo"<tr><td>".$fetch['libmovies_id']."</td><td>".$fetch['m_title']."</td><td>".$fetch['m_year']."</td><td>".$fetch['lib_name']."</td><td>".$fetch['city_name']."</td></tr>";
        //     }
        //     echo"</table>";
        // }
        else if($movieSearch && !$searchBook && !$searchCity && $searchLibrary && !$searchState && !$isbnSearch){ //search for movie and library
            if($movieSearch == "*"){
                $db->exec('BEGIN');
                // $search = "%" .$movieSearch."%";
                $search1 = "%" .$searchCity."%";
                $statement = $db->prepare('SELECT * FROM "Libmovies", "library","movies","City" WHERE "libmovies_libid" = "lib_libid" AND "libmovies_movieid" = "m_movieid" AND "lib_cityid" = "city_cityid" AND "city_name" LIKE ?');
                // $statement->bindValue(1, $search);
                $statement->bindValue(1, $search1);
                $result = $statement->execute() or die("Failed to fetch row!");
                $db->exec('COMMIT');
                echo"<table class='table table-bordered'>";     
                echo"<thead class='alert-info'>";
                echo"<tr>";
                        echo"<th>Borrow Id</th>";
                        echo"<th>Movie Title</th>";
                        echo"<th>Movie Published</th>";
                        echo"<th>Library Name</th>";
                        echo"<th>Library City Location</th>";
                        //add more columns if needed or change column need
                    echo"</tr>";
                    echo"</thead>";
                    // echo"Hello";
                while($fetch=$result->fetchArray()){
                    echo"<tr><td>".$fetch['libmovies_id']."</td><td>".$fetch['m_title']."</td><td>".$fetch['m_year']."</td><td>".$fetch['lib_name']."</td><td>".$fetch['city_name']."</td></tr>";
                }
                echo"</table>";
            }else{
                $db->exec('BEGIN');
                $search = "%" .$movieSearch."%";
                $search1 = "%" .$searchCity."%";
                $statement = $db->prepare('SELECT * FROM "Libmovies", "library","movies","City" WHERE "libmovies_libid" = "lib_libid" AND "libmovies_movieid" = "m_movieid" AND "lib_cityid" = "city_cityid"and "m_title" LIKE ?  AND "city_name" LIKE ?');
                $statement->bindValue(1, $search);
                $statement->bindValue(2, $search1);
                $result = $statement->execute() or die("Failed to fetch row!");
                $db->exec('COMMIT');
                echo"<table class='table table-bordered'>";     
                echo"<thead class='alert-info'>";
                echo"<tr>";
                        echo"<th>Borrow Id</th>";
                        echo"<th>Movie Title</th>";
                        echo"<th>Movie Published</th>";
                        echo"<th>Library Name</th>";
                        echo"<th>Library City Location</th>";
                        //add more columns if needed or change column need
                    echo"</tr>";
                    echo"</thead>";
                    // echo"Hello";
                while($fetch=$result->fetchArray()){
                    echo"<tr><td>".$fetch['libmovies_id']."</td><td>".$fetch['m_title']."</td><td>".$fetch['m_year']."</td><td>".$fetch['lib_name']."</td><td>".$fetch['city_name']."</td></tr>";
                }
                echo"</table>";
            }
            
        }
        else if(!$movieSearch && $searchBook && !$searchCity && $searchLibrary && !$searchState && !$isbnSearch){ //search for book and library
            if($searchBook == "*"){
                $db->exec('BEGIN');
                // $search = "%" .$searchBook."%";
                $search1 = "%" .$searchLibrary."%";
                $statement = $db->prepare('SELECT "libbooks_id","b_title","b_year","lib_name","city_name" FROM "Libbooks", "library","books","City" WHERE "libbooks_libid" = "lib_libid" AND "libbooks_bookid" = "b_bookid" AND "lib_cityid" = "city_cityid" AND "lib_name" LIKE ?');
                // $statement->bindValue(1, $search);
                $statement->bindValue(1, $search1);
                $result = $statement->execute() or die("Failed to fetch row!");
                $db->exec('COMMIT');
                echo"<table class='table table-bordered'>";     
                echo"<thead class='alert-info'>";
                echo"<tr>";
                        echo"<th>Borrow Id</th>";
                        echo"<th>Book Title</th>";
                        echo"<th>Book Published</th>";
                        echo"<th>Library Name</th>";
                        echo"<th>Library City Location</th>";
                        //add more columns if needed or change column need
                    echo"</tr>";
                    echo"</thead>";
                    // echo"Hello";
                while($fetch=$result->fetchArray()){
                    echo"<tr><td>".$fetch['libbooks_id']."</td><td>".$fetch['b_title']."</td><td>".$fetch['b_year']."</td><td>".$fetch['lib_name']."</td><td>".$fetch['city_name']."</td></tr>";
                }
                echo"</table>";
            }else{
                $db->exec('BEGIN');
                $search = "%" .$searchBook."%";
                $search1 = "%" .$searchLibrary."%";
                $statement = $db->prepare('SELECT "libbooks_id","b_title","b_year","lib_name","city_name" FROM "Libbooks", "library","books","City" WHERE "libbooks_libid" = "lib_libid" AND "libbooks_bookid" = "b_bookid" AND "lib_cityid" = "city_cityid" and "b_title" LIKE ? AND "lib_name" LIKE ?');
                $statement->bindValue(1, $search);
                $statement->bindValue(2, $search1);
                $result = $statement->execute() or die("Failed to fetch row!");
                $db->exec('COMMIT');
                echo"<table class='table table-bordered'>";     
                echo"<thead class='alert-info'>";
                echo"<tr>";
                        echo"<th>Borrow Id</th>";
                        echo"<th>Book Title</th>";
                        echo"<th>Book Published</th>";
                        echo"<th>Library Name</th>";
                        echo"<th>Library City Location</th>";
                        //add more columns if needed or change column need
                    echo"</tr>";
                    echo"</thead>";
                    // echo"Hello";
                while($fetch=$result->fetchArray()){
                    echo"<tr><td>".$fetch['libbooks_id']."</td><td>".$fetch['b_title']."</td><td>".$fetch['b_year']."</td><td>".$fetch['lib_name']."</td><td>".$fetch['city_name']."</td></tr>";
                }
                echo"</table>";
            }
            
        }
        else if($movieSearch && !$searchBook && !$searchCity && !$searchLibrary && $searchState && !$isbnSearch){ //search for Movie and State
            if($movieSearch == "*"){
                $db->exec('BEGIN');
                // $search = "%" .$movieSearch."%";
                $search1 = "%" .$searchState."%";
                $statement = $db->prepare('SELECT * FROM "Libmovies", "library","movies","City", "state" WHERE "libmovies_libid" = "lib_libid" AND "libmovies_movieid" = "m_movieid" AND "lib_cityid" = "city_cityid"  AND "city_stateid" = "s_stateid" AND s_name LIKE ?');
                // $statement->bindValue(1, $search);
                $statement->bindValue(1, $search1);
                $result = $statement->execute() or die("Failed to fetch row!");
                $db->exec('COMMIT');
                echo"<table class='table table-bordered'>";     
                echo"<thead class='alert-info'>";
                echo"<tr>";
                        echo"<th>Borrow Id</th>";
                        echo"<th>Movie Title</th>";
                        echo"<th>Movie Published</th>";
                        echo"<th>Library Name</th>";
                        echo"<th>Library State Location</th>";
                        //add more columns if needed or change column need
                    echo"</tr>";
                    echo"</thead>";
                    // echo"Hello";
                while($fetch=$result->fetchArray()){
                    echo"<tr><td>".$fetch['libmovies_id']."</td><td>".$fetch['m_title']."</td><td>".$fetch['m_year']."</td><td>".$fetch['lib_name']."</td><td>".$fetch['s_name']."</td></tr>";
                }
                echo"</table>";
            }else{
                $db->exec('BEGIN');
                $search = "%" .$movieSearch."%";
                $search1 = "%" .$searchState."%";
                $statement = $db->prepare('SELECT * FROM "Libmovies", "library","movies","City", "state" WHERE "libmovies_libid" = "lib_libid" AND "libmovies_movieid" = "m_movieid" AND "lib_cityid" = "city_cityid"and "m_title" LIKE ?  AND "city_stateid" = "s_stateid" AND s_name LIKE ?');
                $statement->bindValue(1, $search);
                $statement->bindValue(2, $search1);
                $result = $statement->execute() or die("Failed to fetch row!");
                $db->exec('COMMIT');
                echo"<table class='table table-bordered'>";     
                echo"<thead class='alert-info'>";
                echo"<tr>";
                        echo"<th>Borrow Id</th>";
                        echo"<th>Movie Title</th>";
                        echo"<th>Movie Published</th>";
                        echo"<th>Library Name</th>";
                        echo"<th>Library State Location</th>";
                        //add more columns if needed or change column need
                    echo"</tr>";
                    echo"</thead>";
                    // echo"Hello";
                while($fetch=$result->fetchArray()){
                    echo"<tr><td>".$fetch['libmovies_id']."</td><td>".$fetch['m_title']."</td><td>".$fetch['m_year']."</td><td>".$fetch['lib_name']."</td><td>".$fetch['s_name']."</td></tr>";
                }
                echo"</table>";
            }
            
        }
        else if(!$movieSearch && $searchBook && !$searchCity && !$searchLibrary && $searchState && !$isbnSearch){ //search for Book and State
            if($searchBook == "*"){
                $db->exec('BEGIN');
                // $search = "%" .$searchBook."%";
                $search1 = "%" .$searchState."%";
                $statement = $db->prepare('SELECT "libbooks_id","b_title","b_year","lib_name","s_name" FROM "Libbooks", "library","books","City","state" WHERE "libbooks_libid" = "lib_libid" AND "libbooks_bookid" = "b_bookid" AND "lib_cityid" = "city_cityid" AND "city_stateid" = "s_stateid" AND s_name LIKE ?');
                // $statement->bindValue(1, $search);
                $statement->bindValue(1, $search1);
                $result = $statement->execute() or die("Failed to fetch row!");
                $db->exec('COMMIT');
                echo"<table class='table table-bordered'>";     
                echo"<thead class='alert-info'>";
                echo"<tr>";
                        echo"<th>Borrow Id</th>";
                        echo"<th>Book Title</th>";
                        echo"<th>Book Published</th>";
                        echo"<th>Library Name</th>";
                        echo"<th>Library State Location</th>";
                        //add more columns if needed or change column need
                    echo"</tr>";
                    echo"</thead>";
                    // echo"Hello";
                while($fetch=$result->fetchArray()){
                    echo"<tr><td>".$fetch['libbooks_id']."</td><td>".$fetch['b_title']."</td><td>".$fetch['b_year']."</td><td>".$fetch['lib_name']."</td><td>".$fetch['s_name']."</td></tr>";
                }
                echo"</table>";
            }else{
                $db->exec('BEGIN');
                $search = "%" .$searchBook."%";
                $search1 = "%" .$searchState."%";
                $statement = $db->prepare('SELECT "libbooks_id","b_title","b_year","lib_name","s_name" FROM "Libbooks", "library","books","City","state" WHERE "libbooks_libid" = "lib_libid" AND "libbooks_bookid" = "b_bookid" AND "lib_cityid" = "city_cityid" and "b_title" LIKE ? AND "city_stateid" = "s_stateid" AND s_name LIKE ?');
                $statement->bindValue(1, $search);
                $statement->bindValue(2, $search1);
                $result = $statement->execute() or die("Failed to fetch row!");
                $db->exec('COMMIT');
                echo"<table class='table table-bordered'>";     
                echo"<thead class='alert-info'>";
                echo"<tr>";
                        echo"<th>Borrow Id</th>";
                        echo"<th>Book Title</th>";
                        echo"<th>Book Published</th>";
                        echo"<th>Library Name</th>";
                        echo"<th>Library State Location</th>";
                        //add more columns if needed or change column need
                    echo"</tr>";
                    echo"</thead>";
                    // echo"Hello";
                while($fetch=$result->fetchArray()){
                    echo"<tr><td>".$fetch['libbooks_id']."</td><td>".$fetch['b_title']."</td><td>".$fetch['b_year']."</td><td>".$fetch['lib_name']."</td><td>".$fetch['s_name']."</td></tr>";
                }
                echo"</table>";
            }
            
        }
        else if(!$movieSearch && !$searchBook && !$searchCity && !$searchLibrary && !$searchState && $isbnSearch){ //search for isbn
            $db->exec('BEGIN');
            $search = "%" .$isbnSearch."%";
            $statement = $db->prepare('SELECT "libbooks_id","b_isbn13","b_isbn10","b_title","b_year","lib_name" FROM "Libbooks", "library","books" WHERE "libbooks_libid" = "lib_libid" AND "libbooks_bookid" = "b_bookid" and "b_isbn13" LIKE ?');
            $statement->bindValue(1, $search);
            // $statement->bindValue(2, $search);
            $result = $statement->execute() or die("Failed to fetch row!");
            $db->exec('COMMIT');
            echo"<table class='table table-bordered'>";     
            echo"<thead class='alert-info'>";
            echo"<tr>";
				    echo"<th>Borrow Id</th>";
					echo"<th>Book Title</th>";
					echo"<th>Book ISBN</th>";
                    echo"<th>Book Published</th>";
                    echo"<th>Library Name</th>";
					//add more columns if needed or change column need
				echo"</tr>";
                echo"</thead>";
                // echo"Hello";
            while($fetch=$result->fetchArray()){
                echo"<tr><td>".$fetch['libbooks_id']."</td><td>".$fetch['b_title']."</td><td>".$fetch['b_isbn13']."</td><td>".$fetch['b_year']."</td><td>".$fetch['lib_name']."</td></tr>";
            }
            echo"</table>";
        }
        else if(!$movieSearch && !$searchBook && !$searchCity && !$searchLibrary && $searchState && !$isbnSearch){ //search for state
            $db->exec('BEGIN');
           
            $search2 = "%" .$searchState."%";
            $statement = $db->prepare('SELECT "libbooks_id","b_title","b_year","lib_name","city_name","s_name" FROM "Libbooks", "library","books","City","state" WHERE "b_bookid" = "libbooks_bookid" AND "libbooks_libid" = "lib_libid" AND "lib_cityid" = "city_cityid" AND "city_stateid" = "s_stateid" AND s_name LIKE ?');
            $statement->bindValue(1,$search2);
            $result = $statement->execute() or die("Failed to fetch row");
            $db->exec('COMMIT');
            $db->exec('BEGIN');//Movies
            $statement1 = $db->prepare('SELECT "libmovies_id","m_title","m_year","lib_name","city_name","s_name" FROM "movies","library","Libmovies","City","state" WHERE "m_movieid" = "libmovies_movieid"  AND "libmovies_libid" = "lib_libid" AND "lib_cityid" = "city_cityid"AND "city_stateid" = "s_stateid" AND s_name LIKE ?');
            $statement1->bindValue(1, $search2);
            $result1 = $statement1->execute() or die("Failed to fetch row");
            $db->exec('COMMIT');
            list($id,$material,$Year,$Libname,$libcity,$libstate) = $result->fetchArray(PDO::FETCH_NUM);
			list($id1,$material1,$Year1,$Libname1,$libcity1,$libstate1) = $result1->fetchArray(PDO::FETCH_NUM);
            // echo"";
            //table mutation based on the query. In php, you can use echo to make html be able to be used inside the profile.php instead of being kept permanent in html (no if statement in html)
            echo"<table class='table table-bordered'>";
            echo"<thead class='alert-info'>";

				echo"<tr>";
                    echo"<th>Borrow Id</th>";
                    echo"<th>Book Title</th>";
                    echo"<th>Material Published</th>";
                    echo"<th>Library Name</th>";
                    echo"<th>Library City Location</th>";
                    echo"<th>Library State Location</th>";
					//add more columns if needed or change column need
				echo"</tr>";
			echo"</thead>";

            
             if($material){

                echo"<tr><td>".$id."</td><td>".$material."</td><td>".$Year."</td><td>".$Libname."</td><td>".$libcity."</td><td>".$libstate."</td></tr>";
                while($fetch=$result->fetchArray()){
                    echo"<tr><td>".$fetch['libbooks_id']."</td><td>".$fetch['b_title']."</td><td>".$fetch['b_year']."</td><td>".$fetch['lib_name']."</td><td>".$fetch['city_name']."</td><td>".$fetch['s_name']."</td></tr>";
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
                    echo"<th>Library City Location</th>";
                    echo"<th>Library State Location</th>";
					//add more columns if needed or change column need
				echo"</tr>";
			echo"</thead>";
            if($material1){
                
                echo"<tr><td>".$id1."</td><td>".$material1."</td><td>".$Year1."</td><td>".$Libname1."</td><td>".$libcity1."</td><td>".$libstate1."</td></tr>";
                while($fetch=$result1->fetchArray()){
                    echo"<tr><td>".$fetch['libmovies_id']."</td><td>".$fetch['m_title']."</td><td>".$fetch['m_year']."</td><td>".$fetch['lib_name']."</td><td>".$fetch['city_name']."</td><td>".$fetch['s_name']."</td></tr>";
                }
            }
             echo"</table>";
        }
        else if(!$movieSearch && !$searchBook && $searchCity && !$searchLibrary && !$searchState && !$isbnSearch){ //search for city
            $db->exec('BEGIN');
           
            $search2 = "%" .$searchCity."%";
            $statement = $db->prepare('SELECT "libbooks_id","b_title","b_year","lib_name","city_name","s_name" FROM "Libbooks", "library","books","City","state" WHERE "b_bookid" = "libbooks_bookid" AND "libbooks_libid" = "lib_libid" AND "lib_cityid" = "city_cityid" AND "city_stateid" = "s_stateid" AND "city_name" LIKE ?');
            $statement->bindValue(1,$search2);
            $result = $statement->execute() or die("Failed to fetch row");
            $db->exec('COMMIT');
            $db->exec('BEGIN');//Movies
            $statement1 = $db->prepare('SELECT "libmovies_id","m_title","m_year","lib_name","city_name","s_name" FROM "movies","library","Libmovies","City","state" WHERE "m_movieid" = "libmovies_movieid"  AND "libmovies_libid" = "lib_libid" AND "lib_cityid" = "city_cityid"AND "city_stateid" = "s_stateid" AND "city_name" LIKE ?');
            $statement1->bindValue(1, $search2);
            $result1 = $statement1->execute() or die("Failed to fetch row");
            $db->exec('COMMIT');
            list($id,$material,$Year,$Libname,$libcity,$libstate) = $result->fetchArray(PDO::FETCH_NUM);
			list($id1,$material1,$Year1,$Libname1,$libcity1,$libstate1) = $result1->fetchArray(PDO::FETCH_NUM);
            // echo"";
            //table mutation based on the query. In php, you can use echo to make html be able to be used inside the profile.php instead of being kept permanent in html (no if statement in html)
            echo"<table class='table table-bordered'>";
            echo"<thead class='alert-info'>";

				echo"<tr>";
                    echo"<th>Borrow Id</th>";
                    echo"<th>Book Title</th>";
                    echo"<th>Material Published</th>";
                    echo"<th>Library Name</th>";
                    echo"<th>Library City Location</th>";
                    echo"<th>Library State Location</th>";
					//add more columns if needed or change column need
				echo"</tr>";
			echo"</thead>";

            
             if($material){

                echo"<tr><td>".$id."</td><td>".$material."</td><td>".$Year."</td><td>".$Libname."</td><td>".$libcity."</td><td>".$libstate."</td></tr>";
                while($fetch=$result->fetchArray()){
                    echo"<tr><td>".$fetch['libbooks_id']."</td><td>".$fetch['b_title']."</td><td>".$fetch['b_year']."</td><td>".$fetch['lib_name']."</td><td>".$fetch['city_name']."</td><td>".$fetch['s_name']."</td></tr>";
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
                    echo"<th>Library City Location</th>";
                    echo"<th>Library State Location</th>";
					//add more columns if needed or change column need
				echo"</tr>";
			echo"</thead>";
            if($material1){
                
                echo"<tr><td>".$id1."</td><td>".$material1."</td><td>".$Year1."</td><td>".$Libname1."</td><td>".$libcity1."</td><td>".$libstate1."</td></tr>";
                while($fetch=$result1->fetchArray()){
                    echo"<tr><td>".$fetch['libmovies_id']."</td><td>".$fetch['m_title']."</td><td>".$fetch['m_year']."</td><td>".$fetch['lib_name']."</td><td>".$fetch['city_name']."</td><td>".$fetch['s_name']."</td></tr>";
                }
            }
             echo"</table>";
        }
        else{ 
           
            // $pages = new Paginator;
            //table mutation based on the query. In php, you can use echo to make html be able to be used inside the profile.php instead of being kept permanent in html (no if statement in html)      
            echo"<table class='table table-bordered'>";     
            echo"<thead class='alert-info'>";
            
			echo"</thead>";
            echo"<tr><td>"."No Result"."</td><td>"."</td></tr>";
            
            echo"</table>";
        }
        $db->close();
        //etc

    }

?>
