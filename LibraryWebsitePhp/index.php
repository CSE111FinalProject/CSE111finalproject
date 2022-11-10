<?php
require_once('databaseStart.php'); //IF the database or table is not created, the program will create them
include('AccountManage/login.php'); // Includes Login Script
if(isset($_SESSION['login_user'])){
    header("location: profile.php"); // Redirecting To Profile Page
}
//HTML format of the home page
?>
<!DOCTYPE html>
    <html lang="en">
        <head>
            <title>Login Form in PHP</title>
            <link rel="stylesheet" type="text/css" href="css/bootstrap.css" /> 
            <!-- <link href="css/style.css" rel="stylesheet" type="text/css"> -->
        </head>
        <body>
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <a class="navbar-brand" >Library</a>
                </div>
            </nav>
            <div class="col-md-3"></div>
            <div class="col-md-6 well">
            
            <center>
            <h3 class="text-primary">Library Login</h3>
            <hr style="border-top:1px dotted #ccc;"/>
            
                <form action="" method="post">
                    <div class="form-group">
                        <label>UserName :</label>
                        <input id="name" name="username" placeholder="username" type="text" required="required">
                    </div>
                    <div class="form-group">
                        <label>Password :</label>
                        <input id="password" name="password" placeholder="**********" type="password" required="required">
                    </div>
                    <div class="form-group">
                        <input name="submit1" type="submit" value=" Login ">
                    </div>
                </form>
                <form action="Create/createAccount.php" method="post">
                    <div class="form-group">
                        <input name="create" type="submit" value=" Create Account ">
                    </div>
                </form>
                <form action="Newpassword/changepassword.php" method="post">
                    <div class="form-group">
                        <input name="changepassword" type="submit" value=" New Password "> 
                    </div>
                </form>
                    
                <span><?php echo $error; ?></span>
                
            </center>
            </div>
        </body>
    </html>