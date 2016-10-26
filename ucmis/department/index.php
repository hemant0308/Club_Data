<?php
include("../php-classes/department.php");
session_start();
$dept=new department();
$res=-1;
if($_SERVER['REQUEST_METHOD']=='POST'){
  if(isset($_SESSION['last'])&&($_SESSION['last']==$_POST)){
    $res=-1;
    session_destroy();
  }
  else{
    $dept_code=$_POST['DeptCode'];
    $dept_name=$_POST['DeptName'];
    $res=$dept->department_add($dept_code,$dept_name);
    $_SESSION['last']=$_POST;
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Department</title>
  <!-- BOOTSTRAP CORE STYLE CSS -->
  <link href="../css/bootstrap.css" rel="stylesheet" />
  <!-- CUSTOM STYLE CSS -->
  <link href="../css/style.css" rel="stylesheet" />
  <link rel="stylesheet" href="../css/search_style.css">
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
  <!--form to search department start-->
     <div class="lg-container ">
      <h1>Add New Department</h1>
      <hr class="hr-set">
      <div id='error' class="error">
          <?php
            if($res==-1|$res==1){

            }
            else if($res==0){
              echo "Department code is already existed.";
            }
            else{
              header("Location:../database_error.php");
            }
           ?>
      </div>
      <form action="index.php" method="post" enctype="multipart/form-data" id="lg-form">
        <p class="success">
          <?php if($res==1)
          echo "Department added successfully"; ?>
       </p>
          <label for="deptcode">Department Code:</label>
          <input type="text" id="deptcode" name="DeptCode" required  onfocus="remove_error();">
          <label for="deptname">Department Name:</label>
          <input type="text" id="deptname" name="DeptName" required>
         <center>
           <button type="submit">ADD</button>
           <button type="reset" id="reset">Reset</button>
           <button  id="back" onclick="window.location='../index.html'">Back</button>
         </center>
      </form>
      <div>
        <a class='link2' href="dept_search.php">
        Search for a department...
      </a>
      </div>
    </div>
    <!--end of form-->

  <!-- COPY TEXT SECTION END-->
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
 <?php
  if($res!=-1){
   echo "<script>document.getElementById('error').style.display='block';</script>";
  }
  ?>
 <script>
 function remove_error(){
   var elem=document.getElementById('error');
   if(elem.style.display=='block'){
     elem.style.display='none';
   }
 }
 </script>
</body>
</html>
