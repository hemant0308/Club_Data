<!DOCTYPE html>
<html>
<head>
	<title>Report</title>
  <link href="../css/bootstrap.css" rel="stylesheet" />
  <!-- CUSTOM STYLE CSS -->
  <link href="../css/style.css" rel="stylesheet" />
  <link rel="stylesheet" href="../css/form_style.css">
</head>
<body>
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
      <h1>Report</h1>
  <center>
    <table>
      <tr>
        <td>All Employees</td>
        <td class='link' onclick="window.location='all.php'">click here</td>
      </tr>
      <tr>
        <td>Employees Who are on Rolls</td>
        <td class='link' onclick="window.location='onrolls.php'">click here</td>
      </tr>
      <tr>
        <td>Employees Who are Retired and OnRolls</td>
        <td class='link' onclick="window.location='retired-onrolls.php'">click here</td>
      </tr>
      <tr>
        <td>Employees Who are Not OnRolls</td>
        <td class='link' onclick="window.location='notonrolls.php'">click here</td>
      </tr>
    </table>
    <button onclick="window.location='../index.html'">Back</button>
  </ceneter>
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
