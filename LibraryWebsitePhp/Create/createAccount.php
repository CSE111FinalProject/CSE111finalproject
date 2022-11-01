<?php 

include('create.php'); 
if (isset($_POST['create'])) {
    if(isset($_SESSION['login_user'])){
        header("location: ../profile.php"); // Redirecting To Profile Page
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Create Form in PHP</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.css" />

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
                <h3 class="text-primary">Create Account</h3>
                <hr style="border-top:1px dotted #ccc;"/>
                
                <form action="" method="post">
                    <div class="form-group">
                        <label>UserName :</label>
                        <input id="createName" name="createdUser" placeholder="username" type="text" required="required">
                    </div>
                    <div class="form-group">
                        <label>Password :</label>
                        <input id="createPass" name="newPassword" placeholder="**********" type="password" required="required">
                    </div> 
                    <div class="form-group">
                        <label>Address :</label>
                        <input id="createAddress1" name="newAddress1" placeholder="Home Adreess" type="text" required="required">
                        <!-- <input id="createAddress2" name="newAddress2" placeholder="City" type="text" required="required"> -->
                        <select name="newAddress2" id="createAddress2"> 
                            <option value="Merced">Merced</option>
                            <option value="Los Angeles">Los Angeles</option>
                            <option value="New York">New York</option>
                            <option value="Seatle">Seatle</option>
                            <option value="Sacramento">Sacramento</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Phone Number :</label>
                        <input id="createPhone" name="newPhone" placeholder="***-***-****" type="tel" required="required">
                    </div>
                    <div class="form-group">
                        <input name="createSubmit" type="submit" value="Create Account">     
                    </div>
                    </form>
                
                </form>
                <span><?php echo $error; ?></span>
            </center>
            </div>
    </body>
            
</html>

