<?php
  
require('./connection.inc.php');
require('./functions.inc.php');

date_default_timezone_set('UTC');

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300&family=Playfair+Display:wght@400;600&display=swap" rel="stylesheet">
    <title>Pushkar Expolre's - Personal Blog</title>
</head>
<style>
    html,body{overflow-x: auto;}
    .card{
        border-radius: 6px;
        font-family: 'Nunito Sans',sans-serif;
        color: #375abb;
        z-index: 1;
    }
</style>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <a class="navbar-brand" href="#">Admin Dashboard</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse" id="navbarColor02">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a class="nav-link" href="./topics.php">Topics master</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./post.php">Post master</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./contact_me.php">Contact me master</a>
            </li>
          </ul>
          <ul class="navbar-nav ml-auto">
              <li class="nav-item">
                <a class="btn btn-danger" href="./logout.php">Logout</a>
              </li>
          </ul>
        </div>
      </nav>