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

		$target_path = "assets\images\_tractor_part_images/";  
		
		//Get file name and concat to target folder
		$target_path = $target_path.basename( $_FILES['part_image']['name']);   
		 		
		if(move_uploaded_file($_FILES['part_image']['tmp_name'], $target_path)) {  
			echo "File uploaded successfully!";  
		} 
		else
		{  
			echo "Sorry, file not uploaded, please try again!";  
		}  


		$image= basename( $_FILES['part_image']['name']);
		$part_name = $_POST['part_name'];
		$compatible_with = $_POST['compatible_with'];
		$part_description= $_POST['description'];
		$city = $_POST['city'];
		$price_range=$_POST['part_price'];
		$ph_no1=$_POST['ph_no1'];
        $ph_no2=$_POST['ph_no2'];
		$reg_no=$mobile_no_session;

		if($db->save_parts($part_name,$compatible_with,$part_description,$city,$price_range,$image,$ph_no1,$ph_no2,$reg_no))
		{
			$flag=1;
		}
		else
		{
			$flag=2;
		}

	}

	
	
?>
<html>
<head>
	<title>Add Tractor impliments For Rent</title>
	
	<link rel="stylesheet" type="text/css" href="css/design.css" />
</head>
<body style="background-image: url('tool_background.avif');background-size:cover;background-repeat:no-repeat;background-position:center;background-attachment:fixed;">
	
	<?php
		require_once('header.php');
	?>
	
	<div class="main">
		<h1 class="title">Add Tractor Part for Rent</h1>

		<?php

		 if($flag==1)
			{
		?>		
			<div class="success_msg">Part Added For Rent Successful</div>
		<?php	
			}
			else if($flag==2)
			{
		?>
			<div class="failed_msg">Failed, Part Not Added For Rent</div>
		<?php	
			}
		?>

	<div class="form">

		<form action="part_for_rent.php" method="POST" enctype="multipart/form-data">

		<label for="part_name">Enter tractor impliment Name 
		<input type="text" name="part_name"  class="txtbox" placeholder="eg: Rotor/sprinkler">
		</label>

		<label for="compatible_with">The tractor impliment Is Compatible With
		<input type="text" name="compatible_with"  class="txtbox" placeholder="eg: garden tractor/heavy duty tractor">
		</label>

		<label for="description">Enter The Description Of tractor implement
		<input type="text" name="description"  class="txtbox" placeholder="eg:length / category">
		</label>

		<label for="city">Enter The City Where The Service Is Available
		<input type="text" name="city"  class="txtbox" placeholder="Enter The City Where The Service Is Available">
		</label>

		<label for="part_image">Enter The Image Of tractor implement
		<input type="file" name="part_image"  class="txtbox" placeholder="Enter The Image Of Part">
		</label>

		<label for="part_price">Enter Expected Price Range
		<input type="text" name="part_price" class="txtbox"placeholder="Enter Expected Price Range">
		</label>


		<label for="ph_no1">Enter Contact/Whatsapp Number
		<input type="text" name="ph_no1"  class="txtbox"placeholder="Enter Contact/Whatsapp Number">
		</label>

		
		<label for="ph_no2">Enter Alternate Contact/Whatsapp Number
		<input type="text" name="ph_no2" class="txtbox"placeholder="Enter Contact/Whatsapp Number">
		</label><br>
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
			<br><br>

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