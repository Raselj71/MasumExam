<?php 
 $host="localhost";
 $user="root";
 $password ="";
 $dbname="jobdb";
 $con= new mysqli($host,$user,$password,$dbname);

if ($con->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


?>
