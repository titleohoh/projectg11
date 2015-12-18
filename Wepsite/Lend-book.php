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
      <a style="color:white;" href="Rese.php">Reservation-user</a>
	</div>
	<br>
	<div id="section">
		<form action="Lend-book.php" method="post" >
			<input type="button" name="name_user" value="Hello <?php echo "".$_SESSION['USERNAME']."" ?>" style="width:300px" class="w3-btn w3-amber">
			<input type="button" name="date" id="date" value="<?=date('d-M-Y')?>" style="width:300px" style="width:300px" class="w3-btn w3-amber">
			<input type="submit" name="logout" value="logout" class="w3-btn w3-amber">
            <input type="submit" name="changpassword" value="Changpassword" class="w3-btn w3-amber">
		</form> 
	</div>
	</br>
	<br>
			<div id="Lend book" method="post" class="w3-container" style="text-align: center;">
				<form action="Lend-book.php" method="post" class="w3-form w3-card-4" style="margin-top:10px">
				<h2 class="w3-container w3-amber">Lend book</h2>
					<p>		
            <?php
			$FORM['MEMBER_ID'] = "";
			if (isset($_POST['MEMBER_ID'])) $FORM['MEMBER_ID'] = htmlspecialchars($_POST['MEMBER_ID']);
			?>			<h3 style="margin-left:-180px;">MEMBER ID</h3>
						<input type="text" name="MEMBER_ID" value="<?php echo $FORM["MEMBER_ID"];?>" style="width:300px">
						<h3 style="margin-left:-200px;">BOOK_ID</h3>
               <?php
			$FORM['BOOK_ID'] = "";
			if (isset($_POST['BOOK_ID'])) $FORM['BOOK_ID'] = htmlspecialchars($_POST['BOOK_ID']);
			?>
						<input type="text" name="BOOK_ID" value="<?php echo $FORM["BOOK_ID"];?>" style="width:300px">
					</p>
					<input type="submit" name="submit" value="Lend" class="w3-btn w3-amber">
                <?php
				
	$date = date('d-M-Y');
	$date2 = date('dmyHis');
	$updatedate = date('d-M-Y', strtotime($date. ' + 7 days'));
	if(isset($_POST["submit"])){
		
	if(isset($_POST["MEMBER_ID"]) and !empty($_POST['MEMBER_ID']))	
	{		
			if(isset($_POST["BOOK_ID"]) and !empty($_POST['BOOK_ID']))	
			{		
					$query = "select * from library_book where book_id = '".$_POST["BOOK_ID"]."'";
					$parseRequest = oci_parse($conn, $query);
					oci_execute($parseRequest);
					while($row = oci_fetch_array($parseRequest, OCI_RETURN_NULLS+OCI_ASSOC))
					{
					$_SESSION['BOOK_ID'] = $row['BOOK_ID'];
					$_SESSION['BOOK_NAME'] = $row['BOOK_NAME'];
					$_SESSION['TYPE'] = $row['TYPE'];
					}
					
				$BOOK_ID = $_SESSION['BOOK_ID'];
				$BOOK_NAME= $_SESSION['BOOK_NAME'];
				$TYPE = $_SESSION['TYPE'];
				$query1 = "INSERT INTO LIBRARY_LOANS (loan_id,book_id,loan_date,arrive_date,due_date,renew,member_id)
VALUES('L'||'$date2','".$_POST["BOOK_ID"]."','$date','$updatedate',null,0,'".$_POST["MEMBER_ID"]."')";
					$parseRequest1 = oci_parse($conn, $query1);
					oci_execute($parseRequest1);
					
				$query2 = "update library_book set status = 'checked out' where book_id ='$BOOK_ID'";
					$parseRequest2 = oci_parse($conn, $query2);
					oci_execute($parseRequest2);
				
					die( '<script>window.location = "Lend-book.php";</script>');		
		}
		else{ echo"คุณต้องใส่BOOK IDก่อน";}			
	}
	else{ echo"คุณต้องใส่MEMBER IDก่อน";}		
}
?>
				</form> 
			</div>
			
 <?php
oci_close($conn);
?>	
</body>
</html>
