<?php

session_start();


include "classes/login_cls.php";
include "classes/db_conn.php";


// $conn = new Database;//connect to a database [this will return instance var ]
$login = new LoginSystem; //an objecgt for loging class.

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $password = md5($password);
    $login->login($username, $password);
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link rel="stylesheet" type="text/css" media="screen" href="css/index.css"> -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script> -->

    <style>
        body {
            height: 100%;
            text-align: center;
            background-image: url(img/rawpixel-593602-unsplash.jpg);
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            position: relative;
        }
        
        @media screen and (max-width: 768px) {
            body {
                height: 100%;
                width: 100%;
            }
        }

        .container {
            padding: 60px 50px;
        }

        .signup-container {
            max-width: 45%;
            /* height: 100%; */
            padding: 50px;
            border-radius: 2%;
            -moz-box-shadow: inset 10px 10px 50px rgb(70, 64, 64);
            -webkit-box-shadow: inset 10px 10px 50px rgb(70, 67, 67);
            box-shadow: inset 10px 10px 50px rgb(70, 68, 68);
            margin: auto;
            position: relative;
        }

        .col-sm-6 {
            text-align: center;
            margin: 10px 0;
        }

        @media screen and (max-width: 768px) {
            .col-sm-6 {
                text-align: center;
                margin: 10px 0;
            }

            .signup-container,
            .container {
                height: 100%;
                max-width: 100%;
            }
        }

        .top-img {
            height: 90px;
            width: 90px;

            margin: auto 4%;
            position: relative;
        }

        @media screen and (max-width: 768px) {
            .top-img {
                height: 100px;
                width: 100px;

                margin: auto 4%;
                position: relative;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="signup-container">
            <h2><img class="top-img" src="img/globale.png" />Matcha_<img class="top-img" src="img/globale.png" /></h2>
            <form action="" method="post" name="signup">
                <div class="col-sm-6">
                    <input class=" details username form-control" type="text" placeholder="Enter username" name="username" required>
                </div>
                <div class="col-sm-6">
                    <input class="details passwword form-control" type="text" placeholder="Enter password" name="password" required>
                </div>

                <p><input class="btn signup" type="submit" name="submit" value="Signup"></p>

                <a href="forgot_password.php">Forgot password?</a>
                <p>need an account? <a class="login-trigger" href="index.php" data-target="#signup" data-toggle="modal" data-dismiss="modal" class="close">signup</a>
                    <p>

            </form>
        </div>
    </div>
    </div>
</body>

</html>