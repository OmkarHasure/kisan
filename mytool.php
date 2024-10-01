<?php

	require_once('lib/functions.php');

	$db = new db_functions();
    $mobile_no=$_SESSION['mobile_no'];
	$data=array();
	$data=$db->get_mytool_data($mobile_no);
	$flag=0;

	if(isset($_GET['delete_id']))
	{
		$var_delete_id	=	$_GET['delete_id'];
		
		if($db->delete_mytool_record($var_delete_id))
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
	<title>my Tractor Implements</title>
	
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

    <br><br>
    <h1 class="title">Available Tractor Implements For Rent</h1>
	<br><br>

    <?php

	if($flag==1)
	{
		?> <h1 class="success_msg">Tractor Implements deleted Successfully</h1>    <?php
	}
	elseif($flag==2)
	{
		?> <h1 class="failed_msg">Tractor Implements deletion failed</h1> <?php

	}
	if($data!=null)
	{
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
			<div class="card"  style="max-width: 500px;margin-left:200px;margin-bottom:20px;color:#442C2C;">
				<img src="assets/images/_tractor_part_images/<?php echo $ret_image; ?>" class="card-img-top" alt="..." style="border: 2px solid black;max-height:400px" >
				<div class="card-body" style="border: 2px solid black;">
				<h4 class="card-title">Tractor Tool Name:<?php echo $ret_part_name ?></h4>
					<h4 class="card-title">Compatible With: <?php echo $ret_compatible_with; ?></h4>
					<h4 class="card-title">Discription: <?php echo $ret_discription; ?></h4>
                    <h5 class="card-title">Price: <?php echo $ret_price; ?></h5>
                    <h5 class="card-title">Services Is Available in: <?php echo $ret_city; ?></h5>
					<h5 class="card-title">Mobile No: <?php echo $ret_mobile1; ?>/<?php echo $ret_mobile2; ?></h5>
					<h5 class="card-title">Posted On: <?php echo $ret_date; ?> <?php echo $ret_time ?></h5>
					<a href="mytool.php?delete_id=<?php echo $ret_id; ?>"  style="margin-left: 70px;height:30px;font-size:21px;font-weight:bold;background-color:#D4D2E3;border:1px solid black;text-decoration:none;color:darkslategrey">Delete</a>
					<a href="edit_tool.php?edit_id=<?php echo $ret_id; ?>"  style="height:30px;font-size:21px;font-weight:bold;background-color:#D4D2E3;border:1px solid black;text-decoration:none;color:darkslategrey">Edit</a>

				
				</div>
			</div>

			<?php
			$rows++;
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