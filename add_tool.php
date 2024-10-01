<?php

	require_once('lib/functions.php');

	$db = new db_functions();
	
	if(isset($_POST['button']))
	{
		
	}

	
	
?>
<html>
<head>
	<title>Home</title>
	
	<link rel="stylesheet" type="text/css" href="css/design.css" />
</head>
<body>
	
	<?php
		require_once('header.php');
	?>
	
	<div class="main">
		<h1 class="title"> Request Requierments </h1>


	<div class="form">




		<label for="tools"> Enter the Tools Requiered
			<br>
			<textarea name="tools"  rows="10" cols="50">
				
			</textarea>
		</label>

		<form action="add_tool.php" method="POST" enctype="multipart/form-data">


		

        <input type="submit" value="Add Crop For Sale" name="button" class="button">

		</form>
	</div>

	</div>
	
	<?php
		require_once('footer.php');
	?>
	
	
</body>
</html>