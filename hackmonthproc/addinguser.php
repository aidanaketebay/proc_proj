<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>Random Login Form</title>
  
  
  
      <style>
      /* NOTE: The styles were added inline because Prefixfree needs access to your styles and they must be inlined if they are on local disk! */
      @import url(https://fonts.googleapis.com/css?family=Exo:100,200,400);
@import url(https://fonts.googleapis.com/css?family=Source+Sans+Pro:700,400,300);

/*body{
  margin: 0;
  padding: 0;
  background: #fff;

  color: #fff;
  font-family: Arial;
  font-size: 12px;
}*/

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

.grad{
  position: absolute;
  top: -20px;
  left: -20px;
  right: -40px;
  bottom: -40px;
  width: auto;
  height: auto;
  background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(0,0,0,0)), color-stop(100%,rgba(0,0,0,0.65))); /* Chrome,Safari4+ */
  z-index: 1;
  opacity: 0.7;
}

.header{
  position: absolute;
  top: calc(50% - 35px);
  left: calc(50% - 255px);
  z-index: 2;
}

.header div{
  float: left;
  color: #fff;
  font-family: 'Exo', sans-serif;
  font-size: 35px;
  font-weight: 200;
}

.header div span{
  color: #5379fa !important;
}

.login{
  position: absolute;
  top: calc(50% - 75px);
  left: calc(50% - 50px);
  height: 150px;
  width: 350px;
  padding: 10px;
  z-index: 2;
}

.login input[type=text]{
  width: 250px;
  height: 30px;
  background: transparent;
  border: 1px solid rgba(255,255,255,0.6);
  border-radius: 2px;
  color: #fff;
  font-family: 'Exo', sans-serif;
  font-size: 16px;
  font-weight: 400;
  padding: 4px;
/*  margin-left: 30px;
*/}
.login label{
  width: 250px;
  height: 30px;
  background: transparent;
/*  border: 1px solid rgba(255,255,255,0.6);
*/  border-radius: 2px;
  color: #fff;
  font-family: 'Exo', sans-serif;
  font-size: 16px;
  font-weight: 400;
  padding: 4px;
}

.login input[type=password]{
  width: 250px;
  height: 30px;
  background: transparent;
  border: 1px solid rgba(255,255,255,0.6);
  border-radius: 2px;
  color: #fff;
  font-family: 'Exo', sans-serif;
  font-size: 16px;
  font-weight: 400;
  padding: 4px;
  margin-top: 10px;
}

.login input[type=submit]{
  width: 260px;
  height: 35px;
  background: #fff;
  border: 1px solid #fff;
  cursor: pointer;
  border-radius: 2px;
  color: #a18d6c;
  font-family: 'Exo', sans-serif;
  font-size: 16px;
  font-weight: 400;
  padding: 6px;
  margin-top: 10px;
}

.login input[type=submit]:hover{
  opacity: 0.8;
}

.login input[type=submit]:active{
  opacity: 0.6;
}

.login input[type=text]:focus{
  outline: none;
  border: 1px solid rgba(255,255,255,0.9);
}

.login input[type=password]:focus{
  outline: none;
  border: 1px solid rgba(255,255,255,0.9);
}

.login input[type=submit]:focus{
  outline: none;
}

::-webkit-input-placeholder{
   color: rgba(255,255,255,0.6);
}

::-moz-input-placeholder{
   color: rgba(255,255,255,0.6);
}


.add{
  position: absolute;
  top: calc(50% - 75px);
  left: calc(50% - 50px);
  height: 150px;
  width: 350px;
  padding: 10px;
  z-index: 2;
}

.add input[type=text]{
  width: 250px;
  height: 30px;
  background: transparent;
  border: 1px solid rgba(255,255,255,0.6);
  border-radius: 2px;
  color: #fff;
  font-family: 'Exo', sans-serif;
  font-size: 16px;
  font-weight: 400;
  padding: 4px;
}

.add input[type=password]{
  width: 250px;
  height: 30px;
  background: transparent;
  border: 1px solid rgba(255,255,255,0.6);
  border-radius: 2px;
  color: #fff;
  font-family: 'Exo', sans-serif;
  font-size: 16px;
  font-weight: 400;
  padding: 4px;
  margin-top: 10px;
}

.add input[type=button]{
  width: 260px;
  height: 35px;
  background: #fff;
  border: 1px solid #fff;
  cursor: pointer;
  border-radius: 2px;
  color: #a18d6c;
  font-family: 'Exo', sans-serif;
  font-size: 16px;
  font-weight: 400;
  padding: 6px;
  margin-top: 10px;
}
.login input[type=file]{
  width: 245px;
  height: 20px;
  background: #fff;
  border: 1px solid #fff;
  cursor: pointer;
  border-radius: 2px;
  color: #a18d6c;
  font-family: 'Exo', sans-serif;
  font-size: 16px;
  font-weight: 400;
  padding: 6px;
  margin-top: 10px;
}

.add input[type=button]:hover{
  opacity: 0.8;
}

.add input[type=button]:active{
  opacity: 0.6;
}

.add input[type=text]:focus{
  outline: none;
  border: 1px solid rgba(255,255,255,0.9);
}

.add input[type=password]:focus{
  outline: none;
  border: 1px solid rgba(255,255,255,0.9);
}

.add input[type=button]:focus{
  outline: none;
}
button{
  width: 60px;
  height: 35px;
  background: #fff;
  border: 1px solid #fff;
  cursor: pointer;
  border-radius: 2px;
  color: #a18d6c;
  font-family: 'Exo', sans-serif;
  font-size: 16px;
  font-weight: 400;
  padding: 6px;
  margin-top: 10px;
}
button:hover{
  opacity: 0.8;
}

button:active{
  opacity: 0.6;
}


button:focus{
  outline: none;
}

    </style>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>

</head>

<body>

  <div class="body"></div>
    <div class="grad"></div>
    <div class="header">
      <div><img src="logo.png" style="margin-top: -40px;"></div>
    </div>
    <br>
    <div class = "login">
              <a href="adminpage.html"><button style="margin-left: 75px">Назад</button></a>

      <form method="GET" action="addinguser.php">
      <label>ID</label><input type="text" name="user_id"  style="margin-left: 53px"><br><label>Name</label><input type="text" name="name_user"  style="margin-left: 24px"><br><label>Surname</label><input type="text" name="surname_user" ><br><label>Image</label><input type="file" name="img_user" accept="image/png, image/jpeg" style="margin-left: 22px" >
      <input type="submit" name="submit" value="Save" style="margin-left: 75px"></form>
    </div>
   

  


<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "prosec";
   if (isset($_POST['submit']))
{
   echo "button 1 has been pressed";
}
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
// else{
//  echo "Successfully connected";
// }
$user_id = '';
$name_user = '';
$surname_user = '';
$img_user = '';

if ( isset($_REQUEST['user_id']) ) {
   $user_id= $_REQUEST['user_id'];
   // print($user_id);
    } 
if ( isset($_REQUEST['name_user']) ) {
   $name_user= $_REQUEST['name_user'];
   // print($name_user);
    } 
    if ( isset($_REQUEST['surname_user']) ) {
   $surname_user= $_REQUEST['surname_user'];
   // print($surname_user);
    } 
     if ( isset($_REQUEST['img_user']) ) {
   $img_user= $_REQUEST['img_user'];
   // print($img_user);
    } 
// $id=$_POST["input_id"];

      // print($id);
 if($user_id != '' || $user_id != 'ID' && $name_user != '' || $name_user != 'Name' && $surname_user!='' || $surname_user!='Surname' && $img_user!=''){
$sql = "INSERT INTO `employees`(`id`, `Name`, `Surname`, `Image_url`) VALUES ('$user_id','$name_user','$surname_user','$img_user') ";
    $r = mysqli_query($conn,$sql); 

if ($conn->query($sql) === TRUE) {
    echo "Success";
} else {
    // echo "Error: " . $sql . "<br>" . $conn->error;
}
 }

$conn->close();
?>


</body>

</html>
