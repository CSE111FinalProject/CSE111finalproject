<?php
    $error = '';
    include('accessDatabase.php');
    include('session.php');
    // include('../profile.php');
    
    if(isset($_POST['return'])){
        $materialid = $_POST['id'];
        $username = $login_session;
        $materialtype = $_POST['type'];
        $db = new SQLite3('database/'. $databaseName, SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
        $db->enableExceptions(true);
        $db->exec('BEGIN');
        // echo $materialid;
        if($materialtype == "Movie"){
            // echo "Movie";
            $statement = $db->prepare('SELECT "lm_id","lm_loanid", "lm_movieid", "lm_libraryid" FROM "Loanmovies" WHERE "lm_loanid" = ?');
            $statement->bindValue(1, $materialid);
            $result = $statement->execute();
            list($id, $loanid, $movieid, $libraryid) = $result->fetchArray(PDO::FETCH_NUM);
            
            $statement = $db->prepare('SELECT "l_loanid" , "l_cardid", "l_loandate", "l_loanstatus","l_loanlength", "l_fees", "l_feestatus","l_comment" FROM "loans" WHERE "l_loanid" = ?');
            $statement->bindValue(1,$loanid);
            $result = $statement->execute();
            list($lid, $lcardid, $lloandate, $lstatus, $llength, $lfees, $lfeestatus, $lcomment) = $result->fetchArray(PDO::FETCH_NUM);
            // echo $lcardid;
            $statement = $db->prepare('INSERT INTO "pastLoans" ("pl_loanid","pl_cardid","pl_loandate", "pl_loanstatus","pl_loanlength", "pl_fees","pl_feestatus","pl_comment", "pl_type", "pl_materialid","pl_libraryid") VALUES (?,?,?,?,?,?,?,?,?,?,?)');
            $statement->bindValue(1, $lid);
            $statement->bindValue(2, $lcardid);
            $statement->bindValue(3, $lloandate);
            $statement->bindValue(4, $lstatus);
            $statement->bindValue(5, $llength);
            $statement->bindValue(6, $lfees);
            $statement->bindValue(7, $lfeestatus);
            $statement->bindValue(8, $lcomment);
            $statement->bindValue(9, $materialtype);
            $statement->bindValue(10, $movieid);
            $statement->bindValue(11, $libraryid);
            $statement->execute()->finalize();

            $statement = $db->prepare('DELETE FROM "Loanmovies" WHERE "lm_id" = ?');
            $statement->bindValue(1,$id);
            $statement->execute()->finalize();

            $statement = $db->prepare('INSERT INTO "Libmovies" ("libmovies_libid","libmovies_movieid", "libmovies_amount") VALUES (?,?,?)');
            $statement->bindValue(1, $libraryid);
            $statement->bindValue(2, $movieid);
            $statement->bindValue(3, 1);
            $statement->execute()->finalize();
            $db->exec('COMMIT');
            $db->close();
            header("location: ../profile.php");
        }else if($materialtype == "Book") {
             $statement = $db->prepare('SELECT "lb_id","lb_loanid", "lb_bookid", "lb_libraryid" FROM "Loanbooks" WHERE "lb_loanid" = ?');
            $statement->bindValue(1, $materialid);
            $result = $statement->execute();
            list($id, $loanid, $bookid, $libraryid) = $result->fetchArray(PDO::FETCH_NUM);
            
            $statement = $db->prepare('SELECT "l_loanid" , "l_cardid", "l_loandate", "l_loanstatus","l_loanlength", "l_fees", "l_feestatus","l_comment" FROM "loans" WHERE "l_loanid" = ?');
            $statement->bindValue(1,$loanid);
            $result = $statement->execute();
            list($lid, $lcardid, $lloandate, $lstatus, $llength, $lfees, $lfeestatus, $lcomment) = $result->fetchArray(PDO::FETCH_NUM);
            // echo $lcardid;
            $statement = $db->prepare('INSERT INTO "pastLoans" ("pl_loanid","pl_cardid","pl_loandate", "pl_loanstatus","pl_loanlength", "pl_fees","pl_feestatus","pl_comment", "pl_type", "pl_materialid","pl_libraryid") VALUES (?,?,?,?,?,?,?,?,?,?,?)');
            $statement->bindValue(1, $lid);
            $statement->bindValue(2, $lcardid);
            $statement->bindValue(3, $lloandate);
            $statement->bindValue(4, $lstatus);
            $statement->bindValue(5, $llength);
            $statement->bindValue(6, $lfees);
            $statement->bindValue(7, $lfeestatus);
            $statement->bindValue(8, $lcomment);
            $statement->bindValue(9, $materialtype);
            $statement->bindValue(10, $bookid);
            $statement->bindValue(11, $libraryid);
            $statement->execute()->finalize();

            $statement = $db->prepare('DELETE FROM "Loanbooks" WHERE "lb_id" = ?');
            $statement->bindValue(1,$id);
            $statement->execute()->finalize();

            $statement = $db->prepare('INSERT INTO "Libbooks" ("libbooks_libid", "libbooks_bookid", "libbooks_amount" ) VALUES (?,?,?)');
            $statement->bindValue(1, $libraryid);
            $statement->bindValue(2, $bookid);
            $statement->bindValue(3, 1);
            $statement->execute()->finalize();
            
            $db->exec('COMMIT');
            $db->close();
            header("location: ../profile.php");
        }
        
        
    }

?>