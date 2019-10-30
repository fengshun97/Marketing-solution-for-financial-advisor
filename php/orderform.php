<?php include ( "inc/connect.inc.php" ); ?>
<?php 

if (isset($_REQUEST['poid'])) {
	
	$poid = mysqli_real_escape_string($con,$_REQUEST['poid']);
}else {
	header('location: index.php');
}
ob_start();
session_start();
if (!isset($_SESSION['user_login'])) {
	$user = "";
	header("location: login.php?ono=".$poid."");
}
else {
	$user = $_SESSION['user_login'];
	$orders_list = "SELECT * FROM user WHERE id='$user'";
	$result = mysqli_query($con,$orders_list);
		$get_user_email = mysqli_fetch_assoc($result);
			$uname_db = $get_user_email['firstName'];
			$uemail_db = $get_user_email['email'];

			$umob_db = $get_user_email['mobile'];
			$uadd_db = $get_user_email['address'];
}

$orders_list1 = "SELECT * FROM products WHERE id ='$poid'";
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

//order

if (isset($_POST['order'])) {
//declere veriable
$mbl = $_POST['mobile'];
$addr = $_POST['address'];
$quan = $_POST['quantity'];
//triming name
	try {
		if(empty($_POST['mobile'])) {
			throw new Exception('Mobile can not be empty');
			
		}
		if(empty($_POST['address'])) {
			throw new Exception('Address can not be empty');
			
		}
		if(empty($_POST['quantity'])) {
			throw new Exception('Address can not be empty');
			
		}

		
		// Check if email already exists
		
		
						$d = date("Y-m-d"); //Year - Month - Day
						$timestamp = time();
						$date = strtotime("+7 day", $timestamp);
						$date = date('Y-m-d', $date);
						
					
					
				
					$query = "SELECT * FROM orders ORDER BY id DESC";
					$run = mysqli_query($con,$query);
					while ($row=mysqli_fetch_assoc($run)) {
						$oid = $row['id'];
						$ouid = $row['uid'];
						$opid = $row['pid'];
						$oquantity = $row['quantity'];
						$oplace = $row['oplace'];
						$omobile = $row['mobile'];
						$odstatus = $row['dstatus'];
						$odate = $row['odate'];
						$ddate = $row['ddate'];
						//getting user info
						$query1 = "SELECT * FROM user WHERE id='$ouid'";
						$run1 = mysqli_query($con,$query1);
						$row1=mysqli_fetch_assoc($run1);
						$ofname = $row1['firstName'];
						$oumobile = $row1['mobile'];
						$ouemail = $row1['email'];

						//product info
						$query2 = "SELECT * FROM products WHERE id='$opid'";
						$run2 = mysqli_query($con,$query2);
						$row2=mysqli_fetch_assoc($run2);
					
						$opitem = $row2['item'];
						$oppicture = $row2['picture'];
						$oprice = $row2['price'];

				} 
				
				$headers  = 'MIME-Version: 1.0' . "\r\n";
                $headers = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
              

					
						$orders_list2 = "INSERT INTO orders (uid,pid,quantity,oplace,mobile,odate,ddate) VALUES ('$user','$poid',$quan,'$_POST[address]','$_POST[mobile]','$d','$date')";
						if(mysqli_query($con,$orders_list2)){



						//success message
						$success_message = '
						<div class="signupform_content"><h2><font face="bookman">Your order successfull!</font></h2>
						<div class="signupform_text" style="font-size: 18px; text-align: center;">
						<font face="bookman">
							We will send you an email <br> very soon.
						</font></div></div>';
						}else{
							$error_message = 'Something goes wrong!';
						}

	}
	catch(Exception $e) {
		$error_message = $e->getMessage();
	}
}


?>

<!DOCTYPE html>
<html>
<head>
	<title>Welcome to Financial Planner</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body style="background-image: url(image/bg4.jpg);">
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
			<div class="">
				<div id="srcheader">
					<form id="newsearch" method="get" action="search.php">
					        <input type="text" class="srctextinput" name="keywords" size="21" maxlength="120"  placeholder="Search Here..."><input type="submit" value="search" class="srcbutton" >
					</form>
				<div class="srcclear"></div>
				</div>
			</div>
		</div>
	<div class="categolis">
		<table>
			<tr>
				<th>
					<a href="category/videos.php" style="text-decoration: none;color: #ddd;padding: 4px 12px;background-color: #0059b3;border-radius: 12px;">Videos</a>
				</th>
				<th><a href="category/documents.php" style="text-decoration: none;color: #ddd;padding: 4px 12px;background-color: #0059b3;border-radius: 12px;">Documents</a></th>
				
			</tr>
		</table>
	</div>
	<div class="holecontainer" style=" padding-top: 20px; padding: 0 20%">
		<div class="container signupform_content ">
			<div>

				<h2 style="padding-bottom: 20px;">Order Form</h2>
				<div style="float: right;">
				<?php 
					if(isset($success_message)) {echo $success_message;}
					else {
					echo '
						<div class="">
						<div class="signupform_text"></div>
						<div>
							<form action="" method="POST" class="registration">
								<div class="signup_form" style="    margin-top: 38px;">
									<div>
										<td>
											<input name="mobile" placeholder="Your mobile number" required="required" class="email signupbox" type="text" size="30" value="'.$umob_db.'">
										</td>
									</div>
									<div>
										<td>
											<input name="address" id="password-1" required="required"  placeholder="Write your full address" class="password signupbox " type="text" size="30" value="'.$uadd_db.'">
										</td>
									</div>
									<div>
										<td>
											<select onchange="changeAmount()" name="quantity" required="required" id="productAmount" style=" font-size: 20px;
										font-style: italic; margin-bottom: 3px;margin-top: 0px;padding: 14px;line-height: 25px;border-radius: 4px;border: 1px solid #169E8F;color: #169E8F;margin-left: 0;width: 300px;background-color: transparent;" class="">';

					

				 ?><?php
												for ($i=1; $i<=$available; $i++) { 
													echo '<option  value="'.$i.'">Quantity: '.$i.'</option>';
												}
											?>
											<?php echo '
											</select>
										</td>
									</div>
									<div>
										<input name="order" class="uisignupbutton signupbutton" type="submit" value="Confirm Order">
									</div>
									<div class="signup_error_msg"> '; ?>
										<?php 
											if (isset($error_message)) {echo $error_message;}
											
										?>
									<?php echo '</div>
								</div>
							</form>
							
						</div>
					</div>

					';

					}

				 ?>
					
				</div>
			</div>
		</div>
		<div style="float: left; font-size: 23px;">
			<div>
				<?php
					echo '
						<ul style="float: left;">
							<li style="float: left; padding: 0px 25px 25px 25px;">
								<div class="home-prodlist-img"><a href="category/view_product.php?pid='.$id.'">
								' ?>
								
			<?php 
$profile_pic_name = $picture;
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
								
								<!--	<img src="image/product/'.$item.'/'.$picture.'" class="home-prodlist-imgi">-->
									</a>
									<div style="text-align: center; padding: 0 0 6px 0;"> <span style="font-size: 15px;">'.$pName.'</span><br> Price: RM <span id="amountText">'.$price.'</span></div>
								</div>
								
							</li>
						</ul>
					';
				?>
			</div>

		</div>
	</div>
	<script type="text/javascript">
	function changeAmount() {
	    var v = document.getElementById("aHiddenText").innerHTML;
	    document.getElementById("amountText").innerHTML = v;
	    var sBox = document.getElementById("productAmount");
    	var y = sBox.value;
	    var x = document.getElementById("amountText").innerHTML;
	    var y = parseInt(y);
	    var x = parseInt(x);
	    document.getElementById("amountText").innerHTML = x+"x"+y+ " = " + x*y;
	}
	</script>
</body>
</html>