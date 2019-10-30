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

$pname = "";

$price = "";

$available = "";

$item = "";

$pCode = "";

$descri = "";


if (isset($_POST['signup'])) 
{
//declare variable
$pname = $_POST['pname'];
$item = $_POST['item'];
$price = $_POST['price'];
$available = $_POST['available'];
$pCode = $_POST['code'];
$descri = $_POST['descri'];

//triming name
$_POST['pname'] = trim($_POST['pname']);

//finding file extention
$profile_pic_name = @$_FILES['profilepic']['name'];
$file_basename = substr($profile_pic_name, 0, strripos($profile_pic_name, '.'));
$file_ext = substr($profile_pic_name, strripos($profile_pic_name, '.'));

$statusMsg = '';

//file upload path

$item = $item;
$targetDir = "../image/product/$item/";
$fileName = strtotime(date('Y-m-d H:i:s')).$file_ext;
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

if($_FILES["profilepic"]["name"]) {
    //allow certain file formats
    $allowTypes = array('jpg','png','jpeg','gif','pdf','mp4','m4a', 'doc');
    if(in_array($fileType, $allowTypes)){
        
          if (file_exists("../image/product/$item/".$file_basename.$file_ext)) {
    		$statusMsg = $file_basename.$file_ext." Already exists";
	      }else {
      
        
        
        //upload file to server
        if(move_uploaded_file($_FILES["profilepic"]["tmp_name"], $targetFilePath)){
            $statusMsg = "The file ".$fileName. " has been uploaded.";
            
            $photos = $fileName;
            $orders_list1 = "INSERT INTO products(pName,price,description,available,item,pCode,picture) VALUES ('$_POST[pname]','$_POST[price]','$_POST[descri]','$_POST[available]','$_POST[item]','$_POST[code]','$photos')";			
			$result = mysqli_query($con,$orders_list1);
			header("Location: allproducts.php");   
        }
		else{
            $statusMsg = "Sorry, there was an error uploading your file.";
        }
        
	    }
        
        
    }else{
        $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, DOC, MP4, M4A & PDF files are allowed to upload.';
    }
    
    
}else{
    $statusMsg = 'Please select a file to upload.';
}
}
$search_value = "";

?>


<?php

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
					<a href="index.php" style="text-decoration: none;color: #fff;padding: 4px 12px;background-color: #0059b3;border-radius: 12px;">Home</a></th>
					<th><a href="addproduct.php" style="text-decoration: none;color: #ddd;padding: 4px 12px;background-color: #003366;border-radius: 12px;">Add Product</a></th>
					<th><a href="newadmin.php" style="text-decoration: none;color: #ddd;padding: 4px 12px;background-color: #0059b3;border-radius: 12px;">New Admin</a></th>
					<th><a href="allproducts.php" style="text-decoration: none;color: #ddd;padding: 4px 12px;background-color: #0059b3;border-radius: 12px;">All Products</a></th>
					<th><a href="orders.php" style="text-decoration: none;color: #ddd;padding: 4px 12px;background-color: #0059b3;border-radius: 12px;">Orders</a></th>
				</tr>
			</table>
		</div>
		<?php 
			if(isset($success_message)) {echo $success_message;}
			else {
				echo '
					<div class="holecontainer" style="float: right; margin-right: 36%; padding-top: 20px;">
						<div class="container">
							<div>
								<div>
									<div class="signupform_content">
										<h2>Add Product Form!</h2>
										<div class="signup_error_msg">';
											if (isset($error_message)) {echo $error_message;}
											//echo $statusMsg;
										echo '</div>
										<div class="signupform_text"></div>
										<div>
											<form action="" method="POST" class="registration" enctype="multipart/form-data">
												<div class="signup_form">
													<div>
														<td >
															<input name="pname" id="first_name" placeholder="Product Name" required="required" class="first_name signupbox" type="text" size="30" value="'.$pname.'" >
														</td>
													</div>
													<div>
														<td >
															<input name="price" id="last_name" placeholder="Price" required="required" class="last_name signupbox" type="text" size="30" value="'.$price.'" >
														</td>
													</div>
													<div>
														<td>
															<input name="available" placeholder="Available Quantity" required="required" class="email signupbox" type="text" size="30" value="'.$available.'">
														</td>
													</div>
													<div>
														<td >
															<input name="descri" id="first_name" placeholder="Description" required="required" class="first_name signupbox" type="text" size="30" value="'.$descri.'" >
														</td>
													</div>
													<div>
														<td>
															<select name="item" required="required" style=" font-size: 20px;
														font-style: italic;margin-bottom: 3px;margin-top: 0px;padding: 14px;line-height: 25px;border-radius: 4px;border: 1px solid #169E8F;color: #169E8F;margin-left: 0;width: 300px;background-color: transparent;" class="">
																<option selected value="videos">Videos</option>
																<option value="documents">Documents</option>
															</select>
														</td>
													</div>
													<div>
														<td>
															<input name="code" id="password-1" required="required"  placeholder="Product Code" class="password signupbox " type="text" size="30" value="'.$pCode.'">
														</td>
													</div>
													<div>
														<td>
															<input name="profilepic" class="password signupbox" type="file" value="Add Pic">
														</td>
													</div>
													<div>
														<input name="signup" class="uisignupbutton signupbutton" type="submit" value="Add Product">
													</div>
												</div>
											</form>
											
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				';
			}
			


		 ?>
		
	</body>
</html>