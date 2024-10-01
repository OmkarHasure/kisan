<?php

	require_once('lib/functions.php');

	$db = new db_functions();
   $mobile_no=$_SESSION['mobile_no'];
	$data=array();
	$data=$db->get_mytractor_data($mobile_no);
	$flag=0;

	if(isset($_GET['delete_id']))
	{
		$var_delete_id	=	$_GET['delete_id'];
		
		if($db->delete_mytractor_record($var_delete_id))
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
	<title>Home</title>
	
	<link rel="stylesheet" type="text/css" href="css/design.css" />
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-grid.css" />
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-reboot.css" />
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-utilities.css" />

    <script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.bundle.js"></script>
</head>
<body style="background-image: url('tractor_background.avif');background-size:cover;background-repeat:no-repeat;background-position:center;background-attachment:fixed;">
	
	<?php
		require_once('header.php');
	?>
	
	<div class="main">

    <h1 class="title" style="font-weight: bold;">Tractors For Rent</h1>

	
	
    <br><br>
    <?php

		if($flag==1)
		{
			?> <h1 class="success_msg">tractor Details Deleted Successfully</h1>    <?php
		}
		elseif($flag==2)
		{
			?> <h1 class="failed_msg">tractor details  deletion failed</h1> <?php

		}

		if($data!=null)
	{
		$row=0;
		foreach($data as $ret_data)
		{
            $ret_id=$data[$row][0];
            $ret_tractor_company=$data[$row][1];
            $ret_tractor_model=$data[$row][2];
            $ret_tractor_type=$data[$row][3];
            $ret_tractor_no=$data[$row][4];
            $ret_drive=$data[$row][5];
            $ret_price_range=$data[$row][6];
            $ret_image=$data[$row][7];
            $ret_city=$data[$row][8];
            $ret_mobile1=$data[$row][9];
            $ret_mobile2=$data[$row][10];
            $ret_reg_no=$data[$row][11];
            $ret_date=$data[$row][12];
            $ret_time=$data[$row][13];

			?>
		<div class="card" style="max-width: 500px;margin-left:200px;margin-bottom:20px;color:#442C2C;">
				<img src="assets/images/_tractor_images/<?php echo $ret_image; ?>" class="card-img-top" alt="..." style="border: 2px solid black;" >
				<div class="card-body" style="border: 2px solid black;">
					<h4 class="card-title">Tractor Company Name:<?php echo $ret_tractor_company ?></h4>
					<h4 class="card-title">Tractor Model Name: <?php echo $ret_tractor_model; ?></h4>
					<h4 class="card-title">Tractor Type: <?php echo $ret_tractor_type; ?></h4>
                    <h4 class="card-title">Vehicle No: <?php echo $ret_tractor_no; ?></h4>
					<h5 class="card-title">With/Without Driver: <?php echo $ret_drive; ?></h5>
                    <h5 class="card-title">Price: <?php echo $ret_price_range; ?></h5>
                    <h5 class="card-title">Services Is Available in: <?php echo $ret_city; ?></h5>
					<h5 class="card-title">Mobile No: <?php echo $ret_mobile1; ?>/<?php echo $ret_mobile2; ?></h5>
					<h5 class="card-title">Posted On: <?php echo $ret_date; ?> <?php echo $ret_time ?></h5>
					<a href="mytractor.php?delete_id=<?php echo $ret_id;?>"  style="margin-left: 70px;height:30px;font-size:21px;font-weight:bold;background-color:#D4D2E3;border:1px solid black;text-decoration:none;color:darkslategrey">Delete</a>
					<a href="edit_tractor.php?edit_id=<?php echo $ret_id; ?>"  style="height:30px;font-size:21px;font-weight:bold;background-color:#D4D2E3;border:1px solid black;text-decoration:none;color:darkslategrey">Edit</a>

				</div>
			</div>

			<?php
			$row++;
		}
	}
	elseif($data==null)
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