<?php
session_start();
?>
<?php
/*define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'tissue');
define('DB_PASSWORD', 'tissue');
define('DB_DATABASE', 'tissue');
$connection = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
// username and password sent from form
$myusername=$_POST['myusername'];
$password=$_POST['password'];
$password = stripslashes($password);
$myusername = strtoupper(stripslashes($myusername));
// To protect MySQL injection (more detail about MySQL injection)
//$myusername = mysqli_real_escape_string($myusername);
//$password = mysqli_real_escape_string($password);
$sql = "select userid from user WHERE username='$myusername' and password='$password'";
$result=mysqli_query($connection,$sql);
while($rows=mysqli_fetch_array($result))
{
	 $userid=$rows['userid'];
}
// Mysql_num_row is counting table row
$count=mysqli_num_rows($result);

// If result matched $myusername and $mypassword, table row must be 1 row
*/

function getName() {
	if (array_key_exists("displayName", $_SERVER)) {
		return implode(" ", explode(";", $_SERVER["displayName"]));
	} else if (array_key_exists("cn", $_SERVER)) {
		return implode(" ", explode(";", $_SERVER["cn"]));
	} else if (array_key_exists("givenName", $_SERVER) && array_key_exists("sn", $_SERVER)) {
		return implode(" ", explode(";", $_SERVER["givenName"])) . " " .implode(" ", explode(";", $_SERVER["sn"]));
	}
	return "";
}

function IsNullOrEmptyString($str){
    return (!isset($str) || trim($str)==='');
}

$username = $_SERVER["REMOTE_USER"];
$name = getName();

print $name;
//if($count==1){
if(!IsNullOrEmptyString($name)){
// Register $myusername, $mypassword and redirect to file "login_success.php"
	//$_SESSION['userid'] = $userid;
	$_SESSION['name'] = $name;
	header("Location:homepage.php");
}
else {
	echo "<center><h4><a href='/userlogin.php'>Wrong Password. Retry</a></h4></center>";
}
?>
