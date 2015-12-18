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
else {
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>LIBRARY LIBRARIAN</title>
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
    border: 1px solid #FFD801;
	margin-top:100px;
}

th {
    background-color: #FFD801;
    color: white;
} -->
</style>
</head>
<body>
	<header>
	<h1><b>LIBRARY PUBLIC</b></h1>
	</header>
	<br>
	<div id="section">
		<form action="changpass.php" method="post" >
			<input type="show" name="name_user" value="Hello <?php echo "".$_SESSION['USERNAME']."" ?>" style="width:300px"class="w3-btn w3-teal">
			<input type="show"  name="date"  id="date" value="<?=date('d-M-Y')?>" style="width:200px" class="w3-btn w3-teal">
			<input type="submit" name="logout" value='logout' class="w3-btn w3-teal">
		</form> 
	</div>
	</br>
	<br>
			<div id="Change password" class="w3-container" style="text-align: center;">
				<form action="changpass.php" method="post" class="w3-form w3-card-4" style="margin-top:10px">
				<h2 class="w3-container w3-teal">Change password</h2>
					<p>
                    <?php
                
			$FORM['username'] = "";
			if (isset($_POST['username'])) $FORM['username'] = htmlspecialchars($_POST['username']);
			?>
                        <h3 style="margin-left:-150px;">USERNAME</h3>
						<input type="text" name="username" value="<?php echo $FORM["username"];?>" style="width:300px">
            
			
			<?php  $FORM['password'] = "";
			if (isset($_POST['password'])) $FORM['password'] = htmlspecialchars($_POST['password']);
			?>
                        <h3 style="margin-left:-150px;">PASSWORD</h3>
						<input type="text" name="password" value="<?php echo $FORM["password"];?>" style="width:300px">
	
					</p>
					<input type="submit" name="submit" value="Change password" class="w3-btn w3-teal">
		
  <?php
$id = ($_SESSION['ID']);
//$username = trim($_POST['username']);
//$password = trim($_POST['password']);

	if(isset($_POST["submit"])){
		
		if(isset($_POST["username"]) and !empty($_POST['username']))	
		{
		if(isset($_POST["password"]) and !empty($_POST['password']))	
		{
		$query = "UPDATE library_login SET username = '".$_POST["username"]."',password ='".$_POST["password"]."' where ID = '$id'";
		$parseRequest = oci_parse($conn, $query);
		oci_execute($parseRequest);
		die( '<script>window.location = "signin.php";</script>');
			}
		}
}
		
			?>			
				</form> 
			</div>
</body>
</html>
