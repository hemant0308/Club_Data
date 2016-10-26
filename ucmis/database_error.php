<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Home</title>
    <!-- BOOTSTRAP CORE STYLE CSS -->
    <link href="css/bootstrap.css" rel="stylesheet" />
    <!-- CUSTOM STYLE CSS -->
    <link href="css/style.css" rel="stylesheet" />
</head>
<body>

    <!--  This section Describes the Home section of page  -->
    <section id="home-sec">
        <div class="overlay text-center">
            <div class="col-sm-12 col-lg-12">
                <div class="col-sm-3 col-lg-3">
                    <img src="images/steel_plant_logo.png" alt="steel_plant_logo" id="logo">
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
    <!--service section start-->
    <div class="container database_error">
      <center>
      <img src="/ucmis/images/database_error.png" height="200px" width="200px">
      <h4>Sorry There is a problem with your database please <a href="/phpmyadmin/" class="link">Check it out</a>.</h4>
        <button onclick="window.history.back()">back</button>
        <center>
    </div>
    <!--service section end-->
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
    <script type="text/javascript" src="js/date.js"></script>
</body>
</html>
