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
else if(isset($_POST['changpassword'])){
	echo '<script>window.location = "changpass.php";</script>';
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
	</br>
	<div class="w3-topnav w3-large w3-amber" style="color:white;">
<div class="w3-topnav w3-large w3-amber" style="color:white;">
	  <a style="color:white;" href="librarian.php">Menu</a>
	  <a style="color:white;" href="Lend-book.php">Lend book</a>
	  <a style="color:white;" href="Return-book.php">Return book</a>
	  <a style="color:white;" href="Regis-mem.php">Register Member</a>
	  <a style="color:white;" href="Reserv.php">Lend-user</a>
      <a style="color:white;" href="Rese.php">Reservation-user</a>
	</div>
	</div>
	<br>
	<div id="section">
		<form action="Regis-mem.php" method="post" >
			<input type="button" name="name_user" value="Hello <?php echo "".$_SESSION['USERNAME']."" ?>" style="width:300px" class="w3-btn w3-amber">
			<input type="button" name="date" id="date" value="<?=date('d-M-Y')?>" style="width:300px" style="width:300px" class="w3-btn w3-amber">
			<input type="submit" name="logout" value="logout" class="w3-btn w3-amber">
            <input type="submit" name="changpassword" value="Changpassword" class="w3-btn w3-amber">
		</form> 
	</div>
	</br>
	<br>
			<div id="Register Member" class="w3-container" style="text-align: center;">
		
        
        <form action="Regis-mem.php" method="post" class="w3-form w3-card-4" style="margin-top:10px">
				<h2 class="w3-container w3-amber">Register Member</h2>
					<p>
                    <?php
			$FORM['Firstname'] = "";
			if (isset($_POST['Firstname'])) $FORM['Firstname'] = htmlspecialchars($_POST['Firstname']);
			?>
						<h3 style="margin-left:0px;">Firstname</h3>
						<input type="text" name="Firstname" value="<?php echo $FORM["Firstname"];?>" style="width:300px">
             <?php
			$FORM['Lastname'] = "";
			if (isset($_POST['Lastname'])) $FORM['Lastname'] = htmlspecialchars($_POST['Lastname']);
			?>
						<h3 style="margin-left:0px;">Lastname</h3>
						<input type="text" name="Lastname" value="<?php echo $FORM["Lastname"];?>" style="width:300px">
            <?php
             $FORM['BIRTHDAY'] = "";
			if (isset($_POST['BIRTHDAY'])) $FORM['BIRTHDAY'] = htmlspecialchars($_POST['BIRTHDAY']);
			?>
                        <h3 style="margin-left:0px;">Birthday</h3>
						<input type="text" name="BIRTHDAY" value="<?php echo $FORM["BIRTHDAY"];?>" style="width:300px">   
             <?php
             $FORM['MEMBER_ID'] = "";
			if (isset($_POST['MEMBER_ID'])) $FORM['MEMBER_ID'] = htmlspecialchars($_POST['MEMBER_ID']);
			?>
						<h3 style="margin-left:0px;">ID</h3>
						<input type="text" name="MEMBER_ID" value="<?php echo $FORM["MEMBER_ID"];?>" style="width:300px">
			  <?php
             $FORM['ADDRESS'] = "";
			if (isset($_POST['ADDRESS'])) $FORM['ADDRESS'] = htmlspecialchars($_POST['ADDRESS']);
			?>
						<h3 style="margin-left:0px;">Address</h3>
						<input type="text" name="ADDRESS" value="<?php echo $FORM["ADDRESS"];?>" style="width:300px">
			 <?php
             $FORM['EMAIL'] = "";
			if (isset($_POST['EMAIL'])) $FORM['EMAIL'] = htmlspecialchars($_POST['EMAIL']);
			?>		
                    	<h3 style="margin-left:0px;">EMAIL</h3>
						<input type="text" name="EMAIL" value="<?php echo $FORM["EMAIL"];?>" style="width:300px">
			 <?php
             $FORM['PHONE'] = "";
			if (isset($_POST['PHONE'])) $FORM['PHONE'] = htmlspecialchars($_POST['PHONE']);
			?>	
    					<h3 style="margin-left:0px;">Phone</h3>
						<input type="text" name="PHONE" value="<?php echo $FORM["PHONE"];?>" style="width:300px">
             			 <?php
             $FORM['HISTORY'] = "";
			if (isset($_POST['HISTORY'])) $FORM['HISTORY'] = htmlspecialchars($_POST['HISTORY']);
			?>
						<h3 style="margin-left-:-250px;">History</h3>
						<input type="text" name="HISTORY" value="<?php echo $FORM["HISTORY"];?>" style="width:300px">
					</p>
                    <br> 
					<input type="submit" name="Add" method="post" value="Add" class="w3-btn w3-amber">
            <?php
	
	if(isset($_POST["Add"])){
		if(isset($_POST["MEMBER_ID"]) and !empty($_POST['MEMBER_ID']))
		{
		 	$query1 = "INSERT INTO LIBRARY_MEMBER (FIRST_NAME,LAST_NAME,BIRTHDAY,MEMBER_ID,ADDRESS,EMAIL,PHONE,HISTORY)
		 			VALUES('".$_POST["Firstname"]."','".$_POST["Lastname"]."','".$_POST["BIRTHDAY"]."','".$_POST["MEMBER_ID"]."','".$_POST["ADDRESS"]."','".$_POST["EMAIL"]."','".$_POST["PHONE"]."','".$_POST["HISTORY"]."')";
					$parseRequest1 = oci_parse($conn, $query1);
					oci_execute($parseRequest1);
					die( '<script>window.location = "Regis-mem.php";</script>');
				}
				else{ echo"คุณต้องใส่IDก่อน";
				}		
		}
			?>
				</form> 
			</div>
    	<?php
oci_close($conn);
?>	
</body>
</html>
