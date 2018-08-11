<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "prosec";
//    if (isset($_POST['searchbyid']))
// {
//    echo "button 1 has been pressed";
// }
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
// else{
// 	echo "Successfully connected";
// }

if ( isset($_REQUEST['input_id']) ) {
	 $id= $_REQUEST['input_id']; } 
// $id=$_POST["input_id"];

      // print($id);


	$sql = "SELECT A.id, A.time_in, A.time_out, A.date, B.Name, B.Surname from attend as A JOIN employees as B on A.id = B.id where A.id = '$id'";
     $r = mysqli_query($conn,$sql); 

if ($conn->query($sql) === TRUE) {
    echo "Success";
} else {
    // echo "Error: " . $sql . "<br>" . $conn->error;
}
echo "<table>";
 while ($row = mysqli_fetch_array($r)) {
 $id   = $row['id'];
 $name = $row['Name'];
 $surname = $row['Surname'];
 $timein = $row['time_in'];
  $timeout = $row['time_out'];
  $date = $row['date'];

 // $ = $row['address'];
 // $content = $row['content'];
 echo "<tr><td>".$id."</td><td>".$name."</td><td>".$surname."</td><td>".$timein."</td><td>".$timeout."</td><td>".$date."</td></tr>";
 }
 echo "</table>";

$conn->close();
?>