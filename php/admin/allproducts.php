<?php include ( "../inc/connect.inc.php" ); ?>
<?php 
ob_start();
session_start();
if (!isset($_SESSION['admin_login'])) {
	header("location: login.php");
	$user = "";
}
else {
	$user = $_SESSION['admin_login'];
	
$orders_list = "SELECT * FROM admin WHERE id='$user'";
$result = mysqli_query($con,$orders_list);
		
$get_user_email = mysqli_fetch_assoc($result);
			
$uname_db = $get_user_email['firstName'];
}

$search_value = "";

?>


<!doctype html>
<html>
	<head>
		<title>Welcome to Financial Planner</title>
		<link rel="stylesheet" type="text/css" href="../css/style.css">
	</head>
	<body class="home-welcome-text" style="background-image: url(../image/bg4.jpg);">
		<div class="homepageheader">
			<div class="signinButton loginButton">
				<div class="uiloginbutton signinButton loginButton" style="margin-right: 40px;">
					<?php 
						if ($user!="") {
							echo '<a style="text-decoration: none;color: #fff;" href="logout.php">LOG OUT</a>';
						}
					 ?>
					
				</div>
				<div class="uiloginbutton signinButton loginButton">
					<?php 
						if ($user!="") {
							echo '<a style="text-decoration: none;color: #fff;" href="login.php">Hi '.$uname_db.'</a>';
						}
						else {
							echo '<a style="text-decoration: none;color: #fff;" href="login.php">LOG IN</a>';
						}
					 ?>
				</div>
			</div>
			<div style="float: left; margin: 5px 0px 0px 23px;">
				<a href="index.php">
					<img style=" height: 75px; width: 130px;" src="../image/Home.png">
				</a>
			</div>
			
		</div>
		<div class="categolis">
			<table>
				<tr>
					<th>
						<a href="index.php" style="text-decoration: none;color: #fff;padding: 4px 12px;background-color: #0059b3;border-radius: 12px;">Home</a>
					</th>
					<th><a href="addproduct.php" style="text-decoration: none;color: #ddd;padding: 4px 12px;background-color: #0059b3;border-radius: 12px;">Add Product</a></th>
					<th><a href="newadmin.php" style="text-decoration: none;color: #ddd;padding: 4px 12px;background-color: #0059b3;border-radius: 12px;">New Admin</a></th>
					<th><a href="allproducts.php" style="text-decoration: none;color: #ddd;padding: 4px 12px;background-color: #003366;border-radius: 12px;">All Products</a></th>
					<th><a href="orders.php" style="text-decoration: none;color: #ddd;padding: 4px 12px;background-color: #0059b3;border-radius: 12px;">Orders</a></th>
				</tr>
			</table>
		</div>
		<div>
			<table class="rightsidemenu">
				<tr style="font-weight: bold;" colspan="10" bgcolor="#4DB849">
					<th>Id</th>
					<th>P Name</th>
					<th>Description</th>
					<th>Price</th>
					<th>Available</th>
					<th>Item</th>
					<th>P Code</th>
					<th>Edit</th>
				</tr>
				<tr>
					<?php include ( "../inc/connect.inc.php");
					$query = "SELECT * FROM products ORDER BY id DESC";
					$run = mysqli_query($con,$query);
					while ($row=mysqli_fetch_assoc($run)) {
						$id = $row['id'];
						$pName = substr($row['pName'], 0,50);
						$descri = $row['description'];
						$price = $row['price'];
						$available = $row['available'];
						$item = $row['item'];
						$pCode = $row['pCode'];
						$picture = $row['picture'];
					
					 ?>
					<th><?php echo $id; ?></th>
					<th><?php echo $pName; ?></th>
					<th><?php echo $descri; ?></th>
					<th><?php echo $price; ?></th>
					<th><?php echo $available; ?></th>
					<th><?php echo $item; ?></th>
					<th><?php echo $pCode; ?></th>
					<th><?php echo '<div class="home-prodlist-img"><a href="editproduct.php?epid='.$id.'">    ' ?>
									
					<?php $profile_pic_name = $row['picture'];
					$file_basename = substr($profile_pic_name, 0, strripos($profile_pic_name, '.'));
					$file_ext = substr($profile_pic_name, strripos($profile_pic_name, '.'));	
					?>
									
					<?php if($file_ext == '.jpg' || $file_ext == '.png'){ ?>
					<img src="../image/product/<?php echo $item; ?>/<?php echo $picture; ?>"  style="height: 75px; width: 75px;">
					<?php } elseif($file_ext == '.pdf') { ?>
					<img src="../image/pdf-icon.png"  style="height: 75px; width: 75px;">
					<?php } elseif($file_ext == '.doc') { ?>
					<img src="../image/doc-icon.png"  style="height: 75px; width: 75px;" >
					<?php } elseif($file_ext == '.mp4' || $file_ext == '.m4a') { ?>
					<img src="../image/video-icon.png"  style="height: 75px; width: 75px;" >
					<?php } else { } ?>


									<?php echo '<!--<img src="../image/product/'.$item.'/'.$picture.'" class="home-prodlist-imgi" style="height: 75px; width: 75px;">-->
									</a>
								</div>' ?></th>
				</tr>
				<?php } ?>
			</table>
		</div>
	</body>
</html>