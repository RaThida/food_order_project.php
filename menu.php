<?php 
        include('../config/constants.php'); 
        include('check_login.php');
?>
<html>

    <head>
        <title>Restaurant Website</title>
        <link rel="stylesheet" href="../css/index.css">
        <link rel="stylesheet" href="../css/table.css">
    </head>

    <body>

       <!-- Menu Section Starts -->
       <div class="Menu text-center">
        <div class="wrapper">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="manage_admin.php">Admin</a></li>
                <li><a href="manage_category.php">Category</a></li>
                <li><a href="manage_food.php">Food</a></li>
                <li><a href="manage_order.php">Order</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
       </div>
       <!-- Menu Section Ends -->