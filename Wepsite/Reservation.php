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
	text-align:center;
    color: white;
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
	</div><br><br>
	<form name="Search" method="get" action="<?php echo $_SERVER['SCRIPT_NAME'];?>">
	<p>
		<ul class="w3-pagination" style="margin-left:50px">
	  </ul>
			 <?php
		$FORM['txtKeyword'] = "";
		if (isset($_GET['txtKeyword'])) $FORM['txtKeyword'] = htmlspecialchars($_GET['txtKeyword']);
		?>
			<input  name="txtKeyword" type="text" id="txtKeyword" value="<?php echo $FORM["txtKeyword"];?>" style="width:200px">
			<input href="F:\1'58\database\project\research" type="submit" name"search" value="search" class="w3-btn w3-teal" style="margin:right">
		</p>			
	 </form>
	
		<div class="w3-container">
				<br>
				<br>

				<table style="margin-top:-20px;">
				  <tr>
					<th>Reservation</th>
					<th>Book name</th>
					<th>id</th>
					<th>Author</th>
					<th>Type</th>
					<th>year</th>
					<th>Number</th>
					<th>ISBN</th>
					<th>Status</th>
				  </tr>
    

<form class="w3-form"  action="Reservation.php" method="get">
  <?php
  
  if(isset($_GET['txtKeyword']) and !empty($_GET['txtKeyword'])){
		$query1 = "SELECT LIBRARY_BOOK.BOOK_NAME,LIBRARY_BOOK.BOOK_ID,LIBRARY_BOOK.AUTHOR,LIBRARY_BOOK.TYPE,LIBRARY_BOOK.YEAR_OF_PUBLICATION,LIBRARY_BOOK.NUMBER_OF_BOOK,LIBRARY_BOOK.STATUS,LIBRARY_BOOK.ISBN FROM LIBRARY_BOOK LIBRARY_LOAN WHERE (BOOK_NAME LIKE '%".$_GET["txtKeyword"]."%' or AUTHOR LIKE '%".$_GET["txtKeyword"]."%') and STATUS LIKE 'checked out' and ";
		$parseRequest1 = oci_parse($conn, $query1);
		oci_execute($parseRequest1);
		while($row = oci_fetch_array($parseRequest1, OCI_RETURN_NULLS+OCI_ASSOC))
		{
			$_SESSION['BOOK_NAME'] = $row['BOOK_NAME'];
			$_SESSION['BOOK_ID'] = $row['BOOK_ID'];
			$_SESSION['AUTHOR'] = $row['AUTHOR'];
			$_SESSION['TYPE'] = $row['TYPE'];
			$_SESSION['YEAR_OF_PUBLICATION'] = $row['YEAR_OF_PUBLICATION'];
			$_SESSION['NUMBER_OF_BOOK'] = $row['NUMBER_OF_BOOK'];
			$_SESSION['STATUS'] = $row['STATUS'];
			$_SESSION['ISBN'] = $row['ISBN'];
		?>
		<tr>
		<td style="text-align:center;">
			<input name="checkbox1[]" type= "checkbox" class="w3-check" value="<?=$row["BOOK_ID"]?>" >
			</td>
			<td><div align="center"><?php echo $row["BOOK_NAME"];?></div></td>
       	 	<td><div align="center"><?php echo $row["BOOK_ID"];?></div></td>
       		<td><div align="center"><?php echo $row["AUTHOR"];?></div></td>
        	<td><div align="center"><?php echo $row["TYPE"];?></div></td>
        	<td><div align="center"><?php echo $row["YEAR_OF_PUBLICATION"];?></div></td>
        	<td><div align="center"><?php echo $row["NUMBER_OF_BOOK"];?></div></td>
        	<td><div align="center"><?php echo $row["ISBN"];?></div></td>
       		 <td><div align="center"><?php echo $row["STATUS"];?></div></td>
	  		</tr>
       <?php
		}
  }
  else{
	$query1 = "SELECT LIBRARY_BOOK.BOOK_NAME,LIBRARY_BOOK.BOOK_ID,LIBRARY_BOOK.AUTHOR,LIBRARY_BOOK.TYPE,LIBRARY_BOOK.YEAR_OF_PUBLICATION,LIBRARY_BOOK.NUMBER_OF_BOOK,LIBRARY_BOOK.STATUS,LIBRARY_BOOK.ISBN FROM LIBRARY_BOOK WHERE STATUS LIKE 'checked out'";
		$parseRequest1 = oci_parse($conn, $query1);
		oci_execute($parseRequest1);
		while($row = oci_fetch_array($parseRequest1, OCI_RETURN_NULLS+OCI_ASSOC))
		{
			$_SESSION['BOOK_NAME'] = $row['BOOK_NAME'];
			$_SESSION['BOOK_ID'] = $row['BOOK_ID'];
			$_SESSION['AUTHOR'] = $row['AUTHOR'];
			$_SESSION['TYPE'] = $row['TYPE'];
			$_SESSION['YEAR_OF_PUBLICATION'] = $row['YEAR_OF_PUBLICATION'];
			$_SESSION['NUMBER_OF_BOOK'] = $row['NUMBER_OF_BOOK'];
			$_SESSION['STATUS'] = $row['STATUS'];
			$_SESSION['ISBN'] = $row['ISBN'];
		?>
		<tr>
		<td style="text-align:center;">
			<input name="checkbox1[]" type= "checkbox" class="w3-check" value="<?=$row["BOOK_ID"]?>" >
			</td>
			<td><div align="center"><?php echo $row["BOOK_NAME"];?></div></td>
       	 	<td><div align="center"><?php echo $row["BOOK_ID"];?></div></td>
       		<td><div align="center"><?php echo $row["AUTHOR"];?></div></td>
        	<td><div align="center"><?php echo $row["TYPE"];?></div></td>
        	<td><div align="center"><?php echo $row["YEAR_OF_PUBLICATION"];?></div></td>
        	<td><div align="center"><?php echo $row["NUMBER_OF_BOOK"];?></div></td>
        	<td><div align="center"><?php echo $row["ISBN"];?></div></td>
       		 <td><div align="center"><?php echo $row["STATUS"];?></div></td>
	  		</tr>
          <?php
	}
  }
?>

 <br>
 <br>
	<?php
	
 	 $member_id = $_SESSION['ID'];
	$status = $_SESSION['STATUS'];
	$isbn = $_SESSION['ISBN'];
	$date = date('dmyHis');
	$query2 = "select member_ID from library_loans";
	$parseRequest2 = oci_parse($conn, $query2);
	oci_execute($parseRequest2);
	while($row = oci_fetch_array($parseRequest2, OCI_RETURN_NULLS+OCI_ASSOC))
		{
			$_SESSION['MEMBER_ID'] = $row['MEMBER_ID'];
		}
	$member_id1= $_SESSION['MEMBER_ID'];
	if ($member_id == $member_id1){
	}
	else{
		if(isset($_GET['submit']) && isset($_GET['checkbox1']))
			{
				foreach( $_GET['checkbox1'] as $test )
				{
				$query3 ="INSERT INTO LIBRARY_RESERVATION (RESERVATION_ID,ORDER_RESERVATION,MEMBER_ID,ISBN,STATUS)
				VALUES ('R'||'$date','$date','$member_id','$isbn','$status')";
				$parseRequest3 = oci_parse($conn, $query3);
				oci_execute($parseRequest3);
				}
		}
	}
?>
  
</table> 
<br>
 <input type="submit" name="submit" value="reservation" class="w3-btn w3-teal" style="margin-left:700px;">				 
</div>
</form>
<?php
oci_close($conn);
?>
</body>
</html>
