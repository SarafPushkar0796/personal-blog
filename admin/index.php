<?php

require('./connection.inc.php');
require('./functions.inc.php');

date_default_timezone_set('UTC');

$msg = '';

if(isset($_POST['submit'])){
    $username = get_safe_value($con, $_POST['username']);
    $password = get_safe_value($con, $_POST['password']);

    $res = mysqli_query($con,"select * from admin_user where username='$username' and password='$password'");
    $count = mysqli_num_rows($res);
    echo $count;
    if($count > 0){
        $_SESSION['ADMIN_LOGIN'] = 'yes';
        $_SESSION['ADMIN_USERNAME'] = $username;
        header('Location:topics.php');
        die();
    } else {
        $msg="Please enter correct details.".mysqli_error($con);
    }
}

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/styles.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300&family=Playfair+Display:wght@400;600&display=swap" rel="stylesheet">
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
        <img class="rounded-circle shadow avatar" src="../profile.jpg" >
        <div class="toggle"></div>
        <div class="overlay"></div>
        <div class="menu">
            <ul>
                <li><a href="../index.php">Home</a></li>
                <li><a href="">Instagram</a></li>
                <li><a href="">LinkedIn</a></li>
                <li><a href="">Email</a></li>
            </ul>
        </div>
    </nav>

    <!-- Login form -->
    <div class="container" style="margin-top: 25%;">
        <div class="title">
            <h1>Welcome</h1>
            <h1>Pushkar.</h1>
        </div>
        <div class="card shadow mt-4">
            <div class="card-body">
            <form method="post">
                <div class="form-group">
                    <input type="text" name="username" class="form-control" id="" placeholder="Username">
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control" id="" placeholder="Password">
                </div>            
                <button type="submit" name="submit" class="btn btn-block btn-primary shadow">Login</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script>
        $(function(){
            $('.toggle').click(function(){
                $('.toggle').toggleClass('active');
                $('.card').toggle('z-index');
                $('.overlay').toggleClass('active');
                $('.menu').toggleClass('active');
            });
        });
    </script>
</body>
</html>