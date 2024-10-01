<?php

	require_once('lib/functions.php');

	$db = new db_functions();

	if(!isset($_SESSION['mobile_no']))
	{
		header("Location:login.php?login");
	}

	$mobile_no_session=$_SESSION['mobile_no'];

	$ret_data=array();
	$ret_data=$db->get_crop_data();
	
?>
<html>
<head>
	<title>Crops for sale</title>
	
	<link rel="stylesheet" type="text/css" href="css/design.css" />
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-grid.css" />
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-reboot.css" />
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-utilities.css" />

    <script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.bundle.js"></script>
</head>
<body style="background-image: url('tool_background.avif');background-size:cover;background-repeat:no-repeat;background-position:center;background-attachment:fixed;">
	
	<?php
		require_once('header.php');
	?>
	
	<div class="main">
	<h1 class="title">Crops For Sale</h1>
	<hr>
	<br><br>
	<?php
		$row=0;
		foreach($ret_data as $data)
		{
			$ret_id=$ret_data[$row][0];
			$ret_crop_name=$ret_data[$row][1];
			$ret_variety=$ret_data[$row][2];
			$ret_quantity=$ret_data[$row][3];
			$ret_image=$ret_data[$row][4];
			$ret_expected_price=$ret_data[$row][5];
			$ret_mobile1=$ret_data[$row][6];
			$ret_mobile2=$ret_data[$row][7];
			$ret_reg_no=$ret_data[$row][8];
			$ret_date=$ret_data[$row][9];
			$ret_time=$ret_data[$row][10];

			?>

			<div class="card" style="max-width: 500px;margin-left:200px;margin-bottom:20px;color:#442C2C;">
					<img src="assets/images/crop_images/<?php echo $ret_image; ?>" class="card-img-top" alt="..."  style="border: 2px solid black;" >
					<div class="card-body"  style="border: 2px solid black;">
					<h4 class="card-title">Crop Name:<?php echo $ret_crop_name ?></h4>
					<h5 class="card-title">Crop variant: <?php echo $ret_variety; ?></h5>
					<h5 class="card-title">Crop Quantity Available: <?php $ret_quantity; ?></h5>
					<h5 class="card-title">Expected Price: <?php echo $ret_expected_price; ?></h5>
					<h5 class="card-title">Mobile No: <?php echo $ret_mobile1; ?>/<?php echo $ret_mobile2; ?></h5>
					<h5 class="card-title">Posted On: <?php echo $ret_date; ?> <?php echo $ret_time ?></h5>
					</div>
			</div>


			<?php
			$row++;
		}
			
	?>





	</div>
	
	<?php
		require_once('footer.php');
	?>
	
	
</body>
</html>