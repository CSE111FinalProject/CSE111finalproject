<?php
    session_start(); // Starting Session
    $error = ''; // Variable To Store Error Message
    if (isset($_POST['submit1'])) {
        
            //Getting information of user input of their username and password when loging in
            $username = $_POST['username'];
            $password = $_POST['password'];

            //getting database open
            $db = new SQLite3('database/librarydatabase.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
            $db->enableExceptions(true);
            $db->exec('BEGIN');

            //preparing for statement
            $statement = $db->prepare('SELECT "c_cardid","c_username", "c_password" FROM "cardholder" WHERE "c_username" = ? AND "c_password" = ?');

            //binding values for the question mark
            $statement->bindValue(1, $username);
            $statement->bindValue(2, $password);

            //excuting the statement
            $result = $statement->execute();

            //commiting the statement
            $db->exec('COMMIT');

            //fetching the query
            list($id,$username,$password) = $result->fetchArray(PDO::FETCH_NUM);
            // $fetch = $result->fetchArray();
            //making sure that the query has value
            if($username && $password){ //fetching the contents of the row {
                $_SESSION['login_user'] = $username; // Initializing Session
                header("location: ../profile.php");
            } // Redirecting To Profile Page
            else{
                $error = "Invalid username and password"; //The error will be displayed
                
            }
            $db->close(); //closing the database
        
    }
    
?>