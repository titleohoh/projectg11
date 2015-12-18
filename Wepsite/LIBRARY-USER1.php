<?PHP
	session_start();
	// Create connection to Oracle
	$conn = oci_connect("system", "Tlee2537", "//localhost/XE");
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
	<title>LIBRARY USER</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
	  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
	  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	  <link rel="stylesheet" href="/resources/demos/style.css">
	  <script>
	  $(function() {
		$( "#datepicker" ).datepicker();
	  });
	  </script>
<style>
header {
    background-color:#3399FF;
    color:white;
    text-align:left;
    padding:5px;	 
}
#nav {
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
    border: 1px solid teal;
	margin-top:100px;
}

th {
    background-color: teal;
    color: white;
	text-align:center;
}

fieldset {
    border: 0;
}
label {
    display: block;
    margin: 30px 0 0 0;
}
select {
     width: 200px;
}
.overflow {
    height: 200px;
}

</style>
</head>
<body>

	<header>
	<h1><b>LIBRARY PUBLIC</b></h1>
	</header>
	<br>
	<div class="w3-topnav w3-large w3-teal"> 		
		<form action="LIBRARY-USER1.php" method="post" >
	  <a type="submit" value='Home' style="color:white;" href="LIBRARY-USER1.php">Home</a>
	  <a type="submit" value='Renews' style="color:white;" href="renew.php">Renews</a>
	  <a type="submit" value='Reservations' style="color:white;" href="Reservation.php">Reservations</a>
	  <a type="submit" value='Research' style="color:white;" href="research1.php">Research</a>
	</div>
	</br>
	<div id="section">
			<input type="show" name="name_user" value="Hello <?php echo "".$_SESSION['USERNAME']."" ?>" style="width:300px"class="w3-btn w3-teal">
			<input type="show"  name="date"  id="date" value="<?=date('d-M-Y')?>" style="width:200px" class="w3-btn w3-teal">
			<input type="submit" name="logout" value='logout' class="w3-btn w3-teal">
			<input type="submit" name="changepassword" value="changepassword" class="w3-btn w3-teal">
		</form> 
</body>
</html>
