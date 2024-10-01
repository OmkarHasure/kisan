<?php

	require_once('lib/functions.php');
	
	$db = new db_functions();
    $flag=0;
	$flag1=0;
	if(isset($_POST['submit']))
	{
		$full_name	=	$_POST['full_name'];
		$phone_number=$_POST['phone_number'];
        $email_id=$_POST['email_id'];
        $profession=$_POST['profession'];
        $password=$_POST['password'];
        $re_password=$_POST["re_password"];
		$var_original_captcha	=	$_POST['original_captcha'];
		$var_user_captcha	=	$_POST['user_captcha'];

		if($var_original_captcha==$var_user_captcha)
		{

			if($password==$re_password)
			{
				$flag1=1;
				if($db->add_registeration($full_name,$phone_number,$email_id,$profession,$password))
				{
					// file_get_contents("http://web.cloudwhatsapp.com/wapp/api/send?apikey=97a56f709372484f908ec24be5311849&mobile=$phone_number$&msg=Welcome Krishi Seva ");
					$flag	=	1;
				}
				else
				{
					$flag	=	2;
				}
			}
			else
			{
				$flag1=2;
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
	<title>Sign Up</title>
	
	<link rel="stylesheet" type="text/css" href="css/design.css" />
</head>
<body style="background-image: url('tool_background.avif');background-size:cover;background-repeat:no-repeat;background-position:center;background-attachment:fixed;">
	
	<?php
		require_once('header.php');
	?>
	
	<div class="main">
        <h1 class="title">Registeration Form</h1>
        <?php
		if($flag!=3)
	{
			if($flag1==1)
		{
			if($flag==1)
			{
			
		?>		
			<div class="success_msg">Registration successful</div>

			
		<?php	
			}
			else if($flag==2)
			{
		?>
			<div class="failed_msg">Registration failed</div>
		<?php	
			}
		}
		elseif($flag1==2)
		{
		?>
			<div class="failed_msg">Password Not Matching</div>
		<?php
		}
	}
	elseif($flag==3)
	{
		?>
			<div class="failed_msg">Wrong Captcha</div>
		<?php
	}

		?>
	<div class="form">

    <form action="registeration.php" method="POST">
        <label for="full_name">Enter Your Full Name
            <br>
            <input type="text"  name="full_name" class="txtbox" placeholder="Enter Your Full Name" required>
        </label>
        <br>
        <label for="ph_no">Enter Your Mobile Number 
        <br>
            <input type="text"  name="phone_number" class="txtbox" placeholder="Enter Your Mobile Number" required>
        </label>
        <br>
        <label for="email_id">Enter Your Email-ID
        <br>    
        <input type="email"  name="email_id" class="txtbox" placeholder="Enter Your Email-Address"required>
        </label>
        <br>
        <br>
        <select name="profession" id="profession" style="width: 250px;height:25px;">
				<option value="">Select Your Profession</option>
				<option value="Farmer">Farmer</option>
				<option value="Crop Whole Seller">Crop Whole Seller</option>
				<option value="Agribuissness">Agribuissness</option>
			</select>
        <br>
        <br>
        <label for="password">Enter Password 
        <br>
            <input type="password" id="password" name="password" class="txtbox" placeholder="Enter Password" required>
        </label>
		<label for="password">Re-enter  your Password 
        <br>
            <input type="password" id="re_password" name="re_password" class="txtbox" placeholder="Renter your Password" required>
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
			
			<input type="text" name="original_captcha" id="original_captcha" class="form_input_txt"   value="<?php echo $origial_captcha; ?>" readonly style="width:45%; text-align:center; color:orangered;" />
			
			<input type="text" name="user_captcha" id="user_captcha" class="form_input_txt" style="width:45%; text-align:center; color:orangered;" />
        <br>
		<br>
        <input type="submit"value="Create Account" name="submit" class="button" style="width: 160px;height:30px;">
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
			alert("wrong captcha Entered")
			$("#user_captcha").css("background-color","#FBCFD0");
		}
		
	});

	$("#re_password").keyup(function(){
		
		var pasword = $("#password").val();
		var re_password =	$("#re_password").val();
		
		//alert(var_user_captcha + " = " + var_original_captcha);
		
		if(pasword==re_password)
		{
			$("#user_captcha").css("background-color","#C8EFD4");
		}
		else
		{
			alert("Passwords Dont Match")
			$("#re_password").css("background-color","#FBCFD0");
		}
		
	});

	
	
});
</script>
</body>
</html>