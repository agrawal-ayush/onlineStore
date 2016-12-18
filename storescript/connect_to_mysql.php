<?php

$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "onlinestore";

$dbc = @mysqli_connect("$db_host","$db_user","$db_pass","$db_name") or die("Could not connect to the database");
mysqli_select_db($dbc,"$db_name") or die("No Databas Found");

?>
