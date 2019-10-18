<?php

include "classes/db_conn.php";
session_start();

$conn = new Database;

$output = "";

if (isset($_POST['submit'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];

    $query = $conn->query("SELECT COUNT(`users_id`) FROM `users` WHERE `username` = '$name' AND `email` = '$email'");
    $count = $query->fetchColumn();
    if ($count == "1") {
        $message =
            "
                Reset your password
                Click the link below to reset your password
                http://localhost:8080/matcha/change_pwd.php?username=$name&email=$email
            ";

        mail($email, "camagru Confirm Email", $message, "From: DoNotReply@camagru.com");
        $output = '<strong>Check your email to complite your process!</strong>';
    } else {
        $output = '<strong>user does not exist</strong>';
    }
};
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>forgot_password</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            height: 100%;
            /* text-align: center; */
            background-image: url(img/rawpixel-593602-unsplash.jpg);
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            position: relative;
        }

        .container {
            margin: 0 auto;
            width: 700px;

        }

        form {
            max-width: 400px;
            margin: 2% auto 5%;
            padding: 40px;
            box-sizing: border-box;
            border-radius: 2%;
            -moz-box-shadow: inset 10px 10px 50px rgb(70, 64, 64);
            -webkit-box-shadow: inset 10px 10px 50px rgb(70, 67, 67);
            box-shadow: inset 10px 10px 50px rgb(70, 68, 68);
            position: relative;
            /* background: #fff; */
        }

        h1 {
            text-align: center;
        }

        .details {
            height: 40px;
            width: 340px;
        }

        .submit {
            background-image: none;
            padding: 8px 50px;
            margin-top: 20px;
            border-radius: 40px;
            border: 1px solid #25a08d;
            -webkit-transition: all ease 0.8s;
            -moz-transition: all ease 0.8s;
            transition: all ease 0.8s;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Reset Password</h1>
        <hr />
        <p>We can help you reset your password using your matcha
            username,or the email address linked to your account.</p>
        <hr />
        <?php print($output); ?>
        <form method="post">
            <p>username: <input class="details" type="text" name="name" required></p>
            <p>email: <input class="details" type="text" name="email" required></p>
            <p><input type="submit" name="submit" value="submit" /></p>
        </form>
    </div>
</body>

</html>