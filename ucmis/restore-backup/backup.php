<?php
function backup_tables($host,$user,$pass,$name,$tables = '*'){
	$return="CREATE DATABASE IF NOT EXISTS ".$name.";\n";
	$return = $return ." USE ".$name.";\n";
	$link = mysql_connect($host,$user,$pass);
	if(!$link){
		return 2;
	}
	if(!mysql_select_db($name,$link)){
		return 3;
	}
	//get all of the tables
	if($tables == '*')
	{
		$tables = array();
		$result = mysql_query('SHOW TABLES');
		if(!$result){
			return 4;
		}
		while($row = mysql_fetch_row($result))
		{
			$tables[] = $row[0];
		}
	}
	else
	{
		$tables = is_array($tables) ? $tables : explode(',',$tables);
	}

	//cycle through
	foreach($tables as $table)
	{
		$result = mysql_query('SELECT * FROM '.$table);
		$num_fields = mysql_num_fields($result);

		$row2 = mysql_fetch_row(mysql_query('SHOW CREATE TABLE '.$table));
		$return.= $row2[1].";\n";

		for ($i = 0; $i < $num_fields; $i++)
		{
			while($row = mysql_fetch_row($result))
			{
				$return.= 'INSERT INTO '.$table.' VALUES(';
				for($j=0; $j < $num_fields; $j++)
				{
					$row[$j] = addslashes($row[$j]);
					$row[$j] = preg_replace("/\n/","\\n",$row[$j]);
					if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
					if ($j < ($num_fields-1)) { $return.= ','; }
				}
				$return.= ");\n";
			}
		}
	}

	//save file
	$file_name="backup".'.sql';
	$result=date("y-m-d").'_'.date("h-i-sa");
	$dir_name="../backups/".$result;
	mkdir($dir_name);
	mkdir($dir_name."/profile_pictures");
	mkdir($dir_name."/sql");
	$location=$dir_name.'/sql/'.$file_name;
	$handle = fopen($location,'w+');
	fwrite($handle,$return);
	fclose($handle);
	$arr=scandir("../profile_pictures");
	foreach ($arr as $value) {
		if($value=="."||$value==".."){
			continue;
		}
		copy("../profile_pictures/".$value,$dir_name."/profile_pictures/".$value);
	}
	return $result;
}
$file_name=-1;
if ($_SERVER['REQUEST_METHOD']=='POST') {
  $user_name="employee";
  $serv_name="localhost";
  $password="employee";
  $dbname="club_data";
  $file_name=backup_tables($serv_name,$user_name,$password,$dbname);
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
        if($file_name==-1){
					header("Location:index.php");
        }
				if($file_name==2||$file_name==3||$file_name==4){
					header("Location:../database_error.php");
				}
        else{
          echo "ur backup is created successfully at "."C:wamp\\www\\ucmis\\backups\\".$file_name;
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
