<?php
$host="Plantisc"; // Host name
$username="tissue"; // Mysql username 
$password=""; // Mysql password
$db_name="tissue"; // Database name
$tbl_name="upload"; // Table name

// Connect to server and select databse.
mysql_connect("$host", "$username", "$password")or die("cannot connect");
mysql_select_db("$db_name")or die("cannot select DB");

?>
