<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script>
	$(document).ready(function(){
		$("#hide").click(function(){
			$("#b").hide();
		});
		$("#show").click(function(){
			$("#b").show();
		});
	});
	</script>
<style>
header {
    background-color:#000033;
    color:white;
    text-align:left;
    padding:10px;	
	height:150px;
	
	
}
h1{
	font-size:100%;
	margin-top:70px;
}
#nav {
    line-height:30px;
    background-color:#eeeeee;
    height:350px;
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

#box {
    background-image:url("C:/xampp/htdocs/Project/pic/p0.jpg");
    -webkit-animation-name: example; /* Chrome, Safari, Opera */
    -webkit-animation-duration: 20s; /* Chrome, Safari, Opera */
    animation-name: example;
    animation-duration: 10s;
    animation-iteration-count: infinite;
}

/* Chrome, Safari, Opera */
@-webkit-keyframes example {
    0%   {background-image:url("C:/xampp/htdocs/Project/pic/p0.jpg");}
    25%  {background-image:url("C:/xampp/htdocs/Project/pic/p1.jpg");}
    50%  {background-image:url("C:/xampp/htdocs/Project/pic/p3.jpg");}
    100% {background-image:url("C:/xampp/htdocs/Project/pic/p2.jpg");}
}

/* Standard syntax */
@keyframes example {
     0%   {background-image:url("C:/xampp/htdocs/Project/pic/p0.jpg");}
    25%  {background-image:url("C:/xampp/htdocs/Project/pic/p1.jpg");}
    50%  {background-image:url("C:/xampp/htdocs/Project/pic/p3.jpg");}
    100% {background-image:url("C:/xampp/htdocs/Project/pic/p2.jpg");}
}
#block{
	width:380px;
	height:150px;
	border: 5px solid w3-red;
	margin-top:-100px;
	margin-left:680px;
	position:relative;
}
</style>
</head>

	<body class="w3-content w3-card-16 " face="courier" style="max-width:1100px;height:100%;background-color:<!-- #1f346b; -->"> 

		<header class="w3-topnav w3-xxxlarge w3-Blue">
		<div class="w3-half w3-container">
		  <h1 face="courier">LIBRARY PUBLIC</h1>
		</div>
		</header>
		<div id="block" class="w3-container w3-red w3-card-16">
			<form action="action_page.php" >
			<br>
			<br>
				<input type="text" name="name_user" value="" style="width:300px;color:black;margin-left:40px;">
				<input type="submit" value='logout' class="w3-btn w3-teal w3-card-8" style="margin-left:120px;margin-top:30px;">
				<input type="submit" value="changepassword" class="w3-btn w3-teal w3-card-8" style="margin-top:30px;">
			</form> 
		</div>
		<div style="margin-top:-100px;">
		<img src="C:\xampp\htdocs\Project\pic\bg.jpg" alt="li" style="height:300px;width:100%;">
		</div >
		<div class="w3-topnav w3-large w3-padding-16 w3-card-12 w3-teal" style="pending:10px;">
		  <a type="submit" value='Home' style="color:white;" href="#">Home</a>
		  <a type="submit" value='Renews' style="color:white;" href="#Renews">Renews</a>
		  <a type="submit" value='Reservations' style="color:white;" href="#Reservations">Reservations</a>
		  <a type="submit" value='Research' style="color:white;" href="#Research">Research</a>
		</div>
		<div style="margin-top:-47px;">
			<form action="action_page.php" >				
				<input type="date" name="date" value="calender" style="width:200px;color:black;margin-left:850px;">
			</form>
		</div>
		<br>
		<!-- <div class="w3-content w3-padding-64 w3-orange" style="max-width:700px;">
			<h4>w3-padding-jumbo</h4>
			<p>
			London is the capital city of England. It is the most populous city in the United Kingdom, with a metropolitan area of over 13 million inhabitants.
			</p>
		</div> -->
		
		<div id="box" class="w3-container w3-content " style="width:600px;height:300px;margin-top:50px;"></div>
		
		<br>
		<br>
		<br>
		<button id="hide">Hide</button>
		<button id="show">Show</button>
		<div  class="w3-row w3-border">
			<div id="b" class="w3-container w3-half w3-deep-orange"  >
			  <h2><b>Most Recent Book</b></h2> 
			  <br>
			  <div class="w3-row w3-border" style="text-align:center;">
					<div class="w3-third w3-container " style="background-color:#448ebb;">
					  <p></p>
					  <img src="C:\xampp\htdocs\Project\pic\b2.jpg" alt="b2" style="width:100%;">  
					  <p></p>
					  <p>ลองจันทร์</p>
					  <p>by ซ้อนกลิ่น</p>
					</div>
					<div class="w3-third w3-container " style="background-color:#8fbbd6;">
					  <p></p>
					  <img src="C:\xampp\htdocs\Project\pic\b2.jpg" alt="b2" style="width:100%;">
					  <p></p>
					  <p>ลองจันทร์</p>
					  <p>by ซ้อนกลิ่น</p>
					</div>
					<div class="w3-third w3-container w3-theme-l5 " style="background-color:#69a4c9;">
					  <p></p>
					  <img src="C:\xampp\htdocs\Project\pic\b3.jpg" alt="b2" style="width:100%;">
					  <p></p>
					  <p>ลองจันทร์</p>
					  <p>by ซ้อนกลิ่น</p>
					</div>
				</div>
				<br>
				<br>
				<br>
			</div>
			
			<div class="w3-container w3-half w3-deep-orange"  style="background-color:#90d9df;">
			  <h2><b>Most Recent Book</b></h2> 
			  <br>
			  <div class="w3-row w3-border" style="text-align:center;">
					<div class="w3-third w3-container " style="background-color:#448ebb;bolder:3px solid #90d9df;">
					  <p></p>
					  <img src="C:\xampp\htdocs\Project\pic\b2.jpg" alt="b2" style="width:100%;">  
					  <p></p>
					  <p>ลองจันทร์</p>
					  <p>by ซ้อนกลิ่น</p>
					</div>
					<div class="w3-third w3-container " style="background-color:#8fbbd6;">
					  <p></p>
					  <img src="C:\xampp\htdocs\Project\pic\b2.jpg" alt="b2" style="width:100%;">
					  <p></p>
					  <p>ลองจันทร์</p>
					  <p>by ซ้อนกลิ่น</p>
					</div>
					<div class="w3-third w3-container w3-theme-l5 " style="background-color:#69a4c9;">
					  <p></p>
					  <img src="C:\xampp\htdocs\Project\pic\b3.jpg" alt="b2" style="width:100%;">
					  <p></p>
					  <p>ลองจันทร์</p>
					  <p>by ซ้อนกลิ่น</p>
					</div>
				</div>
				<br>
				<br>
				<br>
			</div>
		</div>
		<div class="w3-row w3-border">
				<div class="w3-container w3-content w3-half" style="background-color:#6bb233;color:white;">
				  <h2><b>News</b></h2>  
				  <h4><p><li>ร่วมบริจาคโลหิต</li></p>
				  <p> - ในวันที่ 20 กุมภาพันธ์  2558 </p>
				  <p> - เวลา 09.00 - 15.30</p>
				  <p> - ณ ภาควิชาวิทยาการคอมพิวเตอร์ </p>
				  <p><li>เชิญร่วมสวดมนต์ข้ามปี</li></p>
				  <p>- วันที่ 31 ธันวาคม 2558</p>
				  <p> - เวลา 23.00 เป็นต้นไป</p>
				  <p>- ณ วัดสวนดอก</p>
				  <br>
				  <br>
				 
				  </h4>
				</div>
			
				<div class="w3-container w3-content w3-half w3-amber" >
				  <h2><b>News</b></h2>  
				  <h4><p><li>ร่วมบริจาคโลหิต</li></p>
				  <p> - ในวันที่ 20 กุมภาพันธ์  2558 </p>
				  <p> - เวลา 09.00 - 15.30</p>
				  <p> - ณ ภาควิชาวิทยาการคอมพิวเตอร์ </p>
				  <p><li>เชิญร่วมสวดมนต์ข้ามปี</li></p>
				  <p>- วันที่ 31 ธันวาคม 2558</p>
				  <p> - เวลา 23.00 เป็นต้นไป</p>
				  <p>- ณ วัดสวนดอก</p>
				  <br>
				  <br>
				  
				  </h4>
				</div>
			</div>
		<footer >
		 	<div class="w3-third w3-container " style="background-color:#0D4F8B;color:white;"> 
			  <h3>connection</h3>  
			  <p>Tel : 01-000111</p>
			  <p>facbook : Library Public</p>
			</div>
			<div class="w3-third w3-container w3-white">
			  <h3>เวลาทำการ</h3>
			  <p>จันทร์-ศุกร์  : 08.00-20.00</p>
			  <p>เสาร์-อาทิตย์ : 09.00-21.00</p>
			 </div>
			<div class="w3-third w3-container w3-blue-grey" style="background-color:#337fb2">
			  <h3>วันหยุด</h3>
			  <p>วันสงกรานต์ 15-17  เมษายน</p>
			  <p>ปีใหม่ 31 ธันวาคม - 1 มกราคม</p>
			</div>
		</footer>
		
	</body>

</html>
