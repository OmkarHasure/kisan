<?php

	require_once('lib/functions.php');

	$db = new db_functions();
    $mobile_no=$_SESSION['mobile_no'];
	$flag=0;
	$ret_data=array();
	$ret_data=$db->get_mycrop_data($mobile_no);

	if(isset($_GET['delete_id']))
	{
		$var_delete_id	=	$_GET['delete_id'];
		
		if($db->delete_mycrop_record($var_delete_id))
		{
			$flag = 1;
		}
		else
		{
			$flag = 2;
		}
	}
	
?>
<html>
<head>
	<title>My Crops For Sale</title>
	
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

    <h1 class="title">My Crops For Sale</h1>
	<hr>
	<br><br>
	<?php

if($flag==1)
{
	?> <h1 class="success_msg">Crop Deleted Successfully</h1>    <?php
}
elseif($flag==2)
{
	?> <h1 class="failed_msg">crop deletion failed</h1> <?php

}

if($ret_data!=null)
	{
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
					<a href="mycrop.php?delete_id=<?php echo $ret_id;?>"  style="margin-left: 70px;height:30px;font-size:21px;font-weight:bold;background-color:#D4D2E3;border:1px solid black;text-decoration:none;color:darkslategrey">Delete</a>
					<a href="edit_crop.php?edit_id=<?php echo $ret_id; ?>"  style="height:30px;font-size:21px;font-weight:bold;background-color:#D4D2E3;border:1px solid black;text-decoration:none;color:darkslategrey">Edit</a>

					</div>
			</div>

			<?php
			$row++;
		}
	}
	elseif($ret_data==null)
	{
		?>	<h2 class="failed_msg"> <?php echo("No Result Found"); ?></h2> <?php
	}
		
			
	?>
	
	</div>
	
	<?php
		require_once('footer.php');
	?>
	
	
</body>
</html>