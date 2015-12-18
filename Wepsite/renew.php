 <?PHP
	session_start();
	$conn = oci_connect("system", "Tlee2537", "//localhost/XE","al32utf8");
	if (!$conn) {
		$m = oci_error();
		echo $m['message'], "\n";
		exit;
	} 	
?>
<?PHP
	if(empty($_SESSION['USERNAME']) || empty($_SESSION['PASSWORD']) || empty($_SESSION['ID'])){
		echo '<script>window.location = "signin.php";</script>';
	}
?>
<?PHP

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
	  <a type="submit" value='Home' style="color:white;" " href="LIBRARY-USER1.php">Home</a>
	  <a type="submit" value='Renews' style="color:white;" href="renew.php">Renews</a>
	  <a type="submit" value='Reservations' style="color:white;" href="Reservation.php">Reservations</a>
	  <a type="submit" value='Research' style="color:white;" href="research1.php">Search</a>
	</div>
	</br>
	<div id="section">
    	<input type="show" name="name_user" value="Hello <?php echo "".$_SESSION['USERNAME']."" ?>" style="width:300px"class="w3-btn w3-teal">
		<input type="show"  name="date"  id="date" value="<?=date('d-M-Y')?>" style="width:200px" class="w3-btn w3-teal">
		<input type="submit" name="logout" value='logout' href="logout.php" class="w3-btn w3-teal">
		<input type="submit" name="changepassword" value="changepassword" href="Reservation.php" class="w3-btn w3-teal"> 
	</div><br>
    </form>
		<div  class="w3-container" style="margin-left:%;text-align: center;">
				<h2 class="w3-container w3-teal">Renews</h2>
				<br>
				<br>

		  <table style="margin-top:-20px;">
				  <tr >
					<th>renew</th>
                    <th>LOAN_ID</th>
                    <th>BOOK NAME</th>
                    <th>ID</th>
                    <th>renewed</th>
					<th>ARRIVE DATE</th>
				  </tr>
				  <tr>
 <form class="w3-form" action="renew.php" method="post">
<?php

$member_id = $_SESSION['ID'];
$date = date('d-M-y');
$query = "SELECT * FROM LIBRARY_LOANS,LIBRARY_BOOK where member_id='$member_id' and LIBRARY_LOANS.BOOK_ID=LIBRARY_BOOK.BOOK_ID and ARRIVE_DATE >= '$date'";
$parseRequest = oci_parse($conn, $query);
oci_execute($parseRequest);
while($row = oci_fetch_array($parseRequest, OCI_RETURN_NULLS+OCI_ASSOC))
{
		$_SESSION['LOAN_ID'] = $row['LOAN_ID'];
		$_SESSION['BOOK_NAME'] = $row['BOOK_NAME'];
		$_SESSION['BOOK_ID'] = $row['BOOK_ID'];
		$_SESSION['RENEW'] = $row['RENEW'];
		$_SESSION['ARRIVE_DATE'] = $row['ARRIVE_DATE'];
		$BOOK_ID = $row['BOOK_ID'];
		$renew = $row['RENEW'];
		
?>                        
 <tr>
 <tr>
<td >
	
	<input name="checkbox[]" type= "checkbox" value="<?=$row["LOAN_ID"]?>" >
	
	</td>
    <td><div align="center"><?php echo $row["LOAN_ID"];?></div></td>	
    <td><div align="center"><?php echo $row["BOOK_NAME"];?></div></td>	
	<td><div align="center"><?php echo $row["BOOK_ID"];?></div></td>
    <td><div align="center"><?php echo $row["RENEW"];?></div></td>
      <td><div align="center"><?php echo $row["ARRIVE_DATE"];?></div></td>
       </tr>       
       <?php
$Date = $date;
$updatedate = date('d-M-Y', strtotime($Date. ' + 7 days'));
}
if(isset($_POST['submit']) && isset($_POST['checkbox']))
			{
				foreach( $_POST['checkbox'] as $test ){
				$query2 = "UPDATE LIBRARY_LOANS SET LOAN_DATE='$date',ARRIVE_DATE = '$updatedate',RENEW=RENEW+1 WHERE LOAN_ID = '$test' and RENEW < 3";
				$parseRequest2 = oci_parse($conn, $query2);
				oci_execute($parseRequest2);
				}
				
				die( '<script>window.location = "renew.php";</script>');
			}				 	   	
?>
 </table> 
		 <input type="submit" name="submit" value="renew" class="w3-btn w3-teal" style="margin:right">
		  </form>
			
		</div>
  <?php   	 
oci_close($conn);
?>
</body>
</html>
