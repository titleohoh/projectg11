 <?PHP
 	session_start();
	// Create connection to Oracle
	$conn = oci_connect("system", "Tlee2537", "//localhost/XE","al32utf8");
	if (!$conn) {
		$m = oci_error();
		echo $m['message'], "\n";
		exit;
	}
	?>
    <?PHP
	if(empty($_SESSION['USERNAME']) || empty($_SESSION['PASSWORD']) || empty($_SESSION['TYPE_ID']) || empty($_SESSION['ID'])){
		echo '<script>window.location = "signin.php";</script>';
	}
?>
<?php
if(isset($_POST['logout'])){
	echo '<script>window.location = "logout.php";</script>';
}
else if(isset($_POST['changepassword'])){
	echo '<script>window.location = "changpass.php";</script>';
}
else {
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
<style>
header {
    background-color:#3399FF;
    color:white;
    text-align:left;
    padding:5px;	 
}
<!-- #nav {
    line-height:30px;
    background-color:#eeeeee;
    height:300px;
    width:25%;
    float:left;
    padding:10px;	      
}
a{
	
	text-decoration: none;
}
a:hover{
	text-decoration: underline;
}
#section {
	margin-top:0px;
	float:right;
}
#footer {
    background-color:black;
    color:white;
    clear:both;
    text-align:center;
	padding:5px;
}
table, td, th {
    border: 1px solid #6698FF;
	margin-top:100px;
}

th {
    background-color: #6698FF;
    color: white;
	text-align:center;
} -->
</style>
</head>
<body>

	<header>
	<h1><b>LIBRARY PUBLIC</b></h1>
	</header>
	<br>
	<div class="w3-topnav w3-large w3-cyan" style="color:white;">
    	<form action="LIBRARY-ADMIN.php" method="post">
	  <a type="submit" value='Menu' style="color:white;" href="LIBRARY-Admin.php">Menu</a>
	  <div class="w3-dropdown-hover">
	  <a type="submit" value='Add' style="color:white;" href="">Add</a>
	  <div class="w3-dropdown-content w3-card-4">
		<a type="submit" value='Add book' href="Add-Book.php">Book</a>
		<a type="submit" value='Add Admin' href="Add-Admin.php">Admin</a>
		<a type="submit" value='Add Librarian' href="Add-Librarian.php">Librarian</a>
        <a type="submit" value='User login' href="User-login.php">User Login</a>
	  </div>
	  </div>
	  <div class="w3-dropdown-hover">
		<a type="submit" value='Delete' style="color:white;" href="#">Delete</a>
	  <div class="w3-dropdown-content w3-card-4">
		<a type="submit" value='Delete book' href="De-book.php">Book</a>
		<a type="submit" value='Admin' href="De-admin.php">Admin</a>
		<a type="submit" value='Librarian' href="De-librarian.php">Librarian</a>
		<a type="submit" value='Member' href="De-mem.php">Member</a>
        <a type="submit" value='User-login' href="De-log.php">User-login</a>
		</div>
	  </div>
	</div>
	</div>
	<br>
	<div id="section">
		
			<input type="button" name="name_user" class="w3-btn w3-cyan" value="Hello <?php echo "".$_SESSION['USERNAME']."" ?>" style="width:200px">
			<input type="button"  name="date"  class="w3-btn w3-cyan" id="date" value="<?=date('d-M-Y')?>" style="width:300px">
			<input type="submit" name="logout" value='logout' class="w3-btn w3-cyan">
            <input type="submit" name="changepassword" value="changepassword"  class="w3-btn w3-cyan">
		</form> 
<?php
oci_close($conn);
?>	
</body>
</html>
