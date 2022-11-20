<?php
    $error = '';
    include('accessDatabase.php');
    include('session.php');
    // include('../profile.php');
    // $materialtype = $_POST['BorrowId'];
    // $materialid = $_POST['BorrowIn'];
    // echo $materialtype;
    // echo "hello";
    if(isset($_POST['Borrowing'])){
        $materialtype = $_POST['Borrow'];
        $materialid = $_POST['BorrowIn'];
        $username = $login_session;
        // echo $username;
        $db = new SQLite3('database/'. $databaseName, SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
        $db->enableExceptions(true);
        $db->exec('BEGIN');
        // $db->exec('COMMIT');
        // $db->close();
        // echo $materialtype;
        if($materialtype == "Movie"){
            // echo $materialtype;
            $statement = $db->prepare('SELECT "c_cardid" FROM "cardholder" WHERE "c_username" = ?');
            $statement->bindValue(1, $username);
            $result = $statement->execute();
            list($userid) = $result->fetchArray(PDO::FETCH_NUM);
            // echo $userid;
            $statement = $db->prepare('INSERT INTO "loans" ("l_cardid","l_loandate", "l_loanstatus","l_loanlength","l_fees", "l_feestatus","l_comment") VALUES (?,?,?,?,?,?,?)');
            $statement->bindValue(1,$userid);
            $statement->bindValue(2,date("m/d/Y"));
            $statement->bindValue(3,"Active");
            $statement->bindValue(4, 5);
            $statement->bindValue(5,0);
            $statement->bindValue(6, 'G');
            $statement->bindValue(7, 'L');
            $statement->execute()->finalize();

            $statement = $db->prepare('SELECT "l_loanid" FROM "loans" ORDER BY "l_loanid" DESC LIMIT 1');
            $result = $statement->execute();
            list($loanid) = $result->fetchArray(PDO::FETCH_NUM);

            $statement = $db->prepare('SELECT "libmovies_movieid", "libmovies_libid" FROM "Libmovies" WHERE "libmovies_id" = ?');
            $statement->bindValue(1,$materialid);
            $result = $statement->execute();
            list($movieid, $libraryid) = $result->fetchArray(PDO::FETCH_NUM);

            $statement = $db->prepare('DELETE FROM "Libmovies" WHERE "libmovies_id" = ?');
            $statement->bindValue(1,$materialid);
            $statement->execute()->finalize();

            $statement = $db->prepare('INSERT INTO "Loanmovies" ("lm_loanid","lm_movieid","lm_libraryid") VALUES (?,?,?)');
            $statement->bindValue(1,$loanid);
            $statement->bindValue(2,$movieid);
            $statement->bindValue(3,$libraryid);
            $statement->execute()->finalize();
            // $statement = $db->prepare('DELETE FROM "Libmovies" WHERE ')
            $db->exec('COMMIT');
            $db->close();
            header("location: ../profile.php");
            // $db->close();
        }else if ($materialtype == "Book"){
            $statement = $db->prepare('SELECT "c_cardid" FROM "cardholder" WHERE "c_username" = ?');
            $statement->bindValue(1, $username);
            $result = $statement->execute();
            list($userid) = $result->fetchArray(PDO::FETCH_NUM);
            // echo $userid;
            $statement = $db->prepare('INSERT INTO "loans" ("l_cardid","l_loandate", "l_loanstatus","l_loanlength","l_fees", "l_feestatus","l_comment") VALUES (?,?,?,?,?,?,?)');
            $statement->bindValue(1,$userid);
            $statement->bindValue(2,date("m/d/Y"));
            $statement->bindValue(3,"Active");
            $statement->bindValue(4, 5);
            $statement->bindValue(5,0);
            $statement->bindValue(6, 'G');
            $statement->bindValue(7, 'L');
            $statement->execute()->finalize();

            $statement = $db->prepare('SELECT "l_loanid" FROM "loans" ORDER BY "l_loanid" DESC LIMIT 1');
            $result = $statement->execute();
            list($loanid) = $result->fetchArray(PDO::FETCH_NUM);

            $statement = $db->prepare('SELECT "libbooks_bookid", "libbooks_libid" FROM "Libbooks" WHERE "libbooks_id" = ?');
            $statement->bindValue(1,$materialid);
            $result = $statement->execute();
            list($bookid, $libraryid) = $result->fetchArray(PDO::FETCH_NUM);

            $statement = $db->prepare('DELETE FROM "Libbooks" WHERE "libbooks_id" = ?');
            $statement->bindValue(1,$materialid);
            $statement->execute()->finalize();

            $statement = $db->prepare('INSERT INTO "Loanbooks" ("lb_loanid","lb_bookid","lb_libraryid") VALUES (?,?,?)');
            $statement->bindValue(1,$loanid);
            $statement->bindValue(2,$bookid);
            $statement->bindValue(3,$libraryid);
            $statement->execute()->finalize();
            // $statement = $db->prepare('DELETE FROM "Libmovies" WHERE ')
            $db->exec('COMMIT');
            $db->close();
            header("location: ../profile.php");
        }
        else{
            header("location: ../profile.php");
        }

    }

?>