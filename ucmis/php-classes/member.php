<?php

	// declaring class User.It contains function to operate data of employees
class Member{

	//register new user.and add this user to our database...
	function employee_add($first_name,$last_name,$email,$phone,$emp_id,$member_number,$dept_code,$designation,$emp_status,$city,$dob,$dom,$dor,$profile_picture){
		$user_name="employee";
		$serv_name="localhost";
		$password="employee";
		$dbname="club_data";
		$emp_table="employee_data";
		$dept_table="department_data";
		$connect=mysql_connect($serv_name,$user_name,$password);  //create connection
		if(!($connect)){               							  //if connection is not success return 2
			mysql_close($connect);
			return 2;
		}
		if(!(mysql_select_db($dbname))){						//select our database
			mysql_close($connect);
			return 3;											//if there is problem with selecting database then return 3
		}
		$search_query ="SELECT COUNT(*) FROM $emp_table WHERE Employee_ID='$emp_id' OR Member_Number='$member_number';"; //check if the employee is alredy registered or not

		if($result = mysql_query($search_query,$connect)){
			$row=mysql_fetch_row($result);
			if($row[0]!=0){
				mysql_free_result($result);
				mysql_close($connect);
				return 5;														//return 0 if the employee is alredy existed with given employee id or membernumber
			}
		}
		$insertion_query="INSERT INTO $emp_table(First_Name,Last_Name,Member_Number,Employee_ID,Employee_Status,Department_Code,Designation,Phone_Number,Email,City,Profile_Picture,Date_Of_Birth,Date_of_Marriage,Date_Of_Retire) VALUES ('$first_name','$last_name','$member_number','$emp_id','$emp_status','$dept_code','$designation','$phone','$email','$city','$profile_picture','$dob','$dom','$dor');";
		  							//query to insert all user data into our database..
		if(!(mysql_query($insertion_query,$connect))){						//query execution
			mysql_close($connect);
			return 4;												//return 4 if there is problem in execution
		}
		else{
			mysql_close($connect);
			return 1;												//if the data is successfully inserted.success indication return 1
		}
	}

	// function to check if uploading image is perfectly uploaded or not...and return image path of the uploaded image
	function img_uploading($img_file_name,$emp_id){
					if (!is_uploaded_file($_FILES[$img_file_name]['tmp_name'])){
						return 0;
					}
	        $image_path="../profile_pictures/";                                                 //images are saved in this directory
	        $image_ext=pathinfo($_FILES[$img_file_name]["name"],PATHINFO_EXTENSION);          //pathinfo function returns the extension of the given path file
          /*if($image_ext!="img" && $image_ext!="png" && $image_ext!="jpg" && $image_ext!="jpeg"){            //check for extension
	                return 2;                                                                           //if given file is not an image then return 2
	            }*/
	        if($_FILES[$img_file_name]['size']>50000000){
						return 3;
					}
	      /*  $rand_file = "";                                                                    //file name in our database generated randomly to clear conflicts
	                                                                                            //between file which have a same name
	        $alphabets=array();
	        $alphabets=str_split("ABCDEFGHIJKLMNOPQRSTUVWXYZ");
	        for ($i=0; $i < 10; $i++) {
	            $rand_file=$rand_file.$alphabets[rand(0,25)];                                    //generate random file name with alphabets..file name size is 10
						}*/
	        $image_path.=$emp_id.".".$image_ext;                                             //add generated random file_name to our path.
	        if(!move_uploaded_file($_FILES[$img_file_name]["tmp_name"],$image_path)){         //move uploaded file into our image path which we generated randomly..
	              return 4;                                                                    //return 4 if there is an uploaded error..
	            }
	        return $image_path;                                                                   // if all goes well return the uploaded image path on our server..
	  }
function last_img_path($emp_id){
	$user_name="employee";
	$serv_name="localhost";
	$password="employee";
	$dbname="club_data";
	$tablename="employee_data";
	$connect=mysql_connect($serv_name,$user_name,$password);  //create connection
	if(!($connect)){               							  //if connection is not success return 2
		mysql_close($connect);
		return 2;
	}
	if(!(mysql_select_db($dbname))){						//select our database
		mysql_close($connect);
		return 3;											//if there is problem then return 3
	}
	$query="SELECT Profile_Picture FROM $tablename WHERE Employee_ID='$emp_id';";
	if($result=mysql_query($query)){
		$row=mysql_fetch_row($result);
		return $row[0];
	}
	return 4;
}
function employee_modify($key,$first_name,$last_name,$member_number,$emp_id,$emp_status,$dept_code,$designation,$phone,$email,$city,$dob,$dom,$dor,$pic){
  $user_name="employee";
  $serv_name="localhost";
  $password="employee";
  $dbname="club_data";
  $tablename="employee_data";
  $connect=mysql_connect($serv_name,$user_name,$password);  //create connection
  if(!($connect)){               							  //if connection is not success return 2
    mysql_close($connect);
    return 2;
  }
  if(!(mysql_select_db($dbname))){						//select our database
    mysql_close($connect);
    return 3;											//if there is problem then return 3
  }
  $search_query ="SELECT COUNT(*) FROM $tablename WHERE (Employee_ID='$emp_id' AND (NOT Employee_ID='$key'));"; //check if the employee is alredy registered or not
  if($result = mysql_query($search_query,$connect)){
    $row=mysql_fetch_row($result);
    if($row[0]!=0){
      mysql_free_result($result);
      mysql_close($connect);
      return 5;														//return 0 if the employee is alredy existed with given employee id or membernumber
    }
  }
  $query="UPDATE $tablename SET First_Name='$first_name',Last_Name='$last_name',Member_Number='$member_number',Employee_ID='$emp_id',Employee_Status='$emp_status',Department_Code='$dept_code',Designation='$designation',Phone_Number='$phone',Email='$email',City='$city',Date_Of_Birth='$dob',Date_Of_Marriage='$dom',Date_Of_Retire='$dor',Profile_Picture='$pic' WHERE Employee_ID='$key'";
  #echo "$query";
  if(mysql_query($query,$connect)){
    return 1;
  }
  else{
    return 0;
  }
}

	// this function used to fetch one row based on given employee id.....

	function employee_search($empid){
		$user_name="employee";
		$serv_name="localhost";
		$password="employee";
		$dbname="club_data";
		$tablename="employee_data";
		$connect=mysql_connect($serv_name,$user_name,$password);  //create connection
		if(!($connect)){               							  //if connection is not success return 2
			mysql_close($connect);
			return 2;
		}
		if(!(mysql_select_db($dbname))){						//select our database
			mysql_close($connect);
			return 3;											//if there is problem then return 3
		}
		$query="SELECT COUNT(*) FROM $tablename WHERE Employee_ID = '$empid';";	 //our query to check if database exist or not
		$result=mysql_query($query,$connect);
    //echo "$query";
		if (!$result) {						//check for query execution
			mysql_close($connect);
			return 4;														//if fail return 4
		}
			$row=mysql_fetch_array($result); 								//fetch count as array
			 if($row[0]==0){												// if count is 0 then no data found so we return 0.
			 	mysql_free_result($result);									//free the result and close the connection
			 	mysql_close($connect);
			 	return 0;
			 }
		mysql_free_result($result);
		$query="SELECT * FROM $tablename WHERE Employee_ID='$empid'; ";		//if we found the data then we fetch it by this query
		$result=mysql_query($query);
		$row=mysql_fetch_array($result);									// fetch as array
		mysql_free_result($result);
		mysql_close($connect);
		return $row;														//return the array with returned data..

	}

	// this function is used to remove employee from our database based on the given employee id
	function employee_remove($empid){
		$user_name="employee";
		$serv_name="localhost";
		$password="employee";
		$dbname="club_data";
		$tablename="employee_data";
		$connect=mysql_connect($serv_name,$user_name,$password);  //create connection
		if(!($connect)){               							  //if connection is not success return 2
			mysql_close($connect);
			return 2;
		}
		if(!(mysql_select_db($dbname))){						//select our database
			mysql_close($connect);
			return 3;											//if there is problem then return 3
		}
				$pic_query="SELECT Profile_Picture FROM $tablename WHERE Employee_ID='$empid';";
				if($result=mysql_query($pic_query)){
					$row=mysql_fetch_row($result);
					$profile_picture=$row[0];
					if($profile_picture!="../profile_pictures/default.png"){
					unlink($profile_picture);
				}
				}
				$query="DELETE FROM $tablename WHERE Employee_ID='$empid';";		//if founr delete data with empid
				if(!(mysql_query($query,$connect))){
					mysql_close($connect);
					return 4;														//if there is problem in executing our query then return 4
				}
				else{
					return 1;														//finally return 1 when we delete data successfully with empid.
				}
	}

}
?>
