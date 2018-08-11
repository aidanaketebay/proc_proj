
<!DOCTYPE html>
<meta charset="utf-8">

<html>
<head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>

  <title></title>
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->

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
  color: #fff;
  font-family: 'Exo', sans-serif;
  font-size: 13px;
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
</style>
</head>
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





          <div id="tableplace">
      <?php include_once 'refresh.php'; ?>

          </div>


 


  <script type='text/javascript'>
    var table = $('#tableplace');
       // refresh every 5 seconds
       var refresher = setInterval(function(){
         table.load("refresh.php");
       }, 500);
       setTimeout(function() {
         clearInterval(refresher);
       }, 1800000);
     </script>

   </body>
   </html>