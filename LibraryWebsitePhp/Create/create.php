<?php
// include('createAccount.php');
    session_start(); // Starting Session
    $error = ''; // Variable To Store Error Message
    include('../accessDatabase.php');
    if (isset($_POST['createSubmit'])) {
        
            $username = $_POST['createdUser'];
            $password = $_POST['newPassword'];
            $homeAdress = $_POST['newAddress1'];
            $city = $_POST['newCity'];
            $state = $_POST['newAddress2'];
            $phoneNumber = $_POST['newPhone'];
            $db = new SQLite3('../database/'. $databaseName, SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
            $db->enableExceptions(true);
            $db->exec('BEGIN');
            $search = "%".$city."%";
            $statement = $db->prepare('SELECT "city_cityid" FROM "City" WHERE "city_name" LIKE ?');
            $statement->bindValue(1, $search);
            $result = $statement->execute();
            list($cityid) = $result->fetchArray(PDO::FETCH_NUM);
            if($cityid){
                // list($queryCity) = $result->fetchArray(PDO::FETCH_NUM);
            $ROW = $result->fetchArray();
            $db->exec('COMMIT');
            // $db->close();
            // $db = new SQLite3('../database/librarydatabase.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
            // $db->enableExceptions(true);
            echo $city;
            $db->exec('BEGIN');
            $statement = $db->prepare('INSERT INTO "cardholder" ("c_username","c_password","c_address","c_cityid","c_phone","c_acctbal","c_comment")VALUES (?,?,?,?,?,?,?)');
            $statement->bindValue(1, $username);
            $statement->bindValue(2, $password);
            $statement->bindValue(3, $homeAdress);
            $statement->bindValue(4,$cityid);
            $statement->bindValue(5, $phoneNumber);
            $statement->bindValue(6, 0);
            $statement->bindValue(7,"No comment");
            $result = $statement->execute();
            $db->exec('COMMIT');
            // $db->close();
            // $db = new SQLite3('../database/librarydatabase.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
            // $db->enableExceptions(true);
            $db->exec('BEGIN');
            $statement = $db->prepare('SELECT "c_cardid","c_username" ,"c_password" FROM "cardholder" WHERE "c_username" = ? AND "c_password" = ?');
            $statement->bindValue(1, $username);
            $statement->bindValue(2, $password);
            $result = $statement->execute();
            $db->exec('COMMIT');
            
            list($id,$username,$password) = $result->fetchArray(PDO::FETCH_NUM);
            if($username && $password){ //fetching the contents of the row {
                $_SESSION['login_user'] = $username; // Initializing Session
                header("location: ../profile.php");
            }
            // else{
            //     $error = "Username in database"; //GOBACK TO create account if username is in database
            //     // header("location: createAccount.php");
            // } // Redirecting To Profile Page
            }else{
                $error = "Username in database"; 
            }
            
            $db->close();
                
    }
            

?>