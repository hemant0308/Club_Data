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
  <div class='lg-container '>
   <h1>Add New Department</h1>
   <hr class='hr-set'>
   <div class='error'>
   </div>
   <form action='display.php' method='post' enctype='multipart/form-data' id='lg-form'>
       <label for='deptcode'>Department Code:</label>
       <input type='text' id='deptcode' name='DeptCode' required>
      <center>
        <button type='submit'>Search</button>
        <button type='reset' id='reset'>Reset</button>
        <button  id='back' type='button' onclick="window.location='index.php'">Back</button>
      </center>
   </form>
  </div>
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
</body>
</html>
