<?php
// include('session.php');
require_once'session.php';
// include('search_data.php');
	if(!isset($_SESSION['login_user'])){
		header("location: index.php"); // Redirecting To Home Page
	}
	
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
				<label>Searching in the Database Example - Not yet implemented</label>
				<div class="form-group">
					<label> Search by city: </label>
					<input id = "search" name="citySearch" type = "text" >
				</div>
				<div class="form-group">
					<label>Search by Nation: </label>
					<input id = "search" name="NationSearch" type = "text">
				</div>
				<div class="form-group">
					<label>Book Name: </label>
					<input id = "search" name="bookSearch" type = "text" required="required">
				</div>
				<div class ="form-group">
					<label>Isbn: </label>
					<input id = "search" name = "isbnSearch" type = "text">
				</div>
				<div class ="form-group">
					<label>Library name: </label>
					<input id = "search" name = "librarySearch" type = "text">
				</div>
		
				<!-- <input id = "submitSearch" name="subSearch" type="submit"> -->
				<button class="btn btn-success" name="search"><span class="glyphicon glyphicon-search"></span> Search</button>
			</div>
		</form>
		<?php 
			// $db = new SQLite3("database/librarydatabase.sqlite") or die("Can not open database");
			// $db->close();
		?>
		
		</div>
		</center>
<!-- <input name="logout" type="submit" value="Log Out " href="logout.php"> -->
		<table class="table table-bordered">
			<!-- <thead class="alert-info">
				<tr>
					<th>Id</th>
					<th>Username</th>
					<th>Password</th>
					
				</tr>
			</thead> -->
			
			<tbody>
				<!-- when search is pressed, data will show -->
				<?php include 'search_data.php' ?>
			</tbody>

		</table>
	</div>
	

</body>


</html>



