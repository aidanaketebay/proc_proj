<?php

  /***** EDIT BELOW LINES *****/
  $DB_Server = "localhost"; // MySQL Server
  $DB_Username = "root"; // MySQL Username
  $DB_Password = ""; // MySQL Password
  $DB_DBName = "prosec"; // MySQL Database Name
  $xls_filename = 'export_all_till'.date('Y-m-d').'.xls'; // Define Excel (.xls) file name
   
  /***** DO NOT EDIT BELOW LINES *****/
  // Create MySQL connection

  $servername = "localhost";
$username = "root";
$password = "";
$dbname = "prosec";
 
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

  if(isset($_GET['export'])) {
  $sql = "SELECT A.id, B.Name, B.Surname , A.time_in, A.time_out, A.date from attend as A JOIN employees as B on A.id = B.id";
   $result = mysqli_query($conn,$sql); 

if ($conn->query($sql) === TRUE) {
    echo "Success";
}
  // $Connect = @mysqli_connect($DB_Server, $DB_Username, $DB_Password) or die("Failed to connect to MySQL" );
  // // $Db = @mysqli_select_db($DB_DBName, $Connect) or die("Failed to select database" );
  // $result = @mysqli_query($sql,$Connect) or die("Failed to execute query" );
   
  // Header info settings
  header("Content-Type: application/xls");
  header("Content-Disposition: attachment; filename=$xls_filename");
  header("Pragma: no-cache");
  header("Expires: 0");
   
  /***** Start of Formatting for Excel *****/
  // Define separator (defines columns in excel &amp; tabs in word)
  $sep = "\t"; // tabbed character
   
  // Start of printing column names as names of MySQL fields
  // for ($i = 0; $i<mysqli_num_fields($result); $i++) {
  //   echo mysqli_field_name($result, $i) . "\t";
  // }
  echo "ID". $sep."Name".$sep."Surname".$sep."Time_in".$sep."Time_out".$sep."Date";
 
  print("\n");

  // End of printing column names
   
  // Start while loop to get data
  while($row = mysqli_fetch_row($result))
  {
    $schema_insert = "";
    for($j=0; $j<mysqli_num_fields($result); $j++)
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
  }}
?>