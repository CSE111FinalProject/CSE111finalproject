<?php
// include('createAccount.php');
    session_start(); // Starting Session
    $error = ''; // Variable To Store Error Message
    
    if (isset($_POST['createSubmit'])) {
        
            $username = $_POST['createdUser'];
            $password = $_POST['newPassword'];
            
            
            $db = new SQLite3('../database/librarydatabase.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
            $db->enableExceptions(true);
            $db->exec('BEGIN');
            $statement = $db->prepare('INSERT INTO "login" ("username","password")VALUES (?,?) ');
            $statement->bindValue(1, $username);
            $statement->bindValue(2, $password);
            $result = $statement->execute();
            $db->exec('COMMIT');
            $db->close();
            $db = new SQLite3('../database/librarydatabase.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
            $db->enableExceptions(true);
            $db->exec('BEGIN');
            $statement = $db->prepare('SELECT * FROM "login" WHERE "username" = ? AND "password" = ?');
            $statement->bindValue(1, $username);
            $statement->bindValue(2, $password);
            $result = $statement->execute();
            $db->exec('COMMIT');
            
            list($id,$username,$password) = $result->fetchArray(PDO::FETCH_NUM);
            if($username && $password){ //fetching the contents of the row {
                $_SESSION['login_user'] = $username; // Initializing Session
                header("location: ../profile.php");
            }
            else{
                $error = "Username in database"; //GOBACK TO create account if username is in database
                // header("location: createAccount.php");
            } // Redirecting To Profile Page
            $db->close();
                
    }
            

?>