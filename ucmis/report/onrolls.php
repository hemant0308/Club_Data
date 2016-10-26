<?php
include("../php-classes/report.php");
$rep=new Report();
$res=$rep->report_display(2);
if($res==2||$res==3){
		header("Location:../database_error.php");
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>report</title>
  <link href="../css/style.css" rel="stylesheet" />

</head>
<body>
  <center>
<table>
  <thead><td>Employee_Id</td><td>Name</td><td>Membership_ID</td><td>Employee_Status</td><td>Department</td></thead>
  <?php
    foreach ($res as  $value) {
      echo "<tr><td>$value[0]</td><td>$value[1] $value[2]</td><td>$value[3]</td><td>$value[4]</td><td>$value[5]</td></tr>";
    }
   ?>
</table>
<button onclick="window.print()">Print</button>
<button onclick="window.location='index.php'">Back</button>
</center>
</body>
</html>
