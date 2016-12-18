<?php 
session_start();
if(!isset($_SESSION["manager"])) {
	header("location:admin_login.php");
	exit();
}
if(isset($_POST["username"]) && isset($_POST["password"])) {
	$manager = preg_replace('#[^A-Za-z0-9]#i','',$_POST["username"]);
	$password = preg_replace('#[^A-Za-z0-9]#i','',$_POST["password"]);
	include "../storescript/coonect_to_mysql.php";
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

<?php
//error reporting
error_reporting(E_ALL);
ini_set('display_errors','1');
?>

<?php 
//parse the from data and add inventory
if(isset($_POST['product_name'])) {
	$product_name = mysqli_real_escape_string($_POST['product_name']);
	$price = mysqli_real_escape_string($_POST['price']);
	$category = mysqli_real_escape_string($_POST['category']);
	$subcategory = mysqli_real_escape_string($_POST['subcategory']);
	$details = mysqli_real_escape_string($_POST['details']);
	
	$sql = mysqli_query($dbc, "SELECT id FROM products WHERE product_name='$product_name' LIMIT 1");
	$productMatch = mysqli_num_rows($sql);
	if($productMatch >0) {
		echo 'Sorry product name already present, <a href="inventory_list.php">Click Here </a>';
		exit();
	}
	
	$sql=mysqli_query($dbc, "INSERT INTO product_name,price,details,category,subcategory,date_added)
	values('$product_name','$price','$details','$category','$subcategory','now())") or die(mysqli_error($dbc));
	$pid=mysqli_insert_id();
	
	$newimage="$pid.jpg";
	move_upladed_files($_FILES['FileField']['tmp_name'],"../inventory_images/$newname");
}
?>
<?php 
//This block grabs the whole list for viewing
$product_list = "";
$sql = mysqli_query($dbc, "SELECT * FROM products");
$productCount = mysqli_num_rows($sql);
if($productCount>0) {
	while ($row=mysqli_fetch_array($sql)) {
		$id = $row["id"];
		$product_name = $row["product_name"];
		$product_list = "$id-$product_name<br/>";
	}
}
	else {
		$product_list = "You have no products listed in your store yet";
	}
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Inventory List</title>
<link rel="stylesheet" href="../style/style.css" type="text/css" media="screen"/>
</head>

<body>
<div align="center" id="mainWrapper">
<?php include_once("../template_header.php"); ?>
<div id="pageContent">
	<div align="right"stlye="margin-right:32px;"><a href="inventory_list.php#inventoryForm">+ADD NEW INVENTORY ITEMS</a></div>
  <div align="left" style="text-align: center; font-size: large;" stlye="margin-left:24px;">
  
    <h3>Inventory List !</h3>
      <?php echo $product_list; ?>
  </div>
	<form action="inventory_list.php" enctype="multipart/form-data" name="myForm" id="myForm" method="post">
    <a name="inventoryForm" id="inventoryForm"></a>
	  <p style="font-size: 18px; text-align: center;">Add New Inventory Item 
      </p>
      <table width="90%" height="433" border="1" cellpadding="6" cellspacing="0">
        <tbody>
          <tr>
            <td width="30%">Product Name</td>
            <td width="70%"><input name="product_name" type="text" required="required" id="product_name" size="40" maxlength="40"></td>
          </tr>
          <tr>
            <td>Product Price</td>
            <td>Rs. 
              <input name="price" type="number" required="required" id="price"></td>
          </tr>
                  
          <tr>
            <td>Category</td>
            <td><input type="text" name="category" id="category"></td>
          </tr>
          <tr>
            <td>Subcategory</td>
            <td><input type="text" name="subcategory" id="subcategory"></td>
          </tr>
          <tr>
            <td>Product Details </td>
            <td><textarea name="details" rows="6" maxlength="1000" id="details"></textarea></td>
          </tr>
          <tr>
            <td height="76">Product image</td>
            <td><input type="file" name="fileField" id="fileField"></td>
          </tr>
          <tr>
            <td height="76">&nbsp;</td>
            <td><input type="button" name="button" id="button" value="Upload Details"></td>
          </tr>
        </tbody>
      </table>
	  <p>&nbsp;</p>
	  <p>&nbsp;</p>
	  <p>&nbsp;</p>
	  <p>&nbsp;</p>
	  <p>&nbsp;</p>
	  <p>&nbsp;</p>
	  <p>&nbsp;</p>
	  <p>&nbsp;</p>
  </form>
<?php include_once("../template_footer.php"); ?>
</div>
</body>
</html>