<?php
session_start();
include("../php-classes/department.php");
include("../php-classes/member.php");
$dept=new department();
$member = new Member();
$department_data=$dept->departments();
$modify=-1;
$result=-1;
$remove=-1;
if($_SERVER['REQUEST_METHOD'] == 'POST'){
  if(count($_POST)==1){
   $emp_id=trim($_POST['EmployeeId']);
   $result=$member->employee_search($emp_id);
   $_SESSION['last']=$emp_id;
 }
 else if(count($_POST)==14){
   if($_POST['submit']=='remove'){
     $key=$_SESSION['last'];
     $remove=$member->employee_remove($key);
   }
   else if($_POST['submit']=='modify'){
     $first_name=trim($_POST["FirstName"]);
     $last_name=trim($_POST["LastName"]);
     $email=trim($_POST["Email"]);
     $phone=trim($_POST["Phone"]);
     $emp_id=trim($_POST["EmployeeId"]);
     $member_number=trim($_POST["MemberNumber"]);
     $dept_code=trim($_POST["DeptCode"]);
     $designation=trim($_POST["Designation"]);
     $emp_status=trim($_POST["EmployeeStatus"]);
     $city=trim($_POST["City"]);
     $dob=trim($_POST["DateOfBirth"]);
     $dom=trim($_POST["DateOfMarriage"]);
     $dor=trim($_POST['DateOfRetire']);
     $img_path=$member->img_uploading("ProfilePicture",$emp_id);
     $key=$_SESSION['last'];
     if($img_path==3||$img_path==4){
       $modify=6;
      $result=$member->employee_search($key);
     }
     else{
     if($img_path===0){
         $img_path=$member->last_img_path($emp_id);
       }
     $modify=$member->employee_modify($key,$first_name,$last_name,$member_number,$emp_id,$emp_status,$dept_code,$designation,$phone,$email,$city,$dob,$dom,$dor,$img_path);
     if($modify!=1){
       $result=$member->employee_search($key);
       $_SESSION['last']=$key;
     }
     else{
       $result=$member->employee_search($emp_id);
       $_SESSION['last']=$emp_id;
     }
    }
   }
 }
}
 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Add new employee</title>
          <link rel="stylesheet" href="../css/bootstrap.css">
          <link href="../css/style.css" rel="stylesheet" />
          <link rel="stylesheet" href="../css/form_style.css">

  </head>
    <body>

       <section id="home-sec">
        <div class="overlay text-center">
            <div class="col-sm-12 col-lg-12">
                <div class="col-sm-3 col-lg-3">
                    <img src="../images/steel_plant_logo.png" alt="steel_plant_logo" id="logo" onclick="window.location='../index.html'">
                </div>
                <div class="col-sm-6 col-lg-6">
                    <h1 id="header" onclick="window.location='../index.html'" >UCMIS</h1>
                </div>
                <div class="col-sm-3 col-lg-3">
                   <h3 class="text-info" id="date"></h3>
                </div>
            </div>
        </div>
    </section>
      <?php
      if($remove==1){
        header("Location:modify.php");
      }
      if($modify==-1&$result==-1){
        header("Location:modify.php");
      }
        if($result==0){
          header("Location:modify_error.php");
        }
        if($result==2||$result==3||$result==4||$remove==2||$remove==3||$remove==4){
          header("Location:../database_error.php");
        }
        else {
            $first_name=$result[0];
            $last_name=$result[1];
            $member_number=$result[2];
            $emp_id=$result[3];
            $emp_status=$result[4];
            $dept_code=$result[5];
            $designation=$result[6];
            $phone=$result[7];
            $email=$result[8];
            $city=$result[9];
            $dob=$result[10];
            $dom=$result[11];
            $dor=$result[12];
            $pic=$result[13];
            $_SESSION['last']=$emp_id;
          echo "<div class='lg-container'>
          <h1>Member Details</h1>
          <center><img src='$pic' class='profile' id='display'></center>
          <p class='message'>fields contains * are mandatory</p>
          <hr class='hr-set'>";
          if ($modify==-1) {
          }
          else if($modify==1){
            echo "<p class='success'>Data updated successfully</p>";
          }
          else if($modify==6){
            echo "<p class='error'>there is a problem with ur image</p>";
          }
          else if($modify==5){
              echo "<p class='error'>Invalid employee id or membernumber</p>";
          }
          else{
              echo "<p class='error'>something was wrong please try again</p>";
          }
          echo"<form action='display.php' method='post' enctype='multipart/form-data' id='lg-form'>
               <div class='row col-sm-12 col-lg-12'>
              <div class='col-sm-6'>
                <label for='firstname'>First Name: *</label>
                <input type='text' id='firstname' name='FirstName' value='$first_name' required>

                  <label for='empid'>Employee ID: *</label>
                  <input type='text' id='empid' name='EmployeeId' value=' $emp_id' required>

                 <label for='deptcode'>Department Code: *</label>
                 <select name=DeptCode id='deptcode' value='$dept_code' required>";
                      foreach ($department_data as  $value) {
                      echo "<option value='".$value['code']."'".'>'.$value['name'].'('.$value['code'].')'.'</option>';
                      }

                echo " </select>
                <label for='phone'>Phone: </label>
                <input type='text' id='phone' name='Phone' value='$phone' >

                <label for='city'>City:</label>
                  <input type='text' id='city' name='City' value=' $city' >

                  <label for='dateofbirth'>Enter Your Date Of Birth:</label>
                <input type='date' id='dateofbirth' name='DateOfBirth' value='$dob'>

                <label for='dateofretire'>Enter Your Date Of Retirement:</label>
              <input type='date' id='dateofretire' name='DateOfRetire' value='$dor'>

                </div>
                <div class='col-lg-6 col-sm-6'>

                  <label for='lastname'>Last Name: </label>
                  <input type='text' id='lastname' name='LastName' value='$last_name'>

                  <label for='membernumber'>Member Number: *</label>
                  <input type='text' id='membernumber' name='MemberNumber' value='$member_number' required>

                  <label for='empstatus'>Employee Status:</label>
                  <select name='EmployeeStatus' id='empstatus' value='$emp_status'>
                  <option value='Active(On Rolls)'>Active(On Rolls)</option>
                  <option value='Retired and On Rolls'>Retired and On Rolls</option>
                  <option value='Not On rolls'>Not On Rolls</option>
                </select>

                <label for='mail'>Email:</label>
                <input type='email' id='mail' name='Email' value='$email'>

                <label for='designation'>Designation: </label>
                <input type='text' id='designation' name='Designation' value='$designation'>


                <label for='profilepic'>Choose Your Profile Picture:</label>
                <input type='file' id='profilepic' accept='image/*'name='ProfilePicture' onchange='loadImg(event)'>

                <label for='dateofMarriage'>Enter Your Date Of Marriage:</label>
                <input type='date' id='dateofmarriage' name='DateOfMarriage' value='$dom'>

              </div>
              </div>
              <center>
              <button type='submit' name='submit' value='modify'>Save</button>
              <button type='reset' id='reset'>Reset</button>
              <button  id='back' type='button' onclick=\"window.location='index.php'\">Back</button>
              <button name='submit' type='submit' value='remove' onclick=\"if(!confirm('Do You Really Want to delete Employee with ".$_SESSION['last']."  EmployeeID.' )) return false;\">Remove</button>
            </center>
            </form>
          </div>";
        }
      ?>
    <!--bottom text-->
    <div class="copy-txt">
        <div class="container">
        <div class="row">
          <div class="col-md-12 set-foot" >
            &copy 2016 UCMIS | All rights reserved | Design by :
          </div>
         </div>
         </div>
    </div>
    <!--auto update time-->
    <script type="text/javascript" src="../js/date.js"></script>
    <script type="text/javascript" src="../js/image_preview.js"></script>
    </body>
</html>
