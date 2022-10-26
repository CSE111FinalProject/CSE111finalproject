<?php
    session_start(); // Starting Session
    $error = ''; // Variable To Store Error Message
    if(isset($_POST['newpassSubmit'])){
        $username = $_POST['username'];
        $oldpassword = $_POST['OldPassword'];
        $newpassword = $_POST['NewPassword'];
        $db = new SQLite3('../database/librarydatabase.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
        $db->enableExceptions(true);
        $db->exec('BEGIN');
        $statement = $db->prepare('SELECT * FROM "login" WHERE "username" = ? AND "password" = ?');
        $statement->bindValue(1, $username);
        $statement->bindValue(2, $oldpassword);
        $result = $statement->execute();
        $db->exec('COMMIT');
        
        list($queryid,$queryusername,$querypassword) = $result->fetchArray(PDO::FETCH_NUM);
        $db->close();
        if($queryusername == $username && $querypassword == $oldpassword){
            $db = new SQLite3('../database/librarydatabase.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
            $db->enableExceptions(true);
            $db->exec('BEGIN');
            $statement = $db->prepare('UPDATE "login" SET "password" = ? WHERE "password" = ? AND "username" = ?');
            $statement->bindValue(1, $newpassword);
            $statement->bindValue(2,$oldpassword);
            $statement->bindValue(3,$username);
            $result = $statement->execute();
            $db->exec('COMMIT');
            $db->close();
            $db = new SQLite3('../database/librarydatabase.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
            $db->enableExceptions(true);
            $db->exec('BEGIN');
            $statement = $db->prepare('SELECT * FROM "login" WHERE "username" = ? AND "password" = ?');
            $statement->bindValue(1, $username);
            $statement->bindValue(2, $newpassword);
            $result = $statement->execute();
            $db->exec('COMMIT');
            list($queryid,$queryusername,$querypassword) = $result->fetchArray(PDO::FETCH_NUM);
            if($queryusername && $querypassword){
                $_SESSION['login_user'] = $username;
                header("location: ../profile.php");
            }
            $db->close();
            
        }else{
            $error = "Invalid username or password";
        }
    }

?>