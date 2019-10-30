<?php include ( "inc/connect.inc.php" ); ?>

<?php 
ob_start();
session_start();

if (!isset($_SESSION['user_login'])) 
{
	$user = "";
}

else 
{
	$user = $_SESSION['user_login'];
	
$orders_list = "SELECT * FROM user WHERE id='$user'";
$result = mysqli_query($con,$orders_list);
		
$get_user_email = mysqli_fetch_assoc($result);
			
$uname_db = $get_user_email['firstName'];
}
?>

<!DOCTYPE html>
<html>
	
<head>
		
<title>Welcome to Financial Planner</title>
		
<link rel="stylesheet" type="text/css" href="css/style.css">
		
<meta name="viewport" content="width=device-width, initial-scale=1">
		
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
		
<script src="/js/homeslideshow.js"></script>
	
</head>
	<body style="min-width: 980px;">
		
<div class="homepageheader" style="position: relative;">
			
<div class="signinButton loginButton">
				
<div class="uiloginbutton signinButton loginButton" style="margin-right: 40px;">
					
<?php 
						
if ($user!="") {
							
echo '<a style="text-decoration: none; 
color: #fff;" href="logout.php">LOG OUT</a>';
						}
						
else {
							
echo '<a style="color: #fff; text-decoration: none;" href="signup.php">SIGN UP</a>';
						
}
					 ?>
					
				
</div>
				
<div class="uiloginbutton signinButton loginButton" style="">
					
<?php 
						
if ($user!="") {
							
echo '<a style="text-decoration: none; color: #fff;" href="profile.php?uid='.$user.'">Hi '.$uname_db.'</a>';
						
}
						
else {
							
echo '<a style="text-decoration: none; color: #fff;" href="login.php">LOG IN</a>';
						
}
					 
?>
				
</div>
<div class="uiloginbutton signinButton loginButton" style="margin-right: 10px;">
					
<?php 		
	echo '<a style="text-decoration: none; color: #fff;" href="contactus.php">Contact Us</a>';		
?>
					
</div>
			
</div>
			
<div style="float: left; margin: 5px 0px 0px 23px;">
				
<a href="index.php">
					
<img style=" height: 75px; width: 130px;" src="image/Home.png">
				
</a>
			
</div>
			
<div class="">
				
<div id="srcheader">
					
<form id="newsearch" method="get" action="search.php">
					        
<input type="text" class="srctextinput" name="keywords" size="21" maxlength="120"  placeholder="Search Here...">
<input type="submit" value="search" class="srcbutton" >
					
</form>
				
<div class="srcclear"></div>
				
</div>
			
</div>
		
</div>
		
<div class="home-welcome">
			
<div class="home-welcome-text" style="background-image: url(image/bg1.jpg); height: 380px; ">
				
<h1 style="margin: 0px;color:#7575a3;">Welcome To Financial Planner</h1>
				
<h2 style="color:#7575a3;">Most Reliable Financial Advisor</h2>
			
</div>
		
</div>
		
<div class="home-prodlist">
			
			
<div style="padding: 20px 30px; width: 85%; margin: 0 auto;">
				
<ul style="float: left;">
					
<li style="float: left; padding: 25px;">
						
<div class="home-prodlist-img"><a href="category/Videos.php">
							
<img src="./image/Video.png" class="home-prodlist-imgi">
							
</a>
						
</div>
					
</li>
				
</ul>
				
<ul style="float: left;">
					
<li style="float: left; padding: 25px;">
						
<div class="home-prodlist-img"><a href="category/Documents.php">
							
<img src="./image/Document.png" class="home-prodlist-imgi">
							
</a>
						
</div>
					
</li>
				
</ul>
				
	
</body>
</html>