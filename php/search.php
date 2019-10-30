<?php include ( "inc/connect.inc.php" ); ?>
<?php 
ob_start();
session_start();
if (!isset($_SESSION['user_login'])) {
	$user = "";
}
else {
	$user = $_SESSION['user_login'];
	
$orders_list = "SELECT * FROM user WHERE id='$user'";
$result = mysqli_query($con,$orders_list);
		
$get_user_email = mysqli_fetch_assoc($result);
			
$uname_db = $get_user_email['firstName'];
}


$search_value = "";
$search_value = trim($_GET['keywords']);

?>

<!DOCTYPE html>
<html>
<head>
	<title>Welcome to Financial Planner</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<div class="homepageheader">
		<div class="signinButton loginButton">
			<div class="uiloginbutton signinButton loginButton" style="margin-right: 40px;">
				<?php 
					if ($user!="") {
						echo '<a style="text-decoration: none; color: #fff;" href="logout.php">LOG OUT</a>';
					}
					else {
						echo '<a style="text-decoration: none; color: #fff;" href="signup.php">SIGN UP</a>';
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
		<div id="srcheader">
				<form id="newsearch" method="get" action="search.php">
				        <?php 
				        	echo '<input type="text" class="srctextinput" name="keywords" size="21" maxlength="120"  placeholder="Search Here..." value="'.$search_value.'"><input type="submit" value="search" class="srcbutton" >';
				         ?>
				</form>
			<div class="srcclear"></div>
		</div>
	</div>
	<div class="categolis">
		<table>
			<tr>
				<th>
					<a href="category/Videos.php" style="text-decoration: none;color: #ddd;padding: 4px 12px;background-color: #0059b3;border-radius: 12px;">Videos</a>
				</th>
				<th><a href="category/Documents.php" style="text-decoration: none;color: #ddd;padding: 4px 12px;background-color: #0059b3;border-radius: 12px;">Documents</a></th>

			</tr>
		</table>
	</div>
	<div style="padding: 30px 120px; font-size: 25px; margin: 0 auto; display: table; width: 98%;">
		<div>
		<?php 
			if (isset($_GET['keywords']) && $_GET['keywords'] != ""){
				$search_value = trim($_GET['keywords']);
				$orders_list1="SELECT * FROM products WHERE pName like '%$search_value%'  ORDER BY id DESC";
				$getposts = mysqli_query($con,$orders_list1) or die(mysqli_error());
					if ( $total = mysqli_num_rows($getposts)) {
					echo '<ul id="recs">';
					echo '<div style="text-align: center;"> '.$total.' Products Found... </div><br>';
					while ($row = mysqli_fetch_assoc($getposts)) {
						$id = $row['id'];
						$pName = $row['pName'];
						$price = $row['price'];
						$description = $row['description'];
						$picture = $row['picture'];
						$item = $row['item'];
						
						echo '
							<ul style="float: left;">
								<li style="float: left; padding: 0px 25px 25px 25px;">
									<div class="home-prodlist-img"><a href="category/view_product.php?pid='.$id.'">
									
									'?>

<?php 
$profile_pic_name = $row['picture'];
$file_basename = substr($profile_pic_name, 0, strripos($profile_pic_name, '.'));
$file_ext = substr($profile_pic_name, strripos($profile_pic_name, '.'));	

?>


<?php if($file_ext == '.jpg' || $file_ext == '.png'){ ?>
<img src="image/product/<?php echo $item; ?>/<?php echo $picture; ?>" class="home-prodlist-imgi">
<?php } elseif($file_ext == '.pdf') { ?>
<img src="image/pdf-icon.png"   class="home-prodlist-imgi">
<?php } elseif($file_ext == '.doc') { ?>
<img src="image/doc-icon.png"   class="home-prodlist-imgi">
<?php } elseif($file_ext == '.mp4' || $file_ext == '.m4a') { ?>
<img src="image/video-icon.png"   class="home-prodlist-imgi">
<?php } else { } ?>

								
									<?php echo '
									
									
										<!--<img src="image/product/'.$item.'/'.$picture.'" class="home-prodlist-imgi">-->
										</a>
										<div style="text-align: center; padding: 0 0 6px 0;"> <span style="font-size: 15px;">'.$pName.'</span><br> Price: '.$price.' RM</div>
									</div>
									
								</li>
							</ul>
						';

						}
				}else {
				echo "Nothing Found!";
			}
			}else {
				echo "Input Someting...";
			}
			
		?>
			
		</div>
	</div>
</body>
</html>