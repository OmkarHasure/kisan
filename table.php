<?php
	require_once('lib/functions.php');
	$db = new db_functions();
	
	$flag = 0;
	if(isset($_GET['delete_id']))
	{
		$var_delete_id	=	$_GET['delete_id'];
		
		if($db->delete_user_record($var_delete_id))
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
    <title>table</title>

    <link rel="stylesheet" type="text/css" href="css/design.css" />
</head>

<body>

    <?php
		require_once('header.php');
	?>

    <div class="main">
        <h1 class="title">Registeration Report </h1>

		<?php
			if($flag==1)
			{
		?>		
			<div class="success_msg">Deleted successful</div>
		<?php	
			}
			else if($flag==2)
			{
		?>
			<div class="failed_msg">Deletion failed</div>
		<?php	
			}
		?>
        <table border="2" cellspacing="1" cellpadding="10">

		<thead>
		<th>Sr No</th>
		<th> Name</th>
		<th>Mobile no</th>
		<th>Email Id</th>
		<th>Profession</th>
		<th>Password</th>
		<th>Date</th>
		<th>Time</th>
		<th>Action</th>
		<th>Action</th>
	</thead>

            <tbody>

                <?php
		$retrived_data =	array();
		$retrived_data = $db->get_user_data();
		
		
		if(!empty($retrived_data))
		{
			$row = 0;
			foreach($retrived_data as $record)
			{
				$retrived_id			=	$retrived_data[$row][0];
				$retrived_name	=	$retrived_data[$row][1];
				$retrived_phone_number		=	$retrived_data[$row][2];
				$retrived_email_id	=	$retrived_data[$row][3];
				$retrived_profession	=	$retrived_data[$row][4];
				$retrived_password	=	$retrived_data[$row][5];
				$retrived_date		=	$retrived_data[$row][6];
				$retrived_time		=	$retrived_data[$row][7];
		?>
                <tr>
                    <td><?php echo $row+1; ?></td>
                    <td><?php echo $retrived_name; ?></td>
                    <td><?php echo $retrived_phone_number; ?></td>
                    <td><?php echo $retrived_email_id; ?></td>
                    <td><?php echo $retrived_profession; ?></td>
                    <td><?php echo $retrived_password; ?></td>
                    <td><?php echo $retrived_date; ?></td>
                    <td><?php echo $retrived_time; ?></td>
                    <td>

                        <a href="table.php?delete_id=<?php echo $retrived_id; ?>">Delete</a>

                    </td>
					<td>
					<a href="edit_regesteration.php?edit_id=<?php echo $retrived_id; ?>">Edit</a>
					</td>
                </tr>
                <?php
		
				$row++;
			}
		}
		else
		{
			echo "No data Found";
		}
	?>
            </tbody>

        </table>

    </div>

    <?php
		require_once('footer.php');
	?>


</body>

</html>