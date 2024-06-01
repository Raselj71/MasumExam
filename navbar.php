<?php

include("db.php"); 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

     <link rel="stylesheet" href="nav.css">
     <link rel="stylesheet" href="login.css">
    <title>Navbar</title>
   
</head>

<body>
    <nav class="navbar">

        <h2 class="title">Ecomerce</span></h2>
        <ul class="list">

            <li><a href="index.php">Home</a></li>
            
            
              
               <?php if (isset($_SESSION['id'])): ?>
           
            <li><a href="logout.php">Logout</a></li>
        <?php else: ?>
            <li><a href="login.php">Login</a></li>
           
        <?php endif; ?>
            
            
        </ul>
       


    </nav>
</body>


</html>