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
     <form action="Add-book.php" method="post">
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
			<input type="button"  name="date"  id="date" class="w3-btn w3-cyan" value="<?=date('d-M-Y')?>" style="width:300px">
			<input type="submit" name="logout" value='logout' class="w3-btn w3-cyan">
            <input type="submit" name="changepassword" value="changepassword"  class="w3-btn w3-cyan">
		</form> 
	</div>
	</br>
	<br>
	
		
		<div id="Add book" class="w3-container" style="text-align: center;">
				<form action="Add-book.php" method="post" class="w3-form w3-card-4" style="margin-top:10px">
					<h2 class="w3-container w3-cyan">Add book</h2>
					<p>
                    <?php
			$FORM['BOOK_NAME'] = "";
			if (isset($_POST['BOOKNAME'])) $FORM['BOOK_NAME'] = htmlspecialchars($_POST['BOOK_NAME']);
			?>
						<h3 style="margin-left:-190px;">book name</h3>
				  			<input type="text" name="BOOK_NAME" value="<?php echo $FORM["BOOK_NAME"];?>" style="width:300px">
                      <?php
			$FORM['BOOK_ID'] = "";
			if (isset($_POST['BOOk_ID'])) $FORM['BOOK_ID'] = htmlspecialchars($_POST['BOOK_ID']);
			?>
						<h3 style="margin-left:-230px;">Book ID</h3>
							<input type="text" name="BOOK_ID" value="<?php echo $FORM["BOOK_ID"];?>" style="width:300px">
                       <?php
			$FORM['AUTHOR'] = "";
			if (isset($_POST['AUTHOR'])) $FORM['AUTHOR'] = htmlspecialchars($_POST['AUTHOR']);
			?>
                        <h3 style="margin-left:-230px;">Author</h3>
				  			<input type="text" name="AUTHOR" value="<?php echo $FORM["AUTHOR"];?>" style="width:300px">
                      <?php
			$FORM['PRICE_BOOK'] = "";
			if (isset($_POST['PRICE_BOOK'])) $FORM['PRICE_BOOK'] = htmlspecialchars($_POST['PRICE_BOOK']);
			?>
						<h3 style="margin-left:-195px;">pirce book</h3>
				  			<input type="text" name="PRICE_BOOK" value="<?php echo $FORM["PRICE_BOOK"];?>" style="width:300px">
                     <?php
			$FORM['TYPE'] = "";
			if (isset($_POST['TYPE'])) $FORM['TYPE'] = htmlspecialchars($_POST['TYPE']);
			?>                        
            			<h3 style="margin-left:-250px;"> type </h3>
							<input type="text" name="TYPE" value="<?php echo $FORM["TYPE"];?>" style="width:300px">
					<?php
			$FORM['PUBLISHER'] = "";
			if (isset($_POST['PUBLISHER'])) $FORM['PUBLISHER'] = htmlspecialchars($_POST['PUBLISHER']);
			?>
            			<h3 style="margin-left:-206px;">Publisher</h3>
							<input type="text" name="PUBLISHER" value="<?php echo $FORM["PUBLISHER"];?>" style="width:300px">
						                     <?php
			$FORM['YEAR_OF_PUBLICATION'] = "";
			if (isset($_POST['YEAR_OF_PUBLICATION'])) $FORM['YEAR_OF_PUBLICATION'] = htmlspecialchars($_POST['YEAR_OF_PUBLICATION']);
			?>
            			<h3 style="margin-left:-250px;">Year</h3>
							<input type="text" name="YEAR_OF_PUBLICATION" value="<?php echo $FORM["YEAR_OF_PUBLICATION"];?>" style="width:300px">
			                     <?php
			$FORM['NUMBER_OF_BOOK'] = "";
			if (isset($_POST['NUMBER_OF_BOOK'])) $FORM['NUMBER_OF_BOOK'] = htmlspecialchars($_POST['NUMBER_OF_BOOK']);
			?>	
            			<h3 style="margin-left:-220px;">Number</h3>
							<input type="text" name="NUMBER_OF_BOOK" value="<?php echo $FORM["NUMBER_OF_BOOK"];?>" style="width:300px">
						                     <?php
			$FORM['STATUS'] = "";
			if (isset($_POST['STATUS'])) $FORM['STATUS'] = htmlspecialchars($_POST['STATUS']);
			?>
            			<h3 style="margin-left:-240px;">Status</h3>
							<input type="text" name="STATUS" value="<?php echo $FORM["STATUS"];?>" style="width:300px">
						                     <?php
			$FORM['ISBN'] = "";
			if (isset($_POST['ISBN'])) $FORM['ISBN'] = htmlspecialchars($_POST['ISBN']);
			?>			
            			<h3 style="margin-left:-250px;">ISBN</h3>
							<input type="text" name="ISBN" value="<?php echo $FORM["ISBN"];?>" style="width:300px">
						</p>
							  
						<input type="submit" name="Add" value="Add" class="w3-btn w3-cyan">
 <?php	
if(isset($_POST["Add"])){
		
	if(isset($_POST["BOOK_ID"]) and !empty($_POST['BOOK_ID']))	
	{
		if(isset($_POST["ISBN"]) and !empty($_POST['ISBN']))	
		{
				if(isset($_POST["BOOK_NAME"]) and !empty($_POST['BOOK_NAME']))	
				{	$query1 = "INSERT INTO LIBRARY_BOOK (BOOK_NAME,BOOk_ID,AUTHOR,PRICE_BOOK,TYPE,PUBLISHER,YEAR_OF_PUBLICATION,NUMBER_OF_BOOK,STATUS,ISBN)
VALUES('".$_POST["BOOK_NAME"]."','".$_POST["BOOK_ID"]."','".$_POST["AUTHOR"]."','".$_POST["PRICE_BOOK"]."','".$_POST["TYPE"]."','".$_POST["PUBLISHER"]."','".$_POST["YEAR_OF_PUBLICATION"]."','".$_POST["NUMBER_OF_BOOK"]."','".$_POST["STATUS"]."','".$_POST["ISBN"]."')";
					$parseRequest1 = oci_parse($conn, $query1);
					oci_execute($parseRequest1);
					die( '<script>window.location = "Add-book.php";</script>');
				}
			else{ echo"คุณต้องใส่ชื่อหนังสือก่อน";}	
		}
		else{ echo"คุณต้องใส่ISBNก่อน";}			
	}
	else{ echo"คุณต้องใส่IDก่อน";}		
}
?>
					
	</form> 
	</div>
	<?php
oci_close($conn);
?>	
</body>
</html>
