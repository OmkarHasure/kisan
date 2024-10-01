<?php

	require_once('lib/functions.php');

	$db = new db_functions();

	if(!isset($_SESSION['mobile_no']))
	{
		header("Location:login.php?login");
	}

	$mobile_no_session=$_SESSION['mobile_no'];

	$flag=0;
	
	if(isset($_POST['button']))
	{

			$target_path = "assets\images\crop_images/";  
			
			//Get file name and concat to target folder
			$target_path = $target_path.basename( $_FILES['crop_img']['name']);   
				$file_name=	basename( $_FILES['crop_img']['name']); 
			if(move_uploaded_file($_FILES['crop_img']['tmp_name'], $target_path)) {  

				echo "File uploaded successfully!";  
			} else{  
				echo "Sorry, file not uploaded, please try again!";  
			}  

			$image= $target_path.basename( $_FILES['crop_img']['name']); 


		$crop_name	=	$_POST['crop_name'];
		$crop_variety=$_POST['crop_variety'];
        $crop_quantity=$_POST['crop_quantity'];
        $crop_price=$_POST['crop_price'];
        $ph_no1=$_POST['ph_no1'];
        $ph_no2=$_POST['ph_no2'];
		$reg_no=$mobile_no_session;
		$var_original_captcha	=	$_POST['original_captcha'];
		$var_user_captcha	=	$_POST['user_captcha'];


		if($var_original_captcha==$var_user_captcha)
		{
			if($db->save_crop($crop_name,$crop_variety,$crop_quantity,$file_name,$crop_price,$ph_no1,$ph_no2,$reg_no))
			{

				$flag=1;

			}
			else
			{
				$flag=2;
			}

			
	   }
		else
		{
		$flag=3;
		}
	}

	
	
?>
<html>
<head>
	<title>Add-Crop-For-Sale</title>
	
	<link rel="stylesheet" type="text/css" href="css/design.css" />
</head>
<body style="background-image: url('tool_background.avif');background-size:cover;background-repeat:no-repeat;background-position:center">
	
	<?php
		require_once('header.php');
	?>
	
	<div class="main">

	
		<h1 class="title">Add Crop For Sale</h1>

		<?php
		if($flag!=3)
		{
		 if($flag==1)
			{
		?>		
			<div class="success_msg">Crop Added For Sale Successful</div>
		<?php	
			}
			else if($flag==2)
			{
		?>
			<div class="failed_msg">Failed, Crop Not Added For Sale</div>
		<?php	
			}
		}elseif($flag==3)
		{
			?>
				<div class="failed_msg">Wrong Captcha</div>
			<?php
		}
		?>

		
		<div class="form">
		<form action="add_crop.php" method="POST" enctype="multipart/form-data">

		<label for="crop_name">Enter Crop Name 
		<input type="text" name="crop_name" id="crop_name" class="txtbox" placeholder="Enter Crop Name ">
		</label>

		<label for="crop_variety">Enter Crop variety
		<input type="text" name="crop_variety" id="crop_variety" class="txtbox"placeholder="Enter Crop variety">
		</label>

		
		<label for="crop_quantity">Enter Crop Quantity
		<input type="text" name="crop_quantity" id="crop_quantity" class="txtbox"placeholder="Enter Crop variety">
		</label>

		<label for="crop_price">Enter Expected Price Range
		<input type="text" name="crop_price" id="crop_price" class="txtbox"placeholder="Enter Expected Price Range">
		</label>

		<label for="crop_img">Submit an image of the Crop
		<input type="file" name="crop_img"  class="txtbox"placeholder="Submit an image of the Crop">
		</label>

		<label for="ph_no1">Enter Contact/Whatsapp Number
		<input type="text" name="ph_no1" id="ph_no1" class="txtbox"placeholder="Enter Contact/Whatsapp Number">
		</label>

		
		<label for="ph_no2">Enter Alternate Contact/Whatsapp Number
		<input type="text" name="ph_no2" id="ph_no2" class="txtbox"placeholder="Enter Contact/Whatsapp Number">
		</label>
		<br>
		<br>
		<?php
			function generateRandomString($length = 5) 
			{
				$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
				$charactersLength = strlen($characters);
				$randomString = '';
				for ($i = 0; $i < $length; $i++) {
					$randomString .= $characters[random_int(0, $charactersLength - 1)];
				}
				return $randomString;
			}
			
			$origial_captcha	=	generateRandomString();
			?>
			
			<label>Enter below given captcha code:</label>
			<br />
			
			<input type="text" name="original_captcha" id="original_captcha" class="form_input_txt" value="<?php echo $origial_captcha; ?>" readonly style="width:45%; text-align:center; color:orangered;" />
			<input type="text" name="user_captcha" id="user_captcha" class="form_input_txt" style="width:45%; text-align:center; color:orangered;" />
			<br>
			<br>

		<input type="submit" value="Add Crop For Sale" name="button" class="button">
		</form>

		


		</div>
	
	</div>
	
	<?php
		require_once('footer.php');
	?>
	
	<script type="text/javascript">
$(document).ready(function(){
	
	//Alert Message Box
	//alert("Welcome To JQuery");
	
	$("#user_captcha").keyup(function(){
		
		var var_user_captcha = $("#user_captcha").val();
		var var_original_captcha =	$("#original_captcha").val();
		
		//alert(var_user_captcha + " = " + var_original_captcha);
		
		if(var_user_captcha==var_original_captcha)
		{
			$("#user_captcha").css("background-color","#C8EFD4");
		}
		else
		{
			$("#user_captcha").css("background-color","#FBCFD0");
		}
		
	});
	
	
});
</script>
</body>
</html>