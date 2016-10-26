<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Home</title>
    <!-- BOOTSTRAP CORE STYLE CSS -->
    <link href="../css/bootstrap.css" rel="stylesheet" />
    <!-- CUSTOM STYLE CSS -->
    <link href="../css/style.css" rel="stylesheet" />
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
                </div>
                <div class="col-sm-3 col-lg-3 date">
                   <h3  id="date"></h3>
                </div>
            </div>
        </div>
    </section>
    <div class="row col-lg-12 col-sm-12">
      <div class="col-lg-2 col-sm-2"></div>
      <div class="col-lg-4 col-sm-4 but">
        <h1>Bakup</h1>
        <form name="backup" action="backup.php" method="post">
          <button type="submit">click here</button>
        </form>
      </div>
      <div class="col-lg-4 col-sm-4 but">
        <h1>Restore</h1>
        <form name="restore" action="restore.php" method="post" enctype="multipart/form-data">
          <label for="file">choose ur backup file(must be in .sql format)</label>
          <input type="file" id="file" name='File' required="true">
          <button type="submit" >Restore</button>
        </form>
      </div>
      <div class="col-lg-2 col-sm-2">
      </div>
    </div>
    <center><button onclick="window.location='../index.html'" type="button">back</back></center>
    <!--  End home section  -->
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
