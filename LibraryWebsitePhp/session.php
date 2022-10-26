<?php
    include('AccountManage/login.php');
    
    $db = new SQLite3('database/librarydatabase.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
  
    // Storing Session
    $user_check = $_SESSION['login_user'];
    
    // SQL Query To Fetch Complete Information Of User
    $statement = $db->prepare('SELECT username FROM "login" WHERE "username" = ?');
    $statement->bindValue(1, $user_check);
    
    //fetch for row information of user
    $result = $statement->execute();
    list($row) = $result->fetchArray(PDO::FETCH_NUM);

    // Make login session the same as the fetched row (Will be displayed in profile page)
    $login_session = $row;
    
    //closing database
    $db->close();
?>