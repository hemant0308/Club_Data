-<?php
session_start();
include("../php-classes/department.php");
$dept=new Department();
$check=0;
$remove=-1;
if($_SERVER['REQUEST_METHOD']=='POST'){
    if(count($_POST)==3){
      if($_POST['submit']=='remove'){
          $remove=$dept->department_remove($_SESSION['last']);
      }
      else if($_POST['submit']=='modify'){
      $dept_code=trim($_POST['DeptCode']);
      $dept_name=trim($_POST['DeptName']);
      $key=$_SESSION['last'];
      $modify=$dept->department_modify($key,$dept_code,$dept_name);
      $res=$dept->department_search($dept_code);
      $_SESSION['last']=$dept_code;
    }
    else{

    }
      $check=2;
  }
   else if(count($_POST)==1){
     $dept_code=trim($_POST['DeptCode']);
     $res=$dept->department_search($dept_code);
     $_SESSION['last']=$dept_code;
     $check=1;
   }
}
else{
  header("Location:dept_search.php");
}
 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title>Department</title>
   <title>Department</title>
   <!-- BOOTSTRAP CORE STYLE CSS -->
   <link href="../css/bootstrap.css" rel="stylesheet" />
   <!-- CUSTOM STYLE CSS -->
   <link href="../css/style.css" rel="stylesheet" />
   <link rel="stylesheet" href="../css/search_style.css">
   <link rel="stylesheet" href="../css/form_style.css">
 </head>
 <body>
   <!--  This section Describes the Home section of page  -->
   <section id="home-sec">
       <div class="overlay text-center">
           <div class="col-sm-12 col-lg-12">
               <div class="col-sm-3 col-lg-3">
                   <img src="../images/steel_plant_logo.png" alt="steel_plant_logo" id="logo">
               </div>
               <div class="col-sm-6 col-lg-6">
                   <h1 >UCMIS</h1>
 									<p>Ukku Club Members Information System</p>
               </div>
               <div class="col-sm-3 col-lg-3 date">
                  <h3  id="date"></h3>
               </div>
           </div>
       </div>
   </section>
   <!--  End home section  -->
   <?php
    if($check==1){
      if($res===0){
        header("Location:dept_search_error.php");
      }
      else if($res==2||$res==3||$res==4){
        header("Location:../database_error.php");
      }
      else{
        echo "<div class='lg-container'>
         <h1>Modify Department</h1>
         <hr class='hr-set'>";
         echo "<div class='error'></div>";
        echo "<form action='display.php' method='post' enctype='multipart/form-data' id='lg-form'>
            <label for='deptcode'>Department Code:</label>
            <input type='text' id='deptcode' name='DeptCode' value='$dept_code' required>
            <label for='deptcode'>Department Code:</label>
            <input type='text' id='deptcode' name='DeptName' value='".$res['department'][0]."' required>
           <center>
             <button type='submit' name='submit' value='modify'>Modify</button>
             <button type='reset' id='reset'>Reset</button>
             <button  id='back' type='button'  onclick=\"window.location='index.php'\">Back</button>
             <button name='submit' type='submit' value='remove' onclick=\"if(!confirm('Do You Really Want to delete ".$res['department'][0]."  Department.It will Delete ".count($res['employees'])."  employees' )) return false;\">Remove</button>
           </center>
        </form>
      </div>";
       			    echo "<div id='dept-employees'>";
                   echo "<h1>Employees</h1>";
       			foreach ($res['employees'] as  $value) {
       				echo "<span>$value[2]  $value[3]</span>
                     <div class='id-card'>
                     <h1>Member Card</h1>
                    <img src='$value[4]' class='id-image' height='100px' width='100px' >
                     <div class='id-details'>
                     <p>EmployeeID : $value[0]</p>
                     <p>MemberNumber : $value[1]</p>
                     <p>EmployeeName : $value[2]  $value[3]</p>
                    </div></div><br>";
                  }
      }
    }
    else if($check==2){
      echo "$remove";
      if($remove==1){
        header("Location:dept_search.php");
      }
      else{
        echo "<div class='lg-container'>
         <h1>Modify Department</h1>
         <hr class='hr-set'>";
         if($modify===5){
           echo "<div class='error'>Department Code You Entered is alredy existed</div>";
         }
         else if($modify===1){
           echo "<div class='success'>Ur Data Updated successfully</div>";
         }
         else if($modify===0){
           echo "<div class='error'>Something Went wrong Please Try aftersometime</div>";
         }
        echo "<form action='display.php' method='post' enctype='multipart/form-data' id='lg-form'>
            <label for='deptcode'>Department Code:</label>
            <input type='text' id='deptcode' name='DeptCode' value='$dept_code' required>
            <label for='deptcode'>Department Name:</label>
            <input type='text' id='deptcode' name='DeptName' value='".$res['department'][0]."' required>
           <center>
             <button type='submit' name='submit' value='modify'>Modify</button>
             <button type='reset' id='reset'>Reset</button>
             <button  id='back' type='button'  onclick=\"window.location='index.php'\">Back</button>
             <button name='submit' type='submit' value='remove' onclick=\"if(!confirm('Do You Really Want to delete ".$res['department'][0]."  Department.It will Delete ".count($res['employees'])."  employees' )) return false;\">Remove</button>
           </center>
           </center>
        </form>
      </div>";
       			    echo "<div id='dept-employees'>";
                   echo "<h1>Employees</h1>";
       			foreach ($res['employees'] as  $value) {
       				echo "<span>$value[2]  $value[3]</span>
                     <div class='id-card'>
                     <h1>Member Card</h1>
                    <img src='$value[4]' class='id-image' height='100px' width='100px' >
                     <div class='id-details'>
                     <p>EmployeeID : $value[0]</p>
                     <p>MemberNumber : $value[1]</p>
                     <p>EmployeeName : $value[2]  $value[3]</p>
                    </div></div><br>";
                  }
      }
    }
?>
<div class="copy-txt">
     <div class="container">
      <div class="row">
        <div class="col-md-12 set-foot" >
            &copy 2016 UCMIS | All rights reserved | Design by :
        </div>
      </div>
     </div>
</div>
<!-- copy text section end-->
<!-- JAVASCRIPT FILES PLACED AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
<!--JS to auto update time-->
<script type="text/javascript" src="../js/date.js"></script>
</body>
</html>
