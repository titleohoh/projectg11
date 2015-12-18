<?PHP
	session_start();
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
	</div><br>
<form name="Search" method="get" action="<?php echo $_SERVER['SCRIPT_NAME'];?>">
	<p>
		<ul class="w3-pagination" style="margin-left:50px">
        <?php
		$FORM['txtKeyword'] = "";
		if (isset($_GET['gender'])) $FORM['gender'] = htmlspecialchars($_GET['gender']);
		?>
			<input name="gender" type="radio" required="required" class="w3-radio" value="Keyword">
		  <li class="w3-validate">Keyword</li>
			<input name="gender" type="radio" required="required" class="w3-radio" value="Title">
			<li class="w3-validate">Title</li>
			<input name="gender" type="radio" required="required" class="w3-radio" value="Author">
			<li class="w3-validate">Author</li>
		</ul>
			        <?php
		$FORM['txtKeyword'] = "";
		if (isset($_GET['txtKeyword'])) $FORM['txtKeyword'] = htmlspecialchars($_GET['txtKeyword']);
		?>
			<input  name="txtKeyword" type="text" id="txtKeyword" value="<?php echo $FORM["txtKeyword"];?>" style="width:200px">
			<input href="F:\1'58\database\project\research" type="submit" name"search" value="search" class="w3-btn w3-teal" style="margin:right">
</form>
		</p>			
		<div class="w3-container">
			<form action="research1.php" class="w3-form w3-card-4" style="margin-top:10px;text-align:center;">
				<br>
				<br>
    <?PHP
$conn = oci_connect("system", "Tlee2537", "//localhost/XE","al32utf8");
if (!$conn) {
	$m = oci_error();
	echo $m['message'], "\n";
	exit;
} 	
?>

				<table style="margin-top:-20px;">
				  <tr>
					<th>Book name</th>
					<th>id</th>
					<th>Author</th>
					<th>Type</th>
					<th>year</th>
					<th>Number</th>
					<th>Code</th>
					<th>Status</th>
				  </tr>
<?PHP
if(isset($_GET['txtKeyword']) and !empty($_GET['txtKeyword'])){
$gender = $_GET['gender'];
if($gender == "Keyword"){
$query1 = "SELECT BOOK_NAME,BOOK_ID,AUTHOR,TYPE,YEAR_OF_PUBLICATION,NUMBER_OF_BOOK,STATUS,ISBN FROM LIBRARY_BOOK WHERE (BOOK_NAME LIKE '%".$_GET["txtKeyword"]."%' or AUTHOR LIKE '%".$_GET["txtKeyword"]."%' )";
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
else if($gender == "Title"){
$query1 = "SELECT BOOK_NAME,BOOK_ID,AUTHOR,TYPE,YEAR_OF_PUBLICATION,NUMBER_OF_BOOK,STATUS,ISBN FROM LIBRARY_BOOK WHERE BOOK_NAME LIKE '%".$_GET["txtKeyword"]."%'";
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
if($gender == "Author"){
$query1 = "SELECT BOOK_NAME,BOOK_ID,AUTHOR,TYPE,YEAR_OF_PUBLICATION,NUMBER_OF_BOOK,STATUS,ISBN FROM LIBRARY_BOOK WHERE AUTHOR LIKE '%".$_GET["txtKeyword"]."%'";
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
 </table> 
 <br>
 <br>
  </form>   
            
</div>
</body>
</html>
<?php
	}
oci_close($conn);
?>