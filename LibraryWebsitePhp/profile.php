<?php
// include('session.php');
require_once'session.php';
	if(!isset($_SESSION['login_user'])){
		header("location: index.php"); // Redirecting To Home Page
	}
	//This table will be the searching books. The implementation will change
	$db = new SQLite3('database/librarydatabase.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
	$db->enableExceptions(true);
	$db->exec('BEGIN');
	$statement = $db->prepare('SELECT * FROM "login"');
	// SQL query to select data from database
	$result = $statement->execute();
	$db->exec('COMMIT');
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Your Home Page</title>
<!-- <link href="css/profile.css" rel="stylesheet" type="text/css"> -->
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css" /> 
	</head>
<body>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<a class="navbar-brand" >Testing</a>
		</div>
	</nav>
	<!-- <div id="profile"> -->
	<div class="col-md-3"></div>
	<div class="col-md-6 well">
	<center>
	<h3 class="text-primary">Profile Page</h3>
    <hr style="border-top:1px dotted #ccc;"/>
		<form method="POST" action="AccountManage/logout.php">
		
		<div class="form-group">
		<label>Welcome :<?php echo $login_session; ?></label>
		
		<input name="logout" type="submit" value=" Log Out ">
		</div>
		<!-- <b id="logout"><a href="logout.php">Log Out</a></b> -->
		
		</form>
		<br />
		<div class="col-md-3"></div>
		<div class="col-md-6 well">
		<h3 class="text-primary">Showing Library Accounnt</h3>
		<!-- TABLE CONSTRUCTION -->
		<hr style="border-top:1px dotted #ccc;"/>
		<form method = "POST" action ="">
			<div class = "form-group">
				<label>Searching in the Database</label>
				<input id = "search" name="startSearch" type = "text" required="required">
				<input id = "submitSearch" name="subSearch" type="submit">
			</div>
		</form>
		<?php 
			$db = new SQLite3("database/librarydatabase.sqlite") or die("Can not open database");
			$db->close();
		?>
		<table class="table table-bordered">
			<thead class="alert-info">
				<tr>
					<th>Id</th>
					<th>Username</th>
					<th>Password</th>
					<!-- <th>GFG Articles</th> -->
				</tr>
			</thead>
			<!-- PHP CODE TO FETCH DATA FROM ROWS -->
			<?php
				// LOOP TILL END OF DATA
				while($rows=$result->fetchArray(PDO::FETCH_NUM))
				{
			?>
			<tr>
				<!-- FETCHING DATA FROM EACH
					ROW OF EVERY COLUMN -->
					<td><?php echo $rows['user_id'];?></td>
					<td><?php echo $rows['username'];?></td>
					<td><?php echo $rows['password'];?></td>
				
			</tr>
			<?php
				}
                $db->close();
			?>
			<?php ?>

		</table>
		</div>
		</center>
<!-- <input name="logout" type="submit" value="Log Out " href="logout.php"> -->
	</div>
	

</body>


</html>



