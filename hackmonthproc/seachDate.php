<!DOCTYPE html>
<html>
<head>
  <title></title>
</head>
<style type="text/css">
    .filter{
     display: flex;
     flex-wrap: wrap;
     width: 20%;
   }
   #range{
     margin-top: 20px;
     margin-bottom: 20px;
     display: flex;
     justify-content: space-around;
     float: left;
   }
   body{
  /*  position: absolute;
  */  
  /*top: -20px;
    left: -20px;
    right: -40px;
    bottom: -40px;*/
    width: auto;
    height: auto;
    background-image: url(back.jpg);
    background-size: cover;
    background-repeat: no-repeat;
  /*  -webkit-filter: blur(5px);
/**/}
input[type=text]{

  background: transparent;
  border: 1px solid rgba(255,255,255,0.6);
  border-radius: 2px;
  color: #fff;
  font-family: 'Exo', sans-serif;
  font-size: 13px;
  font-weight: 400;
  padding: 4px;
  /*  margin-left: 30px;
*/}
input[type=date]{

  background: transparent;
  border: 1px solid rgba(255,255,255,0.6);
  border-radius: 2px;
  color: black;
  font-family: 'Exo', sans-serif;
  font-size: 13px;
      margin-top: 10px;

  font-weight: 400;
  padding: 4px;
  /*  margin-left: 30px;
*/}
input[type=submit]{
    /*width: 360px;
    height: 35px;*/
    background: #fff;
    border: 1px solid #fff;
    cursor: pointer;
    border-radius: 2px;
    color: #a18d6c;
    font-family: 'Exo', sans-serif;
    font-size: 13px;
    font-weight: 400;
    padding: 6px;
    margin-top: 10px;
    width: 160px;
  }
 
 /* input[type=submit]:hover{
    opacity: 0.8;
  }

  input[type=submit]:active{
    opacity: 0.6;
  }


  input[type=submit]:focus{
    outline: none;
  }*/
  table {  
   overflow:scroll;

   margin-top: 20px;
   color: #333;
   font-family: Helvetica, Arial, sans-serif;
   width: 770px; 
  /*    margin-left:  300px;
  */    border-collapse: 
  collapse; border-spacing: 0; 
}

td, th {  
  border: 1px solid transparent; /* No more visible border */
  height: 30px; 
  transition: all 0.3s;  /* Simple transition for hover effect */
}

th {  
  background: #DFDFDF;  /* Darken header a bit */
  font-weight: bold;
}

td {  
  background: #FAFAFA;
  text-align: center;
}
body {
    margin: 0;
}

ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    width: 11%;
    background-color: #f1f1f1;
    position: fixed;
    height: 100%;
    overflow: auto;
}

li a {
    display: block;
/*    color: #000;
*/    
text-align: center;
    text-decoration: none;
}

li a.active {
    background-color: #666;
    color: white;
}

li a:hover:not(.active) {
    background-color: #555;
    color: white;
}
a{
  background: #fff;
    border: 1px solid #fff;
    cursor: pointer;
    border-radius: 2px;
    color: #a18d6c;
    font-family: 'Exo', sans-serif;
    font-size: 13px;
    font-weight: 400;
    padding: 6px;
    margin-top: 10px;
    width: 150px;
}
#tableplace{
  display: flex;
  justify-content: center;
  align-items: center;
  align-self: center;
}
/* Cells in even rows (2,4,6...) are one color */        
tr:nth-child(even) td { background: #F1F1F1; }   

/* Cells in odd rows (1,3,5...) are another (excludes header cells)  */        
tr:nth-child(odd) td { background: #FEFEFE; }  

tr td:hover { background: #666; color: #FFF; }  



.dropdown {
    position: relative;
    display: inline;

}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #fff;
    width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
color: #a18d6c;
    font-family: 'Exo', sans-serif;
    font-size: 13px;
    font-weight: 400;
    
   
}

.dropdown-content a {
    padding: 12px 16px;
    text-decoration: none;
    display: block;
    color: #a18d6c;
    font-family: 'Exo', sans-serif;
    font-size: 13px;
    font-weight: 400;
    margin-top: 10px;
    width: 160px;
    

}

.dropdown-content a:hover {background-color: #ddd;}

.dropdown:hover .dropdown-content {display: block;
}

.dropdown:hover .dropbtn {background-color: #3e8e41;} 
#rangee{
  display: flex;
  justify-content: center;
  align-items: center;
}
</style>
<body>
<ul>
<li><img style = "margin-top: 10px" src="logo.png" style="margin-top: -40px;"></li>

  <li><a href="index2.php">Home</a></li>
  <li><form action="exporting.php" method="get"><input type="submit" name="export" value="Export all data">
      </form></li>
  <li><form action="exporting_today.php" method="get"><input type="submit" name="export" value="Export todays' data">
      </form></li>
  <li><div class = "dropdown"><a href="searchingpage.php">Search</a><div class="dropdown-content">
    <a href="seachDate.php">Search by date</a>
    <a href="searchID.php">Search by ID</a>
 
  </div></div></li>
  <li><a href="loginpage.html">Logout</a></li>
</ul>

<form id="rangee" method="POST" action="seachDate.php">
      <input type="date" name="from">
      <input type="date" name="to">
            <input type="submit" name ="searchbydate" class="sub" value="Поиск по дате">
    </form>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "prosec";
   if (isset($_POST['searchbydate']))
{
   
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
// else{
// 	echo "Successfully connected";
// }

if ( isset($_REQUEST['from']) ) {
	 $from_date= $_REQUEST['from'];
	  // print($from_date);
	  } 
if ( isset($_REQUEST['to']) ) {
	 $to_date= $_REQUEST['to'];}
	  // print($to_date); } 
// $id=$_POST["input_id"];

      // print($id);


	$sql = " SELECT A.id, A.time_in, A.time_out, A.date, B.Name, B.Surname from attend as A JOIN employees as B on A.id = B.id  WHERE date between '$from_date' AND '$to_date'";
  if($result = mysqli_query($conn, $sql)){
    if(mysqli_num_rows($result) > 0){
      echo "<div id='tableplace'>";
        echo "<table>";
            echo "<tr>";
                echo "<th>id</th>";
                echo "<th>Name</th>";
                echo "<th>Surname</th>";
                echo "<th>Time in</th>";
                echo "<th>Time out</th>";
                echo "<th>Date</th>";

            echo "</tr>";
        while($row = mysqli_fetch_array($result)){
            echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['Name'] . "</td>";
                echo "<td>" . $row['Surname'] . "</td>";
                echo "<td>" . $row['time_in'] . "</td>";
                echo "<td>" . $row['time_out'] . "</td>";
                                echo "<td>" . $row['date'] . "</td>";

                
            echo "</tr>";
        }
        echo "</table>";
        echo "</div>";
        // Free result set
        mysqli_free_result($result);
    } else{
        echo "No records for this ID.";
    }
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}

//      $r = mysqli_query($conn,$sql); 

// if ($conn->query($sql) === TRUE) {
//     echo "Success";
// } else {
//     // echo "Error: " . $sql . "<br>" . $conn->error;
// }
//       echo "<div id='tableplace'>";

// echo "<table>";
//  while ($row = mysqli_fetch_array($r)) {
//  $id   = $row['id'];
//  $name = $row['Name'];
//  $surname = $row['Surname'];
//  $timein = $row['time_in'];
//   $timeout = $row['time_out'];
//   $date = $row['date'];

//  // $ = $row['address'];
//  // $content = $row['content'];
//  echo "<tr><td>".$id."</td><td>".$name."</td><td>".$surname."</td><td>".$timein."</td><td>".$timeout."</td><td>".$date."</td></tr>";
//  }
//  echo "</table>";

$conn->close();
}
?>

</body>
</html>