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
    border: 1px solid #6698FF;
	margin-top:100px;
}

th {
    background-color: #6698FF;
    color: white;
	text-align:center;
} -->
</style>
</head>
<body>

	<header>
	<h1><b>LIBRARY PUBLIC</b></h1>
	</header>
	<br>
	<div class="w3-topnav w3-large w3-cyan" style="color:white;">
    	<form action="De-mem.php" method="post">
	  	 <a type="submit" value='Menu' style="color:white;" href="LIBRARY-Admin.php">Menu</a>
	  <div class="w3-dropdown-hover">
	  <a type="submit" value='Add' style="color:white;" href="">Add</a>
	  <div class="w3-dropdown-content w3-card-4">
		<a type="submit" value='Add book' href="Add-Book.php">Book</a>
		<a type="submit" value='Add Admin' href="Add-Admin.php">Admin</a>
		<a type="submit" value='Add Librarian' href="Add-Librarian.php">Librarian</a>
        <a type="submit" value='User login' href="User-login.php">User Login</a>
	  </div>
	  </div>
	  <div class="w3-dropdown-hover">
		<a type="submit" value='Delete' style="color:white;" href="#">Delete</a>
	  <div class="w3-dropdown-content w3-card-4">
		<a type="submit" value='Delete book' href="De-book.php">Book</a>
		<a type="submit" value='Admin' href="De-admin.php">Admin</a>
		<a type="submit" value='Librarian' href="De-librarian.php">Librarian</a>
		<a type="submit" value='Member' href="De-mem.php">Member</a>
        <a type="submit" value='User-login' href="De-log.php">User-login</a>
		</div>
	  </div>
	</div>
	<br>
	<div id="section">
			<input type="button" name="name_user" class="w3-btn w3-cyan" value="Hello <?php echo "".$_SESSION['USERNAME']."" ?>" style="width:200px">
			<input type="button"  name="date"  class="w3-btn w3-cyan" id="date" value="<?=date('d-M-Y')?>" style="width:300px">
			<input type="submit" name="logout" value='logout' class="w3-btn w3-cyan">
            <input type="submit" name="changepassword" value="changepassword"  class="w3-btn w3-cyan">
		</form> 
	</div>
    	<form name="Search" method="get" action="<?php echo $_SERVER['SCRIPT_NAME'];?>">
	<p>
		<ul class="w3-pagination" style="margin-left:50px">
		 <?php
		$FORM['txtKeyword'] = "";
		if (isset($_GET['gender'])) $FORM['gender'] = htmlspecialchars($_GET['gender']);
		?>
			<input name="gender" type="radio" required="required" class="w3-radio" value="Firstname">
		  <li class="w3-validate">Firstname</li>
			<input name="gender" type="radio" required="required" class="w3-radio" value="Lastname">
			<li class="w3-validate">Lastname</li>
			<input name="gender" type="radio" required="required" class="w3-radio" value="mem_id">
			<li class="w3-validate">ID</li>
	  </ul>
			 <?php
		$FORM['txtKeyword'] = "";
		if (isset($_GET['txtKeyword'])) $FORM['txtKeyword'] = htmlspecialchars($_GET['txtKeyword']);
		?>
			<input  name="txtKeyword" type="text" id="txtKeyword" value="<?php echo $FORM["txtKeyword"];?>" style="width:200px">
			<input href="F:\1'58\database\project\research" type="submit" name"search" value="search" class="w3-btn w3-teal" style="margin:right">
		</p>			
	 </form> 
		</p>
	</br>
	<br><div id="Delete book" class="w3-container" style="text-align: center;">
			<form action="De-mem.php" class="w3-form w3-card-4" style="margin-top:0px;">
			<h2 class="w3-container w3-cyan">Delete book</h2>
			<br>
			<br>
			<table style="margin-top:-20px;">
			  <tr >
              		
					<th>Delete</th>
					<th>Firsname</th>
					<th>Lastname</th>
					<th>Birthday</th>
					<th>ID</th>
                    <th>ADDRESS</th>
					<th>EMAIL</th>
                    <th>Phone</th>
					<th>History</th>
			  </tr>
    
<?php
  if(isset($_GET['txtKeyword']) and !empty($_GET['txtKeyword'])){
	$gender = $_GET['gender'];
	if($gender == "Firstname"){
		$query1 = "SELECT * FROM LIBRARY_MEMBER WHERE FIRST_NAME LIKE '%".$_GET["txtKeyword"]."%'";
		$parseRequest1 = oci_parse($conn, $query1);
		oci_execute($parseRequest1);
		while($row = oci_fetch_array($parseRequest1, OCI_RETURN_NULLS+OCI_ASSOC))
		{
			$_SESSION['FIRST_NAME'] = $row['FIRST_NAME'];
			$_SESSION['LAST_NAME'] = $row['LAST_NAME'];
			$_SESSION['BIRTHDAY'] = $row['BIRTHDAY'];
			$_SESSION['MEMBER_ID'] = $row['MEMBER_ID'];
			$_SESSION['ADDRESS'] = $row['ADDRESS'];
			$_SESSION['EMAIL'] = $row['EMAIL'];
			$_SESSION['PHONE'] = $row['PHONE'];
			$_SESSION['HISTORY'] = $row['HISTORY'];

		?>
		<tr>
		<td >
			<input name="checkbox1[]" type= "checkbox" class="w3-check" value="<?=$row["MEMBER_ID"]?>" >
			</td>
			<td><div align="center"><?php echo $row["FIRST_NAME"];?></div></td>
       	 	<td><div align="center"><?php echo $row["LAST_NAME"];?></div></td>
       		<td><div align="center"><?php echo $row["BIRTHDAY"];?></div></td>
            <td><div align="center"><?php echo $row["MEMBER_ID"];?></div></td>
        	<td><div align="center"><?php echo $row["ADDRESS"];?></div></td>
            <td><div align="center"><?php echo $row["EMAIL"];?></div></td>
        	<td><div align="center"><?php echo $row["PHONE"];?></div></td>
        	<td><div align="center"><?php echo $row["HISTORY"];?></div></td>
	  		</tr>
       <?php
		}
	}
	 	 
else if($gender == "Lastname"){
		$query1 = "SELECT * FROM LIBRARY_MEMBER WHERE LAST_NAME LIKE '%".$_GET["txtKeyword"]."%'";
		$parseRequest1 = oci_parse($conn, $query1);
		oci_execute($parseRequest1);
		while($row = oci_fetch_array($parseRequest1, OCI_RETURN_NULLS+OCI_ASSOC))
		{
			$_SESSION['FIRST_NAME'] = $row['FIRST_NAME'];
			$_SESSION['LAST_NAME'] = $row['LAST_NAME'];
			$_SESSION['BIRTHDAY'] = $row['BIRTHDAY'];
			$_SESSION['MEMBER_ID'] = $row['MEMBER_ID'];
			$_SESSION['ADDRESS'] = $row['ADDRESS'];
			$_SESSION['EMAIL'] = $row['EMAIL'];
			$_SESSION['PHONE'] = $row['PHONE'];
			$_SESSION['HISTORY'] = $row['HISTORY'];

		?>
		<tr>
		<td >
			<input name="checkbox1[]" type= "checkbox" class="w3-check" value="<?=$row["MEMBER_ID"]?>" >
			</td>
			<td><div align="center"><?php echo $row["FIRST_NAME"];?></div></td>
       	 	<td><div align="center"><?php echo $row["LAST_NAME"];?></div></td>
       		<td><div align="center"><?php echo $row["BIRTHDAY"];?></div></td>
            <td><div align="center"><?php echo $row["MEMBER_ID"];?></div></td>
        	<td><div align="center"><?php echo $row["ADDRESS"];?></div></td>
            <td><div align="center"><?php echo $row["EMAIL"];?></div></td>
        	<td><div align="center"><?php echo $row["PHONE"];?></div></td>
        	<td><div align="center"><?php echo $row["HISTORY"];?></div></td>
	  		</tr>
       <?php
		}
	}
	 	 
else{
		  $query1 = "SELECT * FROM LIBRARY_MEMBER WHERE MEMBER_ID LIKE '%".$_GET["txtKeyword"]."%'";
		$parseRequest1 = oci_parse($conn, $query1);
		oci_execute($parseRequest1);
		while($row = oci_fetch_array($parseRequest1, OCI_RETURN_NULLS+OCI_ASSOC))
		{
			$_SESSION['FIRST_NAME'] = $row['FIRST_NAME'];
			$_SESSION['LAST_NAME'] = $row['LAST_NAME'];
			$_SESSION['BIRTHDAY'] = $row['BIRTHDAY'];
			$_SESSION['MEMBER_ID'] = $row['MEMBER_ID'];
			$_SESSION['ADDRESS'] = $row['ADDRESS'];
			$_SESSION['EMAIL'] = $row['EMAIL'];
			$_SESSION['PHONE'] = $row['PHONE'];
			$_SESSION['HISTORY'] = $row['HISTORY'];

		?>
		<tr>
		<td >
			<input name="checkbox1[]" type= "checkbox" class="w3-check" value="<?=$row["MEMBER_ID"]?>" >
			</td>
			<td><div align="center"><?php echo $row["FIRST_NAME"];?></div></td>
       	 	<td><div align="center"><?php echo $row["LAST_NAME"];?></div></td>
       		<td><div align="center"><?php echo $row["BIRTHDAY"];?></div></td>
            <td><div align="center"><?php echo $row["MEMBER_ID"];?></div></td>
        	<td><div align="center"><?php echo $row["ADDRESS"];?></div></td>
            <td><div align="center"><?php echo $row["EMAIL"];?></div></td>
        	<td><div align="center"><?php echo $row["PHONE"];?></div></td>
        	<td><div align="center"><?php echo $row["HISTORY"];?></div></td>
	  		</tr>
       <?php
		}
	}
}
else
{
		 $query2 = "SELECT * FROM LIBRARY_MEMBER ";
		$parseRequest2 = oci_parse($conn, $query2);
		oci_execute($parseRequest2);
		while($row = oci_fetch_array($parseRequest2, OCI_RETURN_NULLS+OCI_ASSOC))
		{
			$_SESSION['FIRST_NAME'] = $row['FIRST_NAME'];
			$_SESSION['LAST_NAME'] = $row['LAST_NAME'];
			$_SESSION['BIRTHDAY'] = $row['BIRTHDAY'];
			$_SESSION['MEMBER_ID'] = $row['MEMBER_ID'];
			$_SESSION['ADDRESS'] = $row['ADDRESS'];
			$_SESSION['EMAIL'] = $row['EMAIL'];
			$_SESSION['PHONE'] = $row['PHONE'];
			$_SESSION['HISTORY'] = $row['HISTORY'];

		?>
		<tr>
		<td >
			<input name="checkbox1[]" type= "checkbox" class="w3-check" value="<?=$row["MEMBER_ID"]?>" >
			</td>
			<td><div align="center"><?php echo $row["FIRST_NAME"];?></div></td>
       	 	<td><div align="center"><?php echo $row["LAST_NAME"];?></div></td>
       		<td><div align="center"><?php echo $row["BIRTHDAY"];?></div></td>
            <td><div align="center"><?php echo $row["MEMBER_ID"];?></div></td>
        	<td><div align="center"><?php echo $row["ADDRESS"];?></div></td>
            <td><div align="center"><?php echo $row["EMAIL"];?></div></td>
        	<td><div align="center"><?php echo $row["PHONE"];?></div></td>
        	<td><div align="center"><?php echo $row["HISTORY"];?></div></td>
	  		</tr>
       <?php
		}
	}
	
	if(isset($_GET['submit']) && isset($_GET['checkbox1']))
			{
				foreach( $_GET['checkbox1'] as $delete )
				{
				$query3 ="DELETE FROM LIBRARY_MEMBER WHERE MEMBER_ID = '$delete'";
				$parseRequest3 = oci_parse($conn, $query3);
				oci_execute($parseRequest3);
				}
				die( '<script>window.location = "De-mem.php";</script>');
			}
		?>
	  <tr>
	<td >
 </table> 
<input type="submit" name="submit" value="Delete" class="w3-btn w3-cyan" style="margin:right">
</form>
</div>
	<?php
oci_close($conn);
?>	
</html>
