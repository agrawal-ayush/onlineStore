<?php 
session_start();
if(!isset($_SESSION["manager"])) {
	header("location:admin_login.php");
	exit();
}
if(isset($_POST["username"]) && isset($_POST["password"])) {
	$manager = preg_replace('#[^A-Za-z0-9]#i','',$_POST["username"]);
	$password = preg_replace('#[^A-Za-z0-9]#i','',$_POST["password"]);
	include "../storescript/connect_to_mysql.php";
	$sql = mysqli_query($dbc, "SELECT * FROM admin WHERE username='$manager' AND password='$password' LIMIT 1");
	$existCount = mysqli_num_rows($sql);
	while($rows = mysqli_fetch_array($sql)) {
		$id = $row["id"];
	}
	
	$_SESSION["id"] = $id;
	$_SESSION["manager"] = $manager;
	$_SESSION["password"] = $password;
	header("location:index.php");
	exit();
}
	else {
		echo 'This is information is incorrect, try again <a href="index.php">Click Here</a>';
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
  <div style="">
    <form id="form1" name="form1" method="post">
      <h3>Please Log In to manage the store!!</h3>
      <p>
        <label for="textfield">Username:</label>
        <input name="textfield" type="text" required="required" id="textfield" size="40">
        <label for="password"><br>
          <br>
          Password: </label>
        <input name="password" type="password" required="required" id="password" size="40">
        </p>
      <p>
        <input type="submit" name="submit" id="submit" value="Log In!">
      </p>
    </form>
     </div>
  </div>
<?php include_once("../template_footer.php"); ?>
</div>
</body>
</html>