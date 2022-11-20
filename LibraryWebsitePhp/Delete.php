<?php
    // session_start();
    $error = '';
    include('accessDatabase.php');
    include_once('session.php');
    if(isset($_POST['delete'])){ 
        $userquery = $login_session;
        $db = new SQLite3('database/'. $databaseName, SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
        $db->enableExceptions(true);
        $db->exec('BEGIN');

        $statement = $db->prepare('DELETE FROM "cardholder" WHERE "c_username" = ?');

        $statement->bindValue(1, $userquery);

        $result = $statement->execute();

        $db->exec('COMMIT');
        $db->close();
        header("Location: /AccountManage/logout.php");
    }
?>