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
        $statement = $db->prepare('SELECT "l_loanid" , "l_cardid", "l_loandate", "l_loanstatus","l_loanlength", "l_fees", "l_feestatus","l_comment","lm_movieid", "lm_libraryid","lm_id" FROM "loans","cardholder","Loanmovies" WHERE "lm_loanid" = "l_loanid" AND "l_cardid" = "c_cardid" AND "c_username" = ?');
        $statement->bindValue(1, $userquery);
        $result = $statement->execute();
        // $db->exec('COMMIT');
        while(list($lid, $lcardid, $lloandate, $lstatus, $llength, $lfees, $lfeestatus, $lcomment,$movieid,$libraryid,$lmid) = $result->fetchArray(PDO::FETCH_NUM)){
            $statement = $db->prepare('INSERT INTO "pastLoans" ("pl_loanid","pl_cardid","pl_loandate", "pl_loanstatus","pl_loanlength", "pl_fees","pl_feestatus","pl_comment", "pl_type", "pl_materialid","pl_libraryid") VALUES (?,?,?,?,?,?,?,?,?,?,?)');
            $statement->bindValue(1, $lid);
            $statement->bindValue(2, $lcardid);
            $statement->bindValue(3, $lloandate);
            $statement->bindValue(4, $lstatus);
            $statement->bindValue(5, $llength);
            $statement->bindValue(6, $lfees);
            $statement->bindValue(7, $lfeestatus);
            $statement->bindValue(8, $lcomment);
            $statement->bindValue(9, "Movie");
            $statement->bindValue(10, $movieid);
            $statement->bindValue(11, $libraryid);
            $statement->execute();

            $statement = $db->prepare('INSERT INTO "Libmovies" ("libmovies_libid","libmovies_movieid", "libmovies_amount") VALUES (?,?,?)');
            $statement->bindValue(1, $libraryid);
            $statement->bindValue(2, $movieid);
            $statement->bindValue(3, 1);
            $statement->execute();

            $statement = $db->prepare('DELETE FROM "Loanmovies" WHERE "lm_id" = ?');
            $statement->bindValue(1,$lmid);
            $statement->execute();
            
        }

        $statement = $db->prepare('SELECT "l_loanid" , "l_cardid" , "l_loandate" , "l_loanstatus" , "l_loanlength" , "l_fees" , "l_feestatus" , "l_comment" , "lb_bookid" , "lb_libraryid" , "lb_id" FROM "loans", "cardholder", "Loanbooks" WHERE "lb_loanid" = "l_loanid" AND "l_cardid" = "c_cardid" AND "c_username"= ? ');
        $statement->bindValue(1, $userquery);
        $result = $statement->execute();

        // $db->exec('COMMIT');
        while(list($lid, $lcardid, $lloandate, $lstatus, $llength, $lfees, $lfeestatus, $lcomment,$bookid,$libraryid, $lbid) = $result->fetchArray(PDO::FETCH_NUM)){
            $statement = $db->prepare('INSERT INTO "pastLoans" ("pl_loanid","pl_cardid","pl_loandate", "pl_loanstatus","pl_loanlength", "pl_fees","pl_feestatus","pl_comment", "pl_type", "pl_materialid","pl_libraryid") VALUES (?,?,?,?,?,?,?,?,?,?,?)');
            $statement->bindValue(1, $lid);
            $statement->bindValue(2, $lcardid);
            $statement->bindValue(3, $lloandate);
            $statement->bindValue(4, $lstatus);
            $statement->bindValue(5, $llength);
            $statement->bindValue(6, $lfees);
            $statement->bindValue(7, $lfeestatus);
            $statement->bindValue(8, $lcomment);
            $statement->bindValue(9, "Book");
            $statement->bindValue(10, $bookid);
            $statement->bindValue(11, $libraryid);
            $statement->execute()->finalize();


            $statement = $db->prepare('INSERT INTO "Libbooks" ("libbooks_libid", "libbooks_bookid", "libbooks_amount" ) VALUES (?,?,?)');
            $statement->bindValue(1, $libraryid);
            $statement->bindValue(2, $bookid);
            $statement->bindValue(3, 1);
            $statement->execute();

            $statement = $db->prepare('DELETE FROM "Loanbooks" WHERE "lb_id" = ?');
            $statement->bindValue(1,$lbid);
            $statement->execute()->finalize();
            
        }
        
  
        $statement = $db->prepare('DELETE FROM "cardholder" WHERE "c_username" = ?');

        $statement->bindValue(1, $userquery);

        $result = $statement->execute();
        $db->exec('COMMIT');

        
        $db->close();
        header("Location: /AccountManage/logout.php");
    }
?>