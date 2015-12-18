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
	background-color:white;
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
	
	  <a style="color:white;" href="librarian.php">Menu</a>
	  <a style="color:white;" href="Lend-book.php">Lend book</a>
	  <a style="color:white;" href="Return-book.php">Return book</a>
	  <a style="color:white;" href="Regis-mem.php">Register Member</a>
	  <a style="color:white;" href="Reserv.php">Lend-user</a>
      <a style="color:white;" href="Rese.php">Reservation-user</a>
	</div>
	<br>
	<div id="section">
		<form action="Rese.php" method="post" >
			<input type="button" name="name_user" value="Hello <?php echo "".$_SESSION['USERNAME']."" ?>" style="width:300px" class="w3-btn w3-amber">
			<input type="button" name="date" id="date" value="<?=date('d-M-Y')?>" style="width:300px" style="width:300px" class="w3-btn w3-amber">
			<input type="submit" name="logout" value="logout" class="w3-btn w3-amber">
            <input type="submit" name="changpassword" value="Changpassword" class="w3-btn w3-amber">
		</form> 
	</div>
	</br>
	<br>
    <p></p>
    <p></p>
    <form action="Rese.php" method="post" class="w3-form w3-card-4">
					<table style="margin-top:-20px;text-align:center;">
					  <tr >
            
						<th style="text-align:center;">RESERVATION ID</th>
						<th style="text-align:center;">ORDER RESERVATIN</th>
						<th style="text-align:center;">MEMBER_ID</th>
                        <th style="text-align:center;">FIRSTNAME</th>
						<th style="text-align:center;">ISBN</th>
						<th style="text-align:center;">STATUS</th>
                        <th style="text-align:center;">PHONE</th>
					  </tr>
       <?php $query1 = "SELECT * FROM LIBRARY_BOOK,LIBRARY_MEMBER,LIBRARY_RESERVATION WHERE LIBRARY_RESERVATION.MEMBER_ID = LIBRARY_MEMBER.MEMBER_ID and LIBRARY_BOOK.ISBN = LIBRARY_RESERVATION.ISBN ";
		$parseRequest1 = oci_parse($conn, $query1);
		oci_execute($parseRequest1);
		while($row = oci_fetch_array($parseRequest1, OCI_RETURN_NULLS+OCI_ASSOC))
		{
			$_SESSION['RESERVATION_ID'] = $row['RESERVATION_ID'];
			$_SESSION['ORDER_RESERVATIN'] = $row['ORDER_RESERVATION'];
			$_SESSION['MEMBER_ID'] = $row['MEMBER_ID'];
			$_SESSION['FIRST_NAME'] = $row['FIRST_NAME'];
			$_SESSION['ISBN'] = $row['ISBN'];
			$_SESSION['STATUS'] = $row['STATUS'];
			$_SESSION['PHONE'] = $row['PHONE'];

		?>
		<tr>
			<td><div align="center"><?php echo $row["RESERVATION_ID"];?></div></td>
       	 	<td><div align="center"><?php echo $row["ORDER_RESERVATION"];?></div></td>
       		<td><div align="center"><?php echo $row["FIRST_NAME"];?></div></td>
            <td><div align="center"><?php echo $row["MEMBER_ID"];?></div></td>
        	<td><div align="center"><?php echo $row["ISBN"];?></div></td>
            <td><div align="center"><?php echo $row["STATUS"];?></div></td>
        	<td><div align="center"><?php echo $row["PHONE"];?></div></td>
 
          <?php
		}
?>	  
 </table> 
 <?php
 ?> 
		</form>
	</div>
	</div>

</body>
</html>
