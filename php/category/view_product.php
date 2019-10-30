<?php include ( "../inc/connect.inc.php" ); ?>

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

if (isset($_REQUEST['pid'])) {
	
	
$pid = mysqli_real_escape_string($con,$_REQUEST['pid']);
}
else {
	header('location: index.php');
}
$orders_list1 = "SELECT * FROM products WHERE id ='$pid'";
$getposts = mysqli_query($con,$orders_list1) or die(mysqli_error());
					
if (mysqli_num_rows($getposts)) {
						
$row = mysqli_fetch_assoc($getposts);
						
$id = $row['id'];
$pName = $row['pName'];
$price = $row['price'];
$description = $row['description'];
$picture = $row['picture'];
$item = $row['item'];
$available =$row['available'];
					
}	


?>


<!DOCTYPE html>
<html>

<head>
	
<title>Welcome to Financial Planner</title>
	
<link rel="stylesheet" type="text/css" href="../css/style.css">
	
<meta name="viewport" content="width=device-width, initial-scale=1">

</head>

<body>
	
<?php include ( "../inc/mainheader.inc.php" ); ?>
	
<div class="categolis">
		
<table>
			
<tr>
								
<th><a href="Videos.php" style="text-decoration: none;color: #ddd;padding: 4px 12px;background-color: #0059b3;border-radius: 12px;">Videos</a></th>
				
<th><a href="Documents.php" style="text-decoration: none;color: #ddd;padding: 4px 12px;background-color: #0059b3;border-radius: 12px;">Documents</a></th>
		
</tr>
		
</table>
	
</div>
	
<div style="margin: 0 97px; padding: 10px">

		
<?php 

$profile_pic_name = $row['picture'];
$file_basename = substr($profile_pic_name, 0, strripos($profile_pic_name, '.'));
$file_ext = substr($profile_pic_name, strripos($profile_pic_name, '.'));	
	
			
echo '
				
<div style="float: left;">
				
<div>

'
?>



<?php if($file_ext == '.jpg' || $file_ext == '.png'){ ?>
<img src="../image/product/<?php echo $item; ?>/<?php echo $picture; ?>" style="height: 500px; width: 500px; padding: 2px; border: 2px solid #c7587e;">
<?php } elseif($file_ext == '.pdf') { ?>
<a href="../image/product/<?php echo $item; ?>/<?php echo $picture; ?>" target="blank"><img src="../image/pdf-icon.png" width="200"></a>
<?php } elseif($file_ext == '.doc') { ?>
<a href="../image/product/<?php echo $item; ?>/<?php echo $picture; ?>"><img src="../image/doc-icon.png" width="200"></a>
<?php } elseif($file_ext == '.mp4' || $file_ext == '.m4a') { ?>
<video width="640" height="360" controls>
  <source src="../image/product/<?php echo $item; ?>/<?php echo $picture; ?>" type="video/mp4">
</video>
<?php } else { } ?>


<?php echo '
				</div>
				</div>
				<div style="float: right;width: 40%;color: #067165;background-color: #ddd;padding: 10px;">
					<div style="">
						<h3 style="font-size: 25px; font-weight: bold; ">'.$pName.'</h3><hr>
						<h3 style="padding: 20px 0 0 0; font-size: 20px;">Price:RM '.$price.' </h3><hr>
						<h3 style="padding: 20px 0 0 0; font-size: 22px; ">Description:</h3>
						<p>
							'.$description.'
						</p>

						<div>
							<h3 style="padding: 20px 0 5px 0; font-size: 20px;">Want to buy this product? </h3>
							<div id="srcheader">
								<form id="" method="post" action="../orderform.php?poid='.$pid.'">
								        <input type="submit" value="Order Now" class="srcbutton" >
								</form>
								<div class="srcclear"></div>
							</div>
						</div>

					</div>
				</div>

			';
		?>

	</div>
	<div style="padding: 30px 95px; font-size: 25px; margin: 0 auto; display: table; width: 98%;">
		
<h3 style="padding-bottom: 20px">Recommand Product For You:</h3>
		
<div>
		
<?php 
			
$orders_list2 = "SELECT * FROM products WHERE available >='1' AND id != '".$pid."' AND item ='".$item."'  ORDER BY RAND() LIMIT 3";
$getposts = mysqli_query($con,$orders_list2) or die(mysqli_error($con));
					
if (mysqli_num_rows($getposts)) {
					
echo '<ul id="recs">';
					
while ($row = mysqli_fetch_assoc($getposts)) {
						
$id = $row['id'];
						
$pName = $row['pName'];
						
$price = $row['price'];
						
$description = $row['description'];
						
$picture = $row['picture'];
						
						
echo '
							
<ul style="float: left;">
								
<li style="float: left; padding: 0px 25px 25px 25px;">
									
<div class="home-prodlist-img"><a href="view_product.php?pid='.$id.'"> '?>

<?php 
$profile_pic_name = $row['picture'];
$file_basename = substr($profile_pic_name, 0, strripos($profile_pic_name, '.'));
$file_ext = substr($profile_pic_name, strripos($profile_pic_name, '.'));	

?>


<?php if($file_ext == '.jpg' || $file_ext == '.png'){ ?>
<img src="../image/product/<?php echo $item; ?>/<?php echo $picture; ?>" class="home-prodlist-imgi">
<?php } elseif($file_ext == '.pdf') { ?>
<img src="../image/pdf-icon.png"   class="home-prodlist-imgi">
<?php } elseif($file_ext == '.doc') { ?>
<img src="../image/doc-icon.png"   class="home-prodlist-imgi">
<?php } elseif($file_ext == '.mp4' || $file_ext == '.m4a') { ?>
<img src="../image/video-icon.png"   class="home-prodlist-imgi">
<?php } else { } ?>

								
									<?php echo '	</a>
										<div style="text-align: center; padding: 0 0 6px 0;"> <span style="font-size: 15px;">'.$pName.'</span><br> Price:RM '.$price.' </div>
									</div>
									
								</li>
							</ul>
						';

						}
				}
		?>
			
		</div>
	</div>
</body>
</html>
