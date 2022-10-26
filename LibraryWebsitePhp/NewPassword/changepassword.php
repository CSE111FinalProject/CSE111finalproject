<?php
include('insertNewpassword.php');
// if(isset($_POST['changepassword'])){
    if(isset($_SESSION['login_user'])){
        header("location: ../profile.php"); // Redirecting To Profile Page
    }
// }
?>
<!DOCTYPE html>
<html lang="en">
    <head>  
        <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.css" />
        <title>New Password Form in PHP</title>
    </head>
    <body>
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                <form method="POST" action="../index.php">
                <input name="goback" type="submit" value=" Home ">>
                </form>
                </div>
            </nav>
            <!-- <div id="CreateAccount"> -->
            <div class="col-md-3"></div>
            <div class="col-md-6 well">
            <!-- <h2>Create Account</h2> -->
            <center>
                <h3 class="text-primary">New Password</h3>
                <hr style="border-top:1px dotted #ccc;"/>
                
                <form method="POST" action="">
                    <div class="form-group">
                        <label>User Name :</label>
                        <input id="user" name="username" placeholder="username" type="text" required="required">
                    </div>
                    <div class="form-group">
                        <label>Old Password :</label>
                        <input id="oldpass" name="OldPassword" placeholder="**********" type="password" required="required">
                    </div>
                    <div class="form-group">
                        <label>New Password :</label>
                        <input id="newpass" name="NewPassword" placeholder="**********" type="password" required="required">
                    </div>
                    <div class="form-group">
                        <input name="newpassSubmit" type="submit" value="Change Password">
                    </div>
                    <span><?php echo $error; ?></span>
                </form>
            </center>
            </div>
    </body>

</html>