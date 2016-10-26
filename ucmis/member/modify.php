
<!DOCTYPE html>
<html>
<head>
	<title>Employee Search</title>
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
                      <h1 >UCMIS</h1>
											<p>Ukku Club Members Information System</p>
                  </div>
                  <div class="col-sm-3 col-lg-3">
                     <h3 class="text-info" id="date"></h3>
                  </div>
              </div>
          </div>
      </section>
      <div class="lg-container">
       <h1>Modify Employee</h1>
       <hr class="hr-set">
       <form action="display.php" method="post" enctype="multipart/form-data" id="lg-form">
           <label for="emp_id">Employee ID:</label>
           <input type="text" id="emp_id" name="EmployeeId" required>
          <center>
            <button type="submit">Search</button>
            <button type="reset" id="reset">Reset</button>
            <button  type="button" id="back" onclick="window.location='index.php'">Back</button>
          </center>
       </form>
      </div>
        <script type="text/javascript" src="../js/date.js"></script>
</body>
</html>
