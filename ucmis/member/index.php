<?php
include("../php-classes/department.php");
include("../php-classes/member.php");
session_start();
$dept=new department();
$member = new Member();
$department_data=$dept->departments();
$result=0;
$first_name="";
$last_name="";
$email="";
$phone="";
$emp_id="";
$member_number="";
$dept_code="";
$emp_status="";
$city="";
$dob="";
$dom="";
$dor="";
$designation="";
if($_SERVER['REQUEST_METHOD'] == 'POST'){
  if(isset($_SESSION['last'])&&($_SESSION['last']==$_POST)){
    $result=0;
  }
  else{
    $first_name=trim($_POST["FirstName"]);
    $last_name=trim($_POST["LastName"]);
    $email=trim($_POST["Email"]);
    $phone=trim($_POST["Phone"]);
    $emp_id=trim($_POST["EmployeeId"]);
    $member_number=trim($_POST["MemberNumber"]);
    $dept_code=trim($_POST["DeptCode"]);
    $designation=trim($_POST['Designation']);
    $emp_status=trim($_POST["EmployeeStatus"]);
    $city=trim($_POST["City"]);
    $dob=trim($_POST["DateOfBirth"]);
    $dom=trim($_POST["DateOfMarriage"]);
    $dor=trim($_POST['DateOfRetire']);
    if(is_null($first_name)||is_null($phone)||is_null($emp_id)||is_null($member_number)||is_null($dept_code)||is_null($emp_status)){
      $result=0;
    }
    else{
    $img_path=$member->img_uploading("ProfilePicture",$emp_id);
    if($img_path==2||$img_path==3||$img_path==4){
      $result=6;
    }
    else{
      if($img_path===0){
        $img_path="../profile_pictures/default.png";
      }
      $result=$member->employee_add($first_name,$last_name,$email,$phone,$emp_id,$member_number,$dept_code,$designation,$emp_status,$city,$dob,$dom,$dor,$img_path);
    }
  }
  $_SESSION['last']=$_POST;
 }

}
 ?>
<!DOCTYPE html>
<html >
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
                    <h1>UCMIS</h1>
  									<p>Ukku Club Members Information System</p>
                </div>
                <div class="col-sm-3 col-lg-3">
                   <h3 class="text-info" id="date"></h3>
                </div>
            </div>
        </div>
    </section>

    <div class="lg-container">
    <h1>Member Registration</h1>
    <center><img class="profile" id='output'></center>
    <p class="message">fields contains * are mandatory</p>
    <hr class="hr-set">
      <form action="index.php" method="post" enctype="multipart/form-data" id="lg-form">
          <div class="error">
            <?php
            if($result==0)
              echo "";
            elseif ($result==2||$result==3||$result==4) {
             header("Location:../database_error.php");
            }
            else if($result==5){
              echo "Invalid EmployeeId or MemberNumber";
            }
            else if($result==6){
              if($img_path==3){
                echo "file size is very large";
              }
              else if($img_path==4){
                echo "something went wrong with uploaded file please upload another file.";
              }
            }
             ?>
          </div>
          <p class="success">
            <?php if($result==1)
            echo "member registered successfully"; ?>
         </p>
         <div class="row col-sm-12 col-lg-12">
        <div class="col-sm-6">
          <label for="firstname">First Name: *</label>
          <input type="text" id="firstname" name="FirstName" value="<?php if($result!=1) echo $first_name; ?>" required>

            <label for="empid">Employee ID: *</label>
            <input type="text" id="empid" name="EmployeeId" value="<?php if($result!=1) echo $emp_id; ?>" required>

           <label for="deptcode">Department Code: *</label>
           <select name=DeptCode id="deptcode" value="<?php if($result!=1) echo $dept_code; ?>" required>
             <?php
                foreach ($department_data as  $value) {
                  echo "<option value='".$value['code']."'>".$value['name']."(".$value['code'].")"."</option>";
                }
             ?>
           </select>
          <label for="phone">Phone: </label>
          <input type="text" id="phone" name="Phone" value="<?php if($result!=1) echo $phone; ?>">

          <label for="city">City:</label>
            <input type="text" id="city" name="City" value="<?php if($result!=1) echo $city; ?>" >

            <label for="dateofbirth">Enter Your Date Of Birth:</label>
          <input type="date" id="dateofbirth" name="DateOfBirth" value="<?php if($result!=1) echo $dob; ?>">

          <label for="dateofretire">Enter Your Date Of Retirement:</label>
        <input type="date" id="dateofretire" name="DateOfRetire" value="<?php if($result!=1) echo $dor; ?>">

          </div>
          <div class="col-lg-6 col-sm-6">

            <label for="lastname">Last Name: </label>
            <input type="text" id="lastname" name="LastName" value="<?php if($result!=1) echo $last_name; ?>">

            <label for="membernumber">Member Number: *</label>
            <input type="text" id="membernumber" name="MemberNumber" value="<?php if($result!=1) echo $member_number; ?>"required>

            <label for="empstatus">Employee Status:</label>
            <select name="EmployeeStatus" id="empstatus" value="<?php if($result!=1) echo $emp_status?>">
            <option value="Active(On Rolls)">Active(On Rolls)</option>
            <option value="Retired and On Rolls">Retired and On Rolls</option>
            <option value="Not On rolls">Not On Rolls</option>
          </select>

          <label for="mail">Email:</label>
          <input type="email" id="mail" name="Email" value="<?php if($result!=1) echo $email; ?>">

          <label for="designation">Designation: </label>
          <input type="text" id="designation" name="Designation" value="<?php if($result!=1) echo $designation; ?>">

          <label for="profilepic">Choose Your Profile Picture:</label>
          <input type="file" id="profilepic" accept="image/*"name="ProfilePicture" onchange="loadFile(event)">

          <label for="dateofMarriage">Enter Your Date Of Marriage:</label>
          <input type="date" id="dateofmarriage" name="DateOfMarriage" value="<?php if($result!=1) echo $dom; ?>">

        </div>
        </div>
        <center>
        <button type="submit" id="register">ADD</button>
        <button type="reset" id="reset">Reset</button>
        <button  id="back" onclick="window.location='../index.html'">Back</button>
        <button  id="next" onclick="window.location='modify.php'">Modify</button>
      </center>
      </form>
    </div>
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
