<?php
class Report{
  function report_display($status){
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
			return 3;											//if there is problem with selecting database then return 3
		}
    if($status==1){
      $query="SELECT Employee_Id,First_Name,Last_Name,Member_Number,Employee_Status,Department_Code FROM $tablename WHERE 1=1;";
        $all=array();
      if($res=mysql_query($query,$connect)){
        while($temp=mysql_fetch_array($res)){
          array_push($all,$temp);
        }
      }
      return $all;
    }
    else if($status==2){
      $query="SELECT Employee_Id,First_Name,Last_Name,Member_Number,Employee_Status,Department_Code FROM $tablename WHERE 1=1;";
      $all=array();
      if($res=mysql_query($query,$connect)){
        while($temp=mysql_fetch_array($res)){
          array_push($all,$temp);
        }
      }
      return $all;
    }
    else if($status==3){
    $query="SELECT Employee_Id,First_Name,Last_Name,Member_Number,Employee_Status,Department_Code FROM $tablename WHERE 1=1;";        $all=array();
      if($res=mysql_query($query,$connect)){
        while($temp=mysql_fetch_array($res)){
          array_push($all,$temp);
        }
      }
      return $all;
    }
    else if($status==4){
      $query="SELECT Employee_Id,First_Name,Last_Name,Member_Number,Employee_Status,Department_Code FROM $tablename WHERE 1=1;";        $all=array();
      if($res=mysql_query($query,$connect)){
        while($temp=mysql_fetch_array($res)){
          array_push($all,$temp);
        }
      }
      return $all;
    }
    else{
      $all=array();
      return $all;
    }
  }
}

 ?>
