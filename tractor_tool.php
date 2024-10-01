<?php

	require_once('lib/functions.php');

	$db = new db_functions();

	if(!isset($_SESSION['mobile_no']))
	{
		header("Location:login.php?login");
	}

	$mobile_no_session=$_SESSION['mobile_no'];

	$data=array();
    
	$data=$db->get_tractor_tool_data();
	
?>
<html>
<head>
	<title>Available Tractor Implements For Rent</title>
	
	<link rel="stylesheet" type="text/css" href="css/design.css" />
</head>
<body style="background-image: url('tractor_background.avif');background-size:cover;background-repeat:no-repeat;background-position:center;background-attachment:fixed;">
	
	<?php
		require_once('header.php');
	?>
	
	<div class="main">
<br><br>
    <h1 class="title">Available Tractor Implements For Rent</h1>
	<br><br>

    <?php
		$rows=0;
		foreach($data as $ret_data)
		{
            $ret_id=$data[$rows][0];
            $ret_part_name=$data[$rows][1];
            $ret_compatible_with=$data[$rows][2];
            $ret_discription=$data[$rows][3];
            $ret_city=$data[$rows][4];
            $ret_image=$data[$rows][5];
            $ret_price=$data[$rows][6];
            $ret_mobile1=$data[$rows][7];
            $ret_mobile2=$data[$rows][8];
            $ret_reg_no=$data[$rows][9];
            $ret_date=$data[$rows][10];
            $ret_time=$data[$rows][11];

			?>

			<div class="card"  style="max-width: 600px;margin-left:200px;margin-bottom:20px;color:#442C2C;">
				<img src="assets/images/_tractor_part_images/<?php echo $ret_image; ?>" class="card-img-top" alt="..." style="border: 2px solid black;max-height:400px" >
				<div class="card-body" style="border: 2px solid black;">
				<h4 class="card-title">Tractor Implement Name:<?php echo $ret_part_name ?></h4>
					<h4 class="card-title">Compatible With: <?php echo $ret_compatible_with; ?></h4>
					<h4 class="card-title">Discription: <?php echo $ret_discription; ?></h4>
                    <h5 class="card-title">Price: <?php echo $ret_price; ?></h5>
                    <h5 class="card-title">Services Is Available in: <?php echo $ret_city; ?></h5>
					<h5 class="card-title">Mobile No: <?php echo $ret_mobile1; ?>/<?php echo $ret_mobile2; ?></h5>
					<h5 class="card-title">Posted On: <?php echo $ret_date; ?> <?php echo $ret_time ?></h5>
				</div>
			</div>




			<?php
			$rows++;
		}
			
	?>

	</div>
	
	<?php
		require_once('footer.php');
	?>
	
	
</body>
</html>