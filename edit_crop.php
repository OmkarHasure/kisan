<?php

	require_once('lib/functions.php');

	$db = new db_functions();

	$flag=0;

    if(isset($_GET['edit_id']))
    {
        $var_edit_id	=	$_GET['edit_id'];
        
        $_SESSION['edit_id']	=	$var_edit_id;
    }
    else if(isset($_SESSION['edit_id']))
    {
        $var_edit_id	=	$_SESSION['edit_id'];
    }


    $data=array();
    $data=$db->get_mycrop_data_id($var_edit_id);


            $ret_id=$data[0];
			$ret_crop_name=$data[1];
			$ret_variety=$data[2];
			$ret_quantity=$data[3];
			$ret_image=$data[4];
			$ret_expected_price=$data[5];
			$ret_mobile1=$data[6];
			$ret_mobile2=$data[7];
			$ret_reg_no=$data[8];
			$ret_date=$data[9];
			$ret_time=$data[10];
	


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


		$crop_name	=	$_POST['crop_name'];
		$crop_variety=$_POST['crop_variety'];
        $crop_quantity=$_POST['crop_quantity'];
        $crop_price=$_POST['crop_price'];
        $ph_no1=$_POST['ph_no1'];
        $ph_no2=$_POST['ph_no2'];
		$reg_no=$_SESSION['mobile_no'];
		


		
			if($db->save_Edit_crop($crop_name,$crop_variety,$crop_quantity,$file_name,$crop_price,$ph_no1,$ph_no2,$reg_no,$var_edit_id))
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
	<title>edit-Crop-Info</title>
	
	<link rel="stylesheet" type="text/css" href="css/design.css" />
</head>
<body style="background-image: url('tool_background.avif');background-size:cover;background-repeat:no-repeat;background-position:center">
	
	<?php
		require_once('header.php');
	?>
	
	<div class="main">

	
		<h1 class="title">Edit Crop Information</h1>

		<?php
		
		 if($flag==1)
			{
		?>		
			<div class="success_msg">Crop Details Edited successfully</div>
		<?php	
			}
			else if($flag==2)
			{
		?>
			<div class="failed_msg">Failed, Crop Details Are Not Edited</div>
		<?php	
			}
		?>

		
		<div class="form">
		<form action="edit_crop.php" method="POST" enctype="multipart/form-data">

		<label for="crop_name">Enter Crop Name 
		<input type="text" name="crop_name" id="crop_name" class="txtbox" value="<?php echo $ret_crop_name ;?>">
		</label>

		<label for="crop_variety">Enter Crop variety
		<input type="text" name="crop_variety" id="crop_variety" class="txtbox" value="<?php echo $ret_variety ;?>">
		</label>

		
		<label for="crop_quantity">Enter Crop Quantity
		<input type="text" name="crop_quantity" id="crop_quantity" class="txtbox" value="<?php echo $ret_quantity ;?>">
		</label>

		<label for="crop_price">Enter Expected Price Range
		<input type="text" name="crop_price" id="crop_price" class="txtbox" value="<?php echo $ret_expected_price ;?>">
		</label>

		<label for="crop_img">Submit an image of the Crop
		<input type="file" name="crop_img"  class="txtbox" >
		</label>

		<label for="ph_no1">Enter Contact/Whatsapp Number
		<input type="text" name="ph_no1" id="ph_no1" class="txtbox" value="<?php echo $ret_mobile1 ;?>">
		</label>

		
		<label for="ph_no2">Enter Alternate Contact/Whatsapp Number
		<input type="text" name="ph_no2" id="ph_no2" class="txtbox" value="<?php echo $ret_mobile2 ;?>">
		</label>
		<br>
		<br>

		<input type="submit" value="Edit Crop Details" name="button" class="button">
		</form>

		


		</div>
	
	</div>
	
	<?php
		require_once('footer.php');
	?>
	
	
</body>
</html>