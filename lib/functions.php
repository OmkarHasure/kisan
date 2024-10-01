<?php
date_default_timezone_set('Asia/kolkata');

session_start();
class db_functions
{
	private $con;
	function __construct()
	{
	
		$this->con = new mysqli("localhost","root","","krishi_seva");
	}


	function add_registeration($full_name,$phone_number,$email_id,$profession,$password)
	{
		$date = date("Y-m-d");
		$time = date("h:i:s a");
		
		if($stmt = $this->con->prepare("INSERT INTO `registeration`(`full_name`, `phone_number`, `email_id`, `profession`, `password`, `date`, `time`) VALUES (?,?,?,?,?,?,?)"))
		{
			$stmt->bind_param("sssssss",$full_name,$phone_number,$email_id,$profession,$password,$date,$time);
			
			if($stmt->execute())
			{
				return true;
			}
			return false;
		}
	}

	function get_user_data()
	{
		if($stmt = $this->con->prepare("SELECT `id`, `full_name`, `phone_number`, `email_id`, `profession`, `password`, `date`, `time` FROM `registeration`"))
		{
			$stmt->bind_result($retrived_id,$retrived_name,$retrived_phone_number,$retrived_email_id,$retrived_profession,$retrived_password,$retrived_date,$retrived_time);
			
			if($stmt->execute())
			{
				$data	=	array();
				$row = 0;
				
				while($stmt->fetch())
				{
					$data[$row][0]	=	$retrived_id;
					$data[$row][1]	=	$retrived_name;
					$data[$row][2]	=	$retrived_phone_number;
					$data[$row][3]	=	$retrived_email_id;
					$data[$row][4]	=	$retrived_profession;
					$data[$row][5]	=	$retrived_password;
					$data[$row][6]	=	$retrived_date;
					$data[$row][7]	=	$retrived_time;
					
					$row++;
				}
				
				if(!empty($data))
				{
					return $data;
				}
				return false;
			}
		}
	}

	function get_crop_data()
	{
		if($stmt=$this->con->prepare("SELECT `id`, `crop_name`, `variety_of_crop`, `quantity`, `image`, `expected_price`, `ph_number_1`, `ph_number_2`, `reg_no`, `date`, `time` FROM `crop` "))
		{
			$stmt->bind_result($ret_id,$ret_crop_name,$ret_variety,$ret_quantity,$ret_image,$ret_expected_price,$ret_mobile1,$ret_mobile2,$ret_reg_no,$ret_date,$ret_time);
			if($stmt->execute())
			{
				$data=array();
				$row=0;
				while($stmt->fetch())
				{
					$data[$row][0]=$ret_id;
					$data[$row][1]=$ret_crop_name;
					$data[$row][2]=$ret_variety;
					$data[$row][3]=$ret_quantity;
					$data[$row][4]=$ret_image;
					$data[$row][5]=$ret_expected_price;
					$data[$row][6]=$ret_mobile1;
					$data[$row][7]=$ret_mobile2;
					$data[$row][8]=$ret_reg_no;
					$data[$row][9]=$ret_date;
					$data[$row][10]=$ret_time;

					$row++;
				}
				if(!empty($data))
				{
					return $data;
				}
				return false;
			}
		}
	}
	function get_tractor_data()
	{
		if($stmt=$this->con->prepare("SELECT `id`, `tractor_company_name`, `tractorModel_name`, `tractor_type`, `tractor_no`, `driver`, `price_range`, `image`, `city`, `ph_no1`, `ph_no2`, `reg_no`, `date`, `time` FROM `tractor_rent` "))
		{
			$stmt->bind_result($ret_id,$ret_tractor_company,$ret_tractor_model,$ret_tractor_type,$ret_tractor_no,$ret_driver,$ret_price_range,$ret_image,$ret_city,$ret_mobile1,$ret_mobile2,$ret_reg_no,$ret_date,$ret_time);
			if($stmt->execute())
			{
				$row=0;
				$data=array();
				while($stmt->fetch())
				{
					$data[$row][0]=$ret_id;
					$data[$row][1]=$ret_tractor_company;
					$data[$row][2]=$ret_tractor_model;
					$data[$row][3]=$ret_tractor_type;
					$data[$row][4]=$ret_tractor_no;
					$data[$row][5]=$ret_driver;
					$data[$row][6]=$ret_price_range;
					$data[$row][7]=$ret_image;
					$data[$row][8]=$ret_city;
					$data[$row][9]=$ret_mobile1;
					$data[$row][10]=$ret_mobile2;
					$data[$row][11]=$ret_reg_no;
					$data[$row][12]=$ret_date;
					$data[$row][13]=$ret_time;

					$row++;
				}
				if(!empty($data))
				{
					return $data;
				}
				return false;

			}
		}
	}

	function get_tractor_tool_data()
	{
		if($stmt=$this->con->prepare("SELECT `id`, `part_name`, `compatible_with`, `discription`, `city`, `image`, `Expected_price`, `ph_number_1`, `ph_number_2`, `reg_no`, `date`, `time` FROM `tractor_part` "))
		{
			$stmt->bind_result($ret_id,$ret_part_name,$ret_compatible_with,$ret_discription,$ret_city,$ret_image,$ret_price,$ret_mobile1,$ret_mobile2,$ret_reg_no,$ret_date,$ret_time);
			if($stmt->execute())
			{
				$rows=0;
				$data=array();
				while($stmt->fetch())
				{
					$data[$rows][0]=$ret_id;
					$data[$rows][1]=$ret_part_name;
					$data[$rows][2]=$ret_compatible_with;
					$data[$rows][3]=$ret_discription;
					$data[$rows][4]=$ret_city;
					$data[$rows][5]=$ret_image;
					$data[$rows][6]=$ret_price;
					$data[$rows][7]=$ret_mobile1;
					$data[$rows][8]=$ret_mobile2;
					$data[$rows][9]=$ret_reg_no;
					$data[$rows][10]=$ret_date;
					$data[$rows][11]=$ret_time;
					

					$rows++;
				}
				if(!empty($data))
				{
					return $data;
				}
				return false;

			}
		}
	}

	function delete_user_record($delete_id)
	{
		if($stmt = $this->con->prepare("DELETE FROM `registeration` WHERE `id`=?"))
		{
			$stmt->bind_param("i",$delete_id);
			
			if($stmt->execute())
			{
				return true;
			}
			return false;
		}
	}

	function get_password($mobile_number)
	{

		if($stmt=$this->con->prepare("SELECT `password` FROM `registeration` WHERE `phone_number`=?"))
		{
			$stmt->bind_param("s",$mobile_number);
			$stmt->bind_result($retrived_password);
			if($stmt->execute())
			{
				if($stmt->fetch())
				{
					return $retrived_password;
				}
				return false;
			}
		}

	}

	
	function update_user_record($full_name,$phone_number,$email_id,$profession,$password,$var_edit_id)
	{
		if($stmt=$this->con->prepare("UPDATE `registeration` SET `full_name`=?,`phone_number`=?,`email_id`=?,`profession`=?,`password`=? WHERE `id` =?"))
		{
			$stmt->bind_param("sssssi",$full_name,$phone_number,$email_id,$profession,$password,$var_edit_id);
			
			if($stmt->execute())
			{
				return true;
			}
			return false;
		}
	}

	function get_previous_user_data($var_edit_id)
	{
		if($stmt=$this->con->prepare("SELECT `full_name`, `phone_number`, `email_id`, `profession`, `password` FROM `registeration` WHERE `id`=?"))
		{
			$stmt->bind_param("i",$var_edit_id);
			$stmt->bind_result($ret_name,$ret_phone_no,$ret_email_id,$ret_profession,$ret_password);
			if($stmt->execute())
			{
				$data=array();

				if($stmt->fetch())
				{

					$data[0]=$ret_name;
					$data[1]=$ret_phone_no;
					$data[2]=$ret_email_id;
					$data[3]=$ret_profession;
					$data[4]=$ret_password;

					return $data;

				}
				return false;

			}
		}
	}

	function get_user_data_mobile_no($mobile_no)
	{
		if($stmt=$this->con->prepare("SELECT  `full_name`, `phone_number`, `email_id`, `profession`, `password`, `date`, `time` FROM `registeration` WHERE `phone_number`=?;"))
		{
			$stmt->bind_param("s",$mobile_no);
			$stmt->bind_result($ret_name,$ret_phone_no,$ret_email_id,$ret_profession,$ret_password,$ret_date,$ret_time);
			if($stmt->execute())
			{
				$data=array();

				if($stmt->fetch())
				{

					$data[0]=$ret_name;
					$data[1]=$ret_phone_no;
					$data[2]=$ret_email_id;
					$data[3]=$ret_profession;
					$data[4]=$ret_password;
					$data[5]=$ret_date;
					$data[6]=$ret_time;


					return $data;

				}
				return false;

			}
		}
	}
	function save_crop($crop_name,$crop_variety,$crop_quantity,$image,$crop_price,$ph_no1,$ph_no2,$reg_no)
	{

		$date = date("Y-m-d");
		$time = date("h:i:s a");
	
		if($stmt=$this->con->prepare("INSERT INTO `crop`(`crop_name`, `variety_of_crop`, `quantity`, `image`, `expected_price`, `ph_number_1`, `ph_number_2`, `reg_no`, `date`, `time`) VALUES (?,?,?,?,?,?,?,?,?,?)"))
	
		{
			
			$stmt->bind_param("ssssssssss",$crop_name,$crop_variety,$crop_quantity,$image,$crop_price,$ph_no1,$ph_no2,$reg_no,$date,$time);

			if($stmt->execute())
			{
				return true;
			}

			return false;
		}
	}

	function save_parts($part_name,$compatible_with,$part_description,$city,$price_range,$image,$ph_no1,$ph_no2,$reg_no)
	{
		$date = date("Y-m-d");
		$time = date("h:i:s a");
		if($stmt=$this->con->prepare("INSERT INTO `tractor_part`( `part_name`, `compatible_with`, `discription`, `city`, `image`, `Expected_price`, `ph_number_1`, `ph_number_2`, `reg_no`, `date`, `time`) VALUES (?,?,?,?,?,?,?,?,?,?,?)"))
		{
			$stmt->bind_param("sssssssssss",$part_name,$compatible_with,$part_description,$city,$image,$price_range,$ph_no1,$ph_no2,$reg_no,$date,$time);

			if($stmt->execute())
			{
				return true;
			}

			return false;
		}
	}


	function save_tractor($tractor_company,$tractor_model,$tractor_type,$tractor_no,$driver,$expected_price,$image,$city,$phone_no1,$phone_no2,$reg_no)
	{
		$date = date("Y-m-d");
		$time = date("h:i:s a");
		if($stmt=$this->con->prepare("INSERT INTO `tractor_rent`( `tractor_company_name`, `tractorModel_name`, `tractor_type`, `tractor_no`, `driver`, `price_range`, `image`, `city`, `ph_no1`, `ph_no2`, `reg_no`, `date`, `time`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)"))
		{
			$stmt->bind_param("sssssssssssss",$tractor_company,$tractor_model,$tractor_type,$tractor_no,$driver,$expected_price,$image,$city,$phone_no1,$phone_no2,$reg_no,$date,$time);
			if($stmt->execute())
			{
			return true;
		    }	
			return false;
		}
	}

	function get_mytractor_data($mobile_no)
	{
		if($stmt=$this->con->prepare("SELECT `id`, `tractor_company_name`, `tractorModel_name`, `tractor_type`, `tractor_no`, `driver`, `price_range`, `image`, `city`, `ph_no1`, `ph_no2`, `reg_no`, `date`, `time` FROM `tractor_rent` WHERE `reg_no`=?"))
		{
			$stmt->bind_param("s",$mobile_no);
			$stmt->bind_result($ret_id,$ret_tractor_company,$ret_tractor_model,$ret_tractor_type,$ret_tractor_no,$ret_driver,$ret_price_range,$ret_image,$ret_city,$ret_mobile1,$ret_mobile2,$ret_reg_no,$ret_date,$ret_time);
			if($stmt->execute())
			{
				$row=0;
				$data=array();
				while($stmt->fetch())
				{
					$data[$row][0]=$ret_id;
					$data[$row][1]=$ret_tractor_company;
					$data[$row][2]=$ret_tractor_model;
					$data[$row][3]=$ret_tractor_type;
					$data[$row][4]=$ret_tractor_no;
					$data[$row][5]=$ret_driver;
					$data[$row][6]=$ret_price_range;
					$data[$row][7]=$ret_image;
					$data[$row][8]=$ret_city;
					$data[$row][9]=$ret_mobile1;
					$data[$row][10]=$ret_mobile2;
					$data[$row][11]=$ret_reg_no;
					$data[$row][12]=$ret_date;
					$data[$row][13]=$ret_time;

					$row++;
				}
				if(!empty($data))
				{
					return $data;
				}
				return false;

			}
		}

	}

	function get_mytool_data($mobile_no)
	{
		if($stmt=$this->con->prepare("SELECT `id`, `part_name`, `compatible_with`, `discription`, `city`, `image`, `Expected_price`, `ph_number_1`, `ph_number_2`, `reg_no`, `date`, `time` FROM `tractor_part` WHERE `reg_no`=? "))
		{
			$stmt->bind_param("s",$mobile_no);
			$stmt->bind_result($ret_id,$ret_part_name,$ret_compatible_with,$ret_discription,$ret_city,$ret_image,$ret_price,$ret_mobile1,$ret_mobile2,$ret_reg_no,$ret_date,$ret_time);
			if($stmt->execute())
			{
				$rows=0;
				$data=array();
				while($stmt->fetch())
				{
					$data[$rows][0]=$ret_id;
					$data[$rows][1]=$ret_part_name;
					$data[$rows][2]=$ret_compatible_with;
					$data[$rows][3]=$ret_discription;
					$data[$rows][4]=$ret_city;
					$data[$rows][5]=$ret_image;
					$data[$rows][6]=$ret_price;
					$data[$rows][7]=$ret_mobile1;
					$data[$rows][8]=$ret_mobile2;
					$data[$rows][9]=$ret_reg_no;
					$data[$rows][10]=$ret_date;
					$data[$rows][11]=$ret_time;
					

					$rows++;
				}
				if(!empty($data))
				{
					return $data;
				}
				return false;

	        }
       }
	}

	function get_mycrop_data($mobile_no)
	{

		if($stmt=$this->con->prepare("SELECT `id`, `crop_name`, `variety_of_crop`, `quantity`, `image`, `expected_price`, `ph_number_1`, `ph_number_2`, `reg_no`, `date`, `time` FROM `crop` WHERE `reg_no`=?"))
		{
			$stmt->bind_param("s",$mobile_no);
			$stmt->bind_result($ret_id,$ret_crop_name,$ret_variety,$ret_quantity,$ret_image,$ret_expected_price,$ret_mobile1,$ret_mobile2,$ret_reg_no,$ret_date,$ret_time);
			if($stmt->execute())
			{
				$data=array();
				$row=0;
				while($stmt->fetch())
				{
					$data[$row][0]=$ret_id;
					$data[$row][1]=$ret_crop_name;
					$data[$row][2]=$ret_variety;
					$data[$row][3]=$ret_quantity;
					$data[$row][4]=$ret_image;
					$data[$row][5]=$ret_expected_price;
					$data[$row][6]=$ret_mobile1;
					$data[$row][7]=$ret_mobile2;
					$data[$row][8]=$ret_reg_no;
					$data[$row][9]=$ret_date;
					$data[$row][10]=$ret_time;

					$row++;
				}
				if(!empty($data))
				{
					return $data;
				}
				return false;
			}
		}
		

	}

 function delete_mytool_record($var_delete_id)
 
 {
	    if($stmt = $this->con->prepare("DELETE FROM `tractor_part` WHERE `id`=?"))
		{
			$stmt->bind_param("i",$var_delete_id);
			
			if($stmt->execute())
			{
				return true;
			}
			return false;
		}
 }


 function save_parts_id($part_name,$compatible_with,$part_description,$city,$price_range,$image,$ph_no1,$ph_no2,$reg_no)
	{
		$date = date("Y-m-d");
		$time = date("h:i:s a");
		if($stmt=$this->con->prepare("UPDATE `tractor_part` SET `part_name`=?,`compatible_with`=?,`discription`=?,`city`=?,`image`=?,`Expected_price`=?,`ph_number_1`=?,`ph_number_2`=?,`reg_no`=?,`date`=?,`time`=? WHERE `id`=?"))
		{
			$stmt->bind_param("ssssssssssss",$part_name,$compatible_with,$part_description,$city,$image,$price_range,$ph_no1,$ph_no2,$reg_no,$date,$time,$var_edit_id);

			if($stmt->execute())
			{
				return true;
			}

			return false;
		}
	}

	function get_tool_data_id($var_edit_id)
	{
		if($stmt=$this->con->prepare("SELECT `id`, `part_name`, `compatible_with`, `discription`, `city`, `image`, `Expected_price`, `ph_number_1`, `ph_number_2`, `reg_no`, `date`, `time` FROM `tractor_part` WHERE `id`=? "))
		{
			$stmt->bind_param("s",$var_edit_id);
			$stmt->bind_result($ret_id,$ret_part_name,$ret_compatible_with,$ret_discription,$ret_city,$ret_image,$ret_price,$ret_mobile1,$ret_mobile2,$ret_reg_no,$ret_date,$ret_time);
			if($stmt->execute())
			{
				
				$data=array();
				while($stmt->fetch())
				{
					$data[0]=$ret_id;
					$data[1]=$ret_part_name;
					$data[2]=$ret_compatible_with;
					$data[3]=$ret_discription;
					$data[4]=$ret_city;
					$data[5]=$ret_image;
					$data[6]=$ret_price;
					$data[7]=$ret_mobile1;
					$data[8]=$ret_mobile2;
					$data[9]=$ret_reg_no;
					$data[10]=$ret_date;
					$data[11]=$ret_time;
					
				}
				if(!empty($data))
				{
					return $data;
				}
				return false;

	        }
       }

	}

	function delete_mycrop_record($var_delete_id)
	{
		if($stmt = $this->con->prepare("DELETE FROM `crop` WHERE `id`=?"))
		{
			$stmt->bind_param("i",$var_delete_id);
			
			if($stmt->execute())
			{
				return true;
			}
			return false;
		}
	}

	function save_Edit_crop($crop_name,$crop_variety,$crop_quantity,$file_name,$crop_price,$ph_no1,$ph_no2,$reg_no,$var_edit_id)
	{
		$date = date("Y-m-d");
		$time = date("h:i:s a");
	
		if($stmt=$this->con->prepare("UPDATE `crop` SET `crop_name`=?,`variety_of_crop`=?,`quantity`=?,`image`=?,`expected_price`=?,`ph_number_1`=?,`ph_number_2`=?,`reg_no`=?,`date`=?,`time`=? WHERE `id`=?"))
	
		{
			
			$stmt->bind_param("sssssssssss",$crop_name,$crop_variety,$crop_quantity,$file_name,$crop_price,$ph_no1,$ph_no2,$reg_no,$date,$time,$var_edit_id);

			if($stmt->execute())
			{
				return true;
			}

			return false;
		}

	}

	function get_mycrop_data_id($var_edit_id)
	{

		if($stmt=$this->con->prepare("SELECT  `id`,`crop_name`, `variety_of_crop`, `quantity`, `image`, `expected_price`, `ph_number_1`, `ph_number_2`, `reg_no`, `date`, `time` FROM `crop` WHERE `id`=?"))
		{
			$stmt->bind_param("i",$var_edit_id);
			$stmt->bind_result($ret_id,$ret_crop_name,$ret_variety,$ret_quantity,$ret_image,$ret_expected_price,$ret_mobile1,$ret_mobile2,$ret_reg_no,$ret_date,$ret_time);
			if($stmt->execute())
			{
				$data=array();
				
				while($stmt->fetch())
				{
					$data[0]=$ret_id;
					$data[1]=$ret_crop_name;
					$data[2]=$ret_variety;
					$data[3]=$ret_quantity;
					$data[4]=$ret_image;
					$data[5]=$ret_expected_price;
					$data[6]=$ret_mobile1;
					$data[7]=$ret_mobile2;
					$data[8]=$ret_reg_no;
					$data[9]=$ret_date;
					$data[10]=$ret_time;

					
				}
				if(!empty($data))
				{
					return $data;
				}
				return false;
			}
		}
		

	}


	function delete_mytractor_record($var_delete_id)
 
	{
	   if($stmt = $this->con->prepare("DELETE FROM `tractor_rent` WHERE `id`=?"))
		   {
			   $stmt->bind_param("i",$var_delete_id);
			   
			   if($stmt->execute())
			   {
				   return true;
			   }
			   return false;
		   }
	}

	function save_edit_tractor($tractor_company,$tractor_model,$tractor_type,$tractor_no,$driver,$expected_price,$image,$city,$phone_no1,$phone_no2,$reg_no,$var_edit_id)
	{
		$date = date("Y-m-d");
		$time = date("h:i:s a");
		if($stmt=$this->con->prepare("UPDATE `tractor_rent` SET `tractor_company_name`=?,`tractorModel_name`=?,`tractor_type`=?,`tractor_no`=?,`driver`=?,`price_range`=?,`image`=?,`city`=?,`ph_no1`=?,`ph_no2`=?,`reg_no`=?,`date`=?,`time`=? WHERE `id`=?"))
		{
			$stmt->bind_param("ssssssssssssss",$tractor_company,$tractor_model,$tractor_type,$tractor_no,$driver,$expected_price,$image,$city,$phone_no1,$phone_no2,$reg_no,$date,$time,$var_edit_id);
			if($stmt->execute())
			{
			return true;
		    }	
			return false;
		}
	}

	function get_mytractor_data_id($var_edit_id)
	{
		if($stmt=$this->con->prepare("SELECT `id`, `tractor_company_name`, `tractorModel_name`, `tractor_type`, `tractor_no`, `driver`, `price_range`, `image`, `city`, `ph_no1`, `ph_no2`, `reg_no`, `date`, `time` FROM `tractor_rent` WHERE `id`=?"))
		{
			$stmt->bind_param("i",$var_edit_id);
			$stmt->bind_result($ret_id,$ret_tractor_company,$ret_tractor_model,$ret_tractor_type,$ret_tractor_no,$ret_driver,$ret_price_range,$ret_image,$ret_city,$ret_mobile1,$ret_mobile2,$ret_reg_no,$ret_date,$ret_time);
			if($stmt->execute())
			{
				
				$data=array();
				while($stmt->fetch())
				{
					$data[0]=$ret_id;
					$data[1]=$ret_tractor_company;
					$data[2]=$ret_tractor_model;
					$data[3]=$ret_tractor_type;
					$data[4]=$ret_tractor_no;
					$data[5]=$ret_driver;
					$data[6]=$ret_price_range;
					$data[7]=$ret_image;
					$data[8]=$ret_city;
					$data[9]=$ret_mobile1;
					$data[10]=$ret_mobile2;
					$data[11]=$ret_reg_no;
					$data[12]=$ret_date;
					$data[13]=$ret_time;

					
				}
				if(!empty($data))
				{
					return $data;
				}
				return false;

			}
		}

	}


}//end