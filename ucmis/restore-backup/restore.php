<?php
$res=-1;
if($_SERVER['REQUEST_METHOD']=='POST'){
    $file_ext=pathinfo($_FILES['File']["name"],PATHINFO_EXTENSION);
    if($file_ext!='sql'){
      $res=4;
    }
    else {
      $user_name="employee";
      $serv_name="localhost";
      $password="employee";
      $connect=mysql_connect($serv_name,$user_name,$password);  //create connection
      if(!($connect)){               							  //if connection is not success return 2
        mysql_close($connect);
        $res=2;
      }
      else{
        $file=$_FILES['File']['tmp_name'];
        $handle=fopen($file, "r");
          $string=fread($handle, filesize($file));
          $queries=explode(";\n",$string);
          foreach ($queries as $query) {
            if($query==""){
              break;
            }
            $result=mysql_query($query);
            if(!$result){
              $res=3;
              break;
            }
          }
          if($res!=3){
            $res=1;
          }
      }
    }
}
 ?>

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
  									<p>Ukku Club Members Information System</p>
                </div>
                <div class="col-sm-3 col-lg-3 date">
                   <h3  id="date"></h3>
                </div>
            </div>
        </div>
    </section>
    <!--  End home section  -->
    <div class="result">
      <?php
        if($res==-1){
          header("Location:index.php");
        }
        else if ($res==2||$res==3||$res==4) {
          # code...
          echo "Sorry There is a Problem with Ur file.";
        }
        else {
          echo "Your Backup is Restored Successfully";
          # code...
        }
      ?>
    </div>
    <center><button onclick="window.location='index.php'" type="button">back</back></center>
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
