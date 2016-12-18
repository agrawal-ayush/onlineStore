<?php 
session_start();
if(!isset($_SESSION["manager"])) {
	header("location:admin_login.php");
	exit();
}
$managerID = preg_replace('#[^0-9]#i', '',$_SESSION["id"]);
$manager = preg_replace('#[^A-Za-z0-9]#i','',$_SESSION["manager"]);
$password = preg_replace('#[^A-Za-z0-9]#i','',$_SESSION["password"]);

include "../storescript/connect_to_mysql.php";
$sql = mysqli_query($dbc, "SELECT * FROM admin WHERE id='$managerID' AND username='$manager' AND password='$password' LIMIT 1");

$existCount = mysqli_num_rows ($sql);
if($exitCount == 0) {
	echo "Invalid Credentials";
	exit();
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Online Admin Area</title>
<link rel="stylesheet" href="../style/style.css" type="text/css" media="screen"/>
</head>

<body>
<div align="center" id="mainWrapper">
<?php include_once("../template_header.php"); ?>
<div id="pageContent">
  <div align="left" style="margin-left=24px;">
    <h2>HEY Store Manager! What do you want to do today ?</h2>
    <p><a href="inventory_list.php">Manage Inventory!</a></p>
    <p><a href="../#">Manage Blah Blah!</a> </p>
    <h1>&nbsp;</h1>
  </div>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
</div>
<?php include_once("../template_footer.php"); ?>
</div>
</body>
</html>