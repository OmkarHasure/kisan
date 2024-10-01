<?php

require_once('lib/functions.php');

$db= new db_functions();
$flag=0;

if(!isset($_SESSION['mobile_no']))
	{
		header("Location:login.php?login");
	}

	$mobile_no_session=$_SESSION['mobile_no'];


if(isset($_POST['button']))
	{
		$target_path = "assets\images\_tractor_images/";  
			
			//Get file name and concat to target folder
			$target_path = $target_path.basename( $_FILES['image']['name']);   
					
			if(move_uploaded_file($_FILES['image']['tmp_name'], $target_path)) {  

				echo "File uploaded successfully!";  
			} else{  
				echo "Sorry, file not uploaded, please try again!";  
			}  

			$image=basename( $_FILES['image']['name']); 

            $tractor_company=$_POST['tractor_company'];
            $tractor_model=$_POST['tractor_model'];
            $tractor_type=$_POST['tractor_type'];
            $tractor_no=$_POST['tractor_no'];
            $driver=$_POST['driver'];
            $expected_price=$_POST['expected_price'];
            $city=$_POST['city'];
            $phone_no1=$_POST['ph_no1'];
            $phone_no2=$_POST['ph_no2'];
            $reg_no=$mobile_no_session;

            if($db->save_tractor($tractor_company,$tractor_model,$tractor_type,$tractor_no,$driver,$expected_price,$image,$city,$phone_no1,$phone_no2,$reg_no))
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
	<title>Add Tractor For Rent</title>
	
	<link rel="stylesheet" type="text/css" href="css/design.css" />
</head>
<body  style="background-image: url('tool_background.avif');background-size:cover;background-repeat:no-repeat;background-position:center">
	
	<?php
		require_once('header.php');
	?>
	
	<div class="main">
        <h1 class="title">Add Tractor For Rent </h1>

        <?php
		if($flag!=3)
		{
		 if($flag==1)
			{
		?>		
			<div class="success_msg">Tractor added For Rent Services Successfully</div>
		<?php	
			}
			else if($flag==2)
			{
		?>
			<div class="failed_msg">Failed, Tractor not added For Rent Services</div>
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
            <form action="add_tractor.php" method="POST" enctype="multipart/form-data">
                <label for="tractor_company">Enter Tractor Company Name
                    <input type="text" name="tractor_company" class="txtbox" placeholder="eg:Mahindra/John deere">
                </label>
                <label for="tractor_company">Enter Tractor Model
                    <input type="text" name="tractor_model" class="txtbox" placeholder="eg: swaraj fe/John deere 5050d">
                </label>
                <label for="tractor_type">Enter Tractor type
                    <input type="text" name="tractor_type" class="txtbox" placeholder="eg:heavy duty/garden/compact">
                </label>
                <label for="tractor_no">Enter Tractor No
                    <input type="text" name="tractor_no" class="txtbox" placeholder="eg:MH13SB1366">
                </label>
                <select name="driver"  style="width: 300px;height:25px;margin:10px;">
				<option value="">with driver/Without driver</option>
				<option value="With driver">With Driver</option>
				<option value="Without driver">With Out Driver</option>
			    </select>
                <label for="expected_price">Enter Expected Price Per Acre
                    <input type="text" name="expected_price" class="txtbox" placeholder="eg:2000 per Acre">
                </label>
               
                <label for="image" style="margin: 10px;">Enter image of Tractor
                    <br>
                    <input type="file" name="image" class="txtbox" style="width:200px;margin:10px;">
                </label>
                
                <label for="city">Enter the city where the Service Is available
                    <input type="text" name="city" class="txtbox" placeholder="solapur">
                </label>
                

                <label for="ph_no1">Enter Contact/Whatsapp Number
                    <input type="text" name="ph_no1" id="ph_no1" class="txtbox"placeholder="Enter Contact/Whatsapp Number">
                    </label>

		
                <label for="ph_no2">Enter Alternate Contact/Whatsapp Number
                <input type="text" name="ph_no2" id="ph_no2" class="txtbox"placeholder="Enter Contact/Whatsapp Number">
                </label>
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

		<input type="submit" value="Add Crop For Sale" name="button" class="button" style="height: 30px;">
		</form>
                
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