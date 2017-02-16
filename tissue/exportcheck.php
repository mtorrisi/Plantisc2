<?php
/***** EDIT BELOW LINES *****/
$DB_Server = "localhost"; // MySQL Server
$DB_Username = "tissue"; // MySQL Username
$DB_Password = "tissue"; // MySQL Password
$DB_DBName = "tissue"; // MySQL Database Name
$DB_TBLName = "upload"; // MySQL Table Name

$treatment=$_POST['treatment'];
$type=$_POST['type'];
$kinintype=$_POST['kinintype'];
$id=$_POST['id'];


/***** DO NOT EDIT BELOW LINES *****/
// Create MySQL connection
$sql="SELECT auxinname, cytokininname, treatment, type, auxin, cytokinin, response FROM $DB_TBLName WHERE userid ='$id' and treatment='$treatment' and type='$type' and cytokininname='$kinintype'";
$Connect = @mysql_connect($DB_Server, $DB_Username, $DB_Password) or die("Failed to connect to MySQL:<br />" . mysql_error() . "<br />" . mysql_errno());
// Select database
$Db = @mysql_select_db($DB_DBName, $Connect) or die("Failed to select database:<br />" . mysql_error(). "<br />" . mysql_errno());
// Execute query
$result = @mysql_query($sql,$Connect) or die("Failed to execute query:<br />" . mysql_error(). "<br />" . mysql_errno());

$ext = ".xls";
$ext1 = "-output-data";
$xls_filename = $kinintype."-".$treatment."-".$type."".$ext1."".$ext;

// Header info settings
header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename=$xls_filename");
header("Pragma: no-cache");
header("Expires: 0");

/***** Start of Formatting for Excel *****/
// Define separator (defines columns in excel &amp; tabs in word)
$sep = "\t"; // tabbed character

// Start of printing column names as names of MySQL fields
for ($i = 0; $i<mysql_num_fields($result); $i++) {
  echo mysql_field_name($result, $i) . "\t";
}
print("\n");
// End of printing column names

// Start while loop to get data
while($row = mysql_fetch_row($result))
{
  $schema_insert = "";
  for($j=0; $j<mysql_num_fields($result); $j++)
  {
    if(!isset($row[$j])) {
      $schema_insert .= "NULL".$sep;
    }
    elseif ($row[$j] != "") {
      $schema_insert .= "$row[$j]".$sep;
    }
    else {
      $schema_insert .= "".$sep;
    }
  }
  $schema_insert = str_replace($sep."$", "", $schema_insert);
  $schema_insert = preg_replace("/\r\n|\n\r|\n|\r/", " ", $schema_insert);
  $schema_insert .= "\t";
  print(trim($schema_insert));
  print "\n";
}
?>
