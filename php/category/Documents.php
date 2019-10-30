<?php include ( "../inc/connect.inc.php" ); ?>

<?php 
ob_start();
session_start();

if (!isset($_SESSION['user_login'])) 
{
	$user = "";
}

else {
	$user = $_SESSION['user_login'];

$orders_list = 	"SELECT * FROM user WHERE id='$user'";
$result = mysqli_query($con,$orders_list);
		
$get_user_email = mysqli_fetch_assoc($result);
			
$uname_db = $get_user_email['firstName'];
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
			
<th><a href="Documents.php" style="text-decoration: none;color: #ddd;padding: 4px 12px;background-color: #003366;border-radius: 12px;">Documents</a></th>
			
</tr>
		
</table>
	
</div>
	
<div style="padding: 30px 120px; font-size: 25px; margin: 0 auto; display: table; width: 98%;">
		
<div>
		
<?php 
	
$orders_list1 = "SELECT * FROM products WHERE available >='1' AND item ='documents'  ORDER BY id DESC LIMIT 10";
	
$getposts = mysqli_query($con,$orders_list1)
 or die(mysqli_error($con));
					
if (mysqli_num_rows($getposts)) {
					
echo '<ul id="recs">';
					
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
									
<div class="home-prodlist-img"><a href="view_product.php?pid='.$id.'">


' ?>


<?php 
$profile_pic_name = $picture;
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
	
<?php echo '									

                                        
										<!--<img src="../image/product/documents/'.$picture.'" class="home-prodlist-imgi">-->
										</a>
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