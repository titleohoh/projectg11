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
	  <a style="color:white;" href="librarian.php">Menu</a>
	  <a style="color:white;" href="Lend-book.php">Lend book</a>
	  <a style="color:white;" href="Return-book.php">Return book</a>
	  <a style="color:white;" href="Regis-mem.php">Register Member</a>
	  <a style="color:white;" href="Reserv.php">Lend-user</a>
      <a style="color:white;" href="Rese.php">Reservation-user</a>	</div>
	<br><br>
	<div id="section">
		<form action="Reserv.php" method="post" >
			<input type="button" name="name_user" value="Hello <?php echo "".$_SESSION['USERNAME']."" ?>" style="width:300px" class="w3-btn w3-amber">
			<input type="button" name="date" id="date" value="<?=date('d-M-Y')?>" style="width:300px" style="width:300px" class="w3-btn w3-amber">
			<input type="submit" name="logout" value="logout" class="w3-btn w3-amber">
            <input type="submit" name="changpassword" value="Changpassword" class="w3-btn w3-amber">
		</form> 
	</div>
	</br>
	<br>
    <form action="Reserv.php" method="post" class="w3-form w3-card-4">
					<table style="margin-top:-20px;">
					  <tr >
            
						<th style="text-align:center;">Arive Date</th>
						<th style="text-align:center;">Book name</th>
						<th style="text-align:center;">Firstname</th>
						<th style="text-align:center;">Lastname</th>
						<th style="text-align:center;">Phone</th>
					  </tr>
       <?php $query1 = "SELECT * FROM LIBRARY_BOOK,LIBRARY_MEMBER,LIBRARY_LOANS WHERE LIBRARY_LOANS.BOOK_ID = LIBRARY_BOOK.BOOK_ID and status like 'checked out'and LIBRARY_LOANS.MEMBER_ID = LIBRARY_MEMBER.MEMBER_ID and LIBRARY_LOANS.DUE_DATE is null order by ARRIVE_DATE";
		$parseRequest1 = oci_parse($conn, $query1);
		oci_execute($parseRequest1);
		while($row = oci_fetch_array($parseRequest1, OCI_RETURN_NULLS+OCI_ASSOC))
		{
			$_SESSION['ARRIVE_DATE'] = $row['ARRIVE_DATE'];
			$_SESSION['BOOK_NAME'] = $row['BOOK_NAME'];
			$_SESSION['FIRST_NAME'] = $row['FIRST_NAME'];
			$_SESSION['LAST_NAME'] = $row['LAST_NAME'];
			$_SESSION['PHONE'] = $row['PHONE'];

		?>
		<tr>
			<td><div align="center"><?php echo $row["ARRIVE_DATE"];?></div></td>
       	 	<td><div align="center"><?php echo $row["BOOK_NAME"];?></div></td>
       		<td><div align="center"><?php echo $row["FIRST_NAME"];?></div></td>
        	<td><div align="center"><?php echo $row["LAST_NAME"];?></div></td>
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
