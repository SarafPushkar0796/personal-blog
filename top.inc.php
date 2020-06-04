<?php
  
require('./connection.inc.php');
require('./functions.inc.php');
date_default_timezone_set('UTC');

$top_res = mysqli_query($con,"select * from topics where status=1 order by topics asc");
$top_arr = array();
while($row=mysqli_fetch_assoc($top_res)){
    $top_arr[] = $row;	
}

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/styles.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300&family=Playfair+Display:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>Pushkar Expolre's - Personal Blog</title>
</head>
<style>
    html,body{overflow-x: hidden;}
    .card{
        border-radius: 6px;
        font-family: 'Nunito Sans',sans-serif;
        color: #375abb;
        z-index: 1;
    }
</style>
<body>
    <nav class="navbar">
        <a href="https://personal-site-v2.000webhostapp.com/index.php"><img class="rounded-circle shadow avatar" src="./profile.jpg" ></a>
        <div class="toggle"></div>
        <div class="overlay"></div>
        <div class="menu">
            <ul>
                <li><a href="./admin/index.php">Add Post</a></li>
                <li><a href="https://www.instagram.com/pushkars919/">Instagram</a></li>
                <li><a href="https://www.linkedin.com/in/pushkar-saraf-72488a157/">LinkedIn</a></li>                
            </ul>
        </div>
    </nav>