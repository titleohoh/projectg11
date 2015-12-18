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
<form action="Return-book.php" method="post" class="w3-form w3-card-4" style="margin-top:10px;text-align:center;">
	 <h2 class="w3-container w3-amber">Return book</h2>
     <br>
    <div id="Return book" class="w3-container" style="text-align: center;">
    <table style="margin-top:-20px;">
					  <tr>
                      	<th style="text-align:center;">Due</th>
                      	<th style="text-align:center;">Loan ID</th>
						<th style="text-align:center;">Book ID</th>
						<th style="text-align:center;">Loan Date</th>
						<th style="text-align:center;">Arrive Date</th>
						<th style="text-align:center;">Due Date</th>
                        <th style="text-align:center;">Renew</th>
						<th style="text-align:center;">Member ID</th>
					  </tr>
  <?php
  
		$query1 = "select * from library_loans order by due_date";
		$parseRequest1 = oci_parse($conn, $query1);
		oci_execute($parseRequest1);
		while($row = oci_fetch_array($parseRequest1, OCI_RETURN_NULLS+OCI_ASSOC))
		{
			$_SESSION['LOAN_ID'] = $row['LOAN_ID'];
			$_SESSION['BOOK_ID'] = $row['BOOK_ID'];
			$_SESSION['LOAN_DATE'] = $row['LOAN_DATE'];
			$_SESSION['ARRIVE_DATE'] = $row['ARRIVE_DATE'];
			$_SESSION['DUE_DATE'] = $row['DUE_DATE'];
			$_SESSION['RENEW'] = $row['RENEW'];
			$_SESSION['MEMBER_ID'] = $row['MEMBER_ID'];
		?>
		<tr>
		<td >
			<input name="checkbox1[]" type= "checkbox" class="w3-check" value="<?=$row["BOOK_ID"]?>" >
			</td>
			<td><div align="center"><?php echo $row["LOAN_ID"];?></div></td>
       	 	<td><div align="center"><?php echo $row["BOOK_ID"];?></div></td>
       		<td><div align="center"><?php echo $row["LOAN_DATE"];?></div></td>
        	<td><div align="center"><?php echo $row["ARRIVE_DATE"];?></div></td>
        	<td><div align="center"><?php echo $row["DUE_DATE"];?></div></td>
            <td><div align="center"><?php echo $row["RENEW"];?></div></td>
        	<td><div align="center"><?php echo $row["MEMBER_ID"];?></div></td>
	  		</tr>
      
       <?php
		}
?>		
 
  
  
  <?php
$date = date('d-M-y');
	if(isset($_POST['submit']) && isset($_POST['checkbox1']))
			{
				foreach( $_POST['checkbox1'] as $test )
				{
				$query3 ="UPDATE LIBRARY_LOANS SET DUE_DATE='$date' WHERE BOOK_ID='$test'";
				$parseRequest3 = oci_parse($conn, $query3);
				oci_execute($parseRequest3);
				$query4 ="UPDATE LIBRARY_BOOK SET status='available' WHERE BOOK_ID='$test'";
				$parseRequest4 = oci_parse($conn, $query4);
				oci_execute($parseRequest4);
				}
				die( '<script>window.location = "Return-book.php";</script>');
			}
  ?>
    </table>
   <br>
  <input type="submit" name="submit" value="Return" class="w3-btn w3-amber">
  
</form> 

			</div>
       <?php   	 
  										
oci_close($conn);
?>

		
</body>
</html>
