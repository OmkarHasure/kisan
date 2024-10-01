<?php

	require_once('lib/functions.php');

	$db = new db_functions();
	
	if(!isset($_SESSION['mobile_no']))
	{
		header("Location:login.php?login");
	}

	$mobile_no_session=$_SESSION['mobile_no'];

	$user_record=array();
	$user_record=$db->get_user_data_mobile_no($mobile_no_session);

	if(!empty($user_record))
	{
		$ret_name=$user_record[0];
		$ret_phone_no=$user_record[1];
		$ret_email_id=$user_record[2];
		$ret_profession=$user_record[3];
		$ret_password=$user_record[4];
		$ret_date=$user_record[5];
		$ret_time=$user_record[6];

	}
	

	
?>
<html>
<head>
	<title>Profile</title>
	
	<link rel="stylesheet" type="text/css" href="css/design.css" />
</head>
<body>
	
	<?php
		require_once('header.php');
	?>
	
	<div class="main">
     <h1 class="title">Profile Page</h1>
	<div style="margin-left:25% ;border:2px solid black;width:50%;">

	<h3>Name: <?php echo $ret_name; ?></h3>
	
	<h3>Mobile No: <?php echo $ret_phone_no; ?></h3>
	
	<h3>Email Id: <?php echo $ret_email_id; ?></h3>
	
	<h3>Profession: <?php echo $ret_profession; ?></h3>
	
	<h3>Password: <?php echo $ret_password; ?></h3>
	
	<h3>Joined Website On: <?php echo $ret_date;?>   <?php  echo $ret_time; ?></h3>

	<br>
	<br>
	<a href="mycrop.php" style="margin-left: 70px;height:30px;font-size:21px;font-weight:bold;background-color:#05DF45;border:1px solid black;text-decoration:none;color:darkslategrey">My Crop For Sale</a>
	<a href="mytractor.php" style="margin-left: 10px;height:30px;font-size:21px;font-weight:bold;background-color:#05DF45;border:1px solid black;text-decoration:none;color:darkslategrey">My Tractors for rent</a>
	<a href="mytool.php" style="margin-left: 10px;height:30px;font-size:21px;font-weight:bold;background-color:#05DF45;border:1px solid black;text-decoration:none;color:darkslategrey">My Tractor tool for rent</a>
	
	<br><br>
	<a href="login.php?logout" style="text-align: center;text-decoration:none;font-size:30px;border:2px solid black;padding:2px;margin-left:42%;">Logout</a>
	<br><br>

	</div>
	
	</div>
	<?php
		require_once('footer.php');
	?>
	
	
</body>
</html>