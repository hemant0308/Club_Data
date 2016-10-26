<?php

	//Defining class Department.It contains all the operations to perform on department database
	class Department{

		// first function to add new department into our database..

		function department_add($dept_code,$dept_name){

		$user_name="employee";
		$serv_name="localhost";
		$password="employee";
		$dbname="club_data";
		$tablename="department_data";

		$connect=mysql_connect($serv_name,$user_name,$password);  //create connection
		if(!($connect)){               							  //if connection is not success return 2
			mysql_close($connect);
			return 2;
		}
		if(!(mysql_select_db($dbname))){						//select our database
			mysql_close($connect);
			return 3;											//if there is problem with selecting database then return 3
		}
		$search_query ="SELECT COUNT(*) FROM $tablename WHERE Department_Code='$dept_code'";		//check if the department is alredy existed or not
		if($result = mysql_query($search_query,$connect)){
			$row=mysql_fetch_array($result);
			if($row[0]!=0){
				mysql_free_result($result);
				mysql_close($connect);
				return 0;																		// if the department is alredy existed then return 0
			}
		}

		$insertion_query="INSERT INTO $tablename(Department_Code,Department_Name) VALUES ('$dept_code','$dept_name');";

		  															//query to insert all department data into our database..
		if(!(mysql_query($insertion_query,$connect))){						//query execution
			mysql_close($connect);
			return 4;												//return 4 if there is problem in execution
		}
		else{
			mysql_close($connect);
			return 1;												//success indication return 1
		}
	}

	//function to search department in our database based on the given department code..it returns all the employees in our database which are belongs to given department code
	function department_search($dept_code){
		$user_name="employee";
		$serv_name="localhost";
		$password="employee";
		$dbname="club_data";
		$dept_table="department_data";
		$emp_table="employee_data";
		$connect=mysql_connect($serv_name,$user_name,$password);  //create connection
		if(!($connect)){               							  //if connection is not success return 2
			mysql_close($connect);
			return 2;
		}
		if(!(mysql_select_db($dbname))){						//select our database
			mysql_close($connect);
			return 3;											//if there is problem then return 3
		}
		$query="SELECT COUNT(*) FROM $dept_table WHERE Department_Code = '$dept_code';";	 //our query to check if database exist or not
		$result=mysql_query($query,$connect);
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
		$emp_query="SELECT Employee_ID,Member_Number,First_Name,Last_Name,Profile_Picture FROM $emp_table WHERE Department_Code='$dept_code';";	//query to retrieve employees data with the given department code
		$dept_query="SELECT Department_Name FROM $dept_table WHERE Department_Code='$dept_code';";	// query to retrieve the department details
		$dept_result=mysql_query($dept_query,$connect);
		$emp_result=mysql_query($emp_query,$connect);
		if(!(($emp_result)||($dept_result))){				//check for query executuion
			mysql_free_result($dept_result);
			mysql_free_result($emp_result);
			mysql_close($connect);
      echo "$emp_query";
      echo "$dept_query";
			return 4;										//return 4 if there is any problem in our queries exectuion
		}
		$emp_row=array();
		while($temp=mysql_fetch_row($emp_result)){			//fetch data as row
			array_push($emp_row,$temp);									//push the all data arrays into our emp_row
		}
		$dept_row=array();
		while($temp=mysql_fetch_row($dept_result)){			//fetch department data as row
			array_push($dept_row, $temp[0]);						//push the all data arrays into our department_row
		}
    mysql_close($connect);
		$search_result = array('employees' => $emp_row,'department'=>$dept_row );		//create an array .it contains the both emp_row array and dept_row array with keys employees and departments
		return $search_result;		//return the resultant array
	}
	function department_modify($dept_code,$new_code,$new_name){
		$user_name="employee";
		$serv_name="localhost";
		$password="employee";
		$dbname="club_data";
		$dept_table="department_data";
		$emp_table='employee_data';
		$connect=mysql_connect($serv_name,$user_name,$password);  //create connection
		if(!($connect)){               							  //if connection is not success return 2
			mysql_close($connect);
			return 2;
		}
		if(!(mysql_select_db($dbname))){						//select our database
			mysql_close($connect);
			return 3;											//if there is problem then return 3
		}
		$query="SELECT COUNT(*) FROM $dept_table WHERE Department_Code='$new_code' and (NOT Department_Code='$dept_code')";
		$result=mysql_query($query,$connect);
		if($result){
			$row=mysql_fetch_array($result);
			if($row[0]!=0){
				return 5;
			}
		}
		$dept_query="UPDATE $dept_table SET Department_Code='$new_code',Department_Name='$new_name' WHERE Department_Code='$dept_code';";
		$emp_query="UPDATE $emp_table SET Department_Code='$new_code' WHERE Department_code='$dept_code';";
		if(mysql_query($dept_query,$connect)&mysql_query($emp_query,$connect)){
			return 1;
		}
		else{
			return 0;
		}
	}
	function department_remove($dept_code){
		$user_name="employee";
		$serv_name="localhost";
		$password="employee";
		$dbname="club_data";
		$dept_table="department_data";
		$emp_table="employee_data";
		$connect=mysql_connect($serv_name,$user_name,$password);  //create connection
		if(!($connect)){               							  //if connection is not success return 2
			mysql_close($connect);
			return 2;
		}
		if(!(mysql_select_db($dbname))){						//select our database
			mysql_close($connect);
			return 3;											//if there is problem then return 3
		}
		$query="SELECT COUNT(*) FROM $dept_table WHERE Department_Code = '$dept_code';";	 //our query to check if database exist or not
		$result=mysql_query($query,$connect);
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
		$query="SELECT Profile_Picture FROM $emp_table WHERE Department_Code='$dept_code';";
		$res=mysql_query($query);
		$row=mysql_fetch_row($res);
		foreach ($row as $value) {
			if($value!="../profile_pictures/default.png"){
				unlink($value);
			}
		}
		$emp_query="DELETE FROM $emp_table WHERE Department_Code='$dept_code';";
		if(!(mysql_query($emp_query,$connect))){
			return 4;
		}
		$query="DELETE FROM $dept_table WHERE Department_Code='$dept_code';";
				if(!(mysql_query($query,$connect))){
					mysql_close($connect);
					return 4;														//if there is problem in executing our query then return 4
				}
				else{
					return 1;														//finally return 0 when we delete data successfully with deptcode.
				}
	}
	function departments(){
		$user_name="employee";
		$serv_name="localhost";
		$password="employee";
		$dbname="club_data";
		$dept_table="department_data";
		$connect=mysql_connect($serv_name,$user_name,$password);  //create connection
		if(!($connect)){               							  //if connection is not success return 2
			mysql_close($connect);
			return 2;
		}
		if(!(mysql_select_db($dbname))){						//select our database
			mysql_close($connect);
			return 3;											//if there is problem then return 3
		}
		$query="SELECT Department_Name,Department_Code FROM $dept_table;";
		$departments_data=array();
		if($result=mysql_query($query,$connect)){
			while($row=mysql_fetch_array($result)){
				 $arrayName = array('name' => $row[0],'code' => $row[1] );
				array_push($departments_data,$arrayName);
			}
		}
		return $departments_data;
	}
}

//end of the class
?>
