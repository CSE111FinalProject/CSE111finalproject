<?php
// include('session.php');
require_once'session.php';
include('accessDatabase.php');
// include('search_data.php');
	if(!isset($_SESSION['login_user'])){
		header("location: index.php"); // Redirecting To Home Page
	}
	
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Your Home Page</title>
		<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1" />
<!-- <link href="css/profile.css" rel="stylesheet" type="text/css"> -->
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css" /> 
	</head>
<body>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<a class="navbar-brand" >Testing</a>
		</div>
	</nav>
	<center>
	<br>
	
<div class="row">
		<div class="col-md-3"></div> 
		<div class="col-md-6 well">
		
			<h3 class="text-primary">Profile Page</h3>
			<hr style="border-top:1px dotted #ccc;"/>
				<form method="POST" action="AccountManage/logout.php">
					<div class="form-group">
						<label>Welcome :<?php echo $login_session; ?></label>
				
						<input name="logout" type="submit" value=" Log Out ">
					</div>
					<div class="form-group">
						<label>Borrowed Material: </label>
						<?php
							$db = new SQLite3('database/'. $databaseName, SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
							$db->enableExceptions(true);
							$db->exec('BEGIN');
            
							$statement = $db->prepare('SELECT "b_title", "l_loandate","l_fees" FROM "cardholder", "loans","books","Loanbooks" WHERE "c_cardid" = "l_cardid" AND "l_loanid" = "loanbooks_loanid" AND "loanbooks_bookid" = "b_bookid"');
							
							$statement1 = $db->prepare('SELECT * FROM "cardholder", "loans","movies","Loanmovies" WHERE "c_cardid" = "l_cardid" AND "l_loanid" = "loanmovies_loanid" AND "loanmovies_movieid" = "m_movieid"');
							
							$result = $statement->execute() or die("Failed to fetch row!");
							$result1 = $statement1->execute() or die("Failed to fetch row!");
							list($material,$loandate,$fees) = $result->fetchArray(PDO::FETCH_NUM);
							if($material){
								echo"<table class='table table-bordered'>";     
								echo"<thead class='alert-info'>";
								echo"<tr>";
								echo"<th>State Material</th>";
								echo"<th>State Loan Date</th>";
								echo"<th>State Loan Date</th>";
						//add more columns if needed or change column need
								echo"</tr>";
								echo"</thead>";
								while($fetch=$result->fetchArray()){
									echo"<tr><td>".$fetch['b_title']."</td><td>".$fetch['l_loandate']."</td><td>".$fetch['l_fees']."</td></tr>";
								}
								while($fetch=$result1->fetchArray()){
									echo"<tr><td>".$fetch['m_title']."</td><td>".$fetch['l_loandate']."</td><td>".$fetch['l_fees']."</td></tr>";
								}
									echo"</table>";
							}else{
								echo "No Loaned Material";
							}
							$db->close();
						?>
						
					</div>
					
				</form>
				<br>
			<!-- <br/> -->
		</div>
		<div class="w-100 d-none d-md-block"></div>
			</center>
			
		<div class="w-100 d-none d-md-block"></div>
			<center>
			
			<div class="col-md"></div>
			<div class="col-md-6 well">
				<h3 class="text-primary">User Input</h3>
				
				<!-- TABLE CONSTRUCTION -->
				<hr style="border-top:1px dotted #ccc;"/>
				<div class="col-md-6">
					<form method = "POST" action ="">
					<!-- <div class = "form-group"> -->
					<center><h3 class="text-primary">Searching Materials</h3></center>
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
							<label>Isbn Code: </label>
							<input id = "search" name = "isbnSearch" type = "text">
						</div>
						<div class ="form-group">
							<label>Library name: </label>
							<input id = "search" name = "librarySearch" type = "text">
						</div>
						
				
						<!-- <input id = "submitSearch" name="subSearch" type="submit"> -->
						<button class="btn btn-success" name="search"><span class="glyphicon glyphicon-search"></span> Search</button>
						<br>
						</form>
				</div>
				

				
				
				<div class="col-md-6">
				<center><h3 class="text-primary">Borrow Materials</h3></center>
					<!-- <label>Borrow Materials</label> -->
					<form method = "POST" action ="">
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
							<label>Isbn Code: </label>
							<input id = "search" name = "isbnSearch" type = "text">
						</div>
						<div class ="form-group">
							<label>Library name: </label>
							<input id = "search" name = "librarySearch" type = "text">
						</div>
						<button class="btn btn-success" name="borrow"><span class="glyphicon glyphicon-book"></span> Borrow</button>
					</form>
					<br>
				</div>	
				</center>	
				
			</div>

		<!-- <br> -->
		<!-- <div class="w-100 d-none d-md-block"></div> -->
	
	<!-- <div class="col-md"></div>  -->
			<div class="col-md well"style="overflow:auto; height: 450px;">
				<center><h3 class="text-primary">Output</h3></center>
				<hr style="border-top:1px dotted #ccc;"/>
					<tbody>
						<!-- when search is pressed, data will show -->
						<?php include 'search_data.php' ?>
					</tbody>
							
		</div>
			
		</div>
</body>


</html>



