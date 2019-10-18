<?php
// include 'classes/db_conn.php';
include 'classes/register_cls.php';


$output = "";
if (isset($_POST['login'])) {
    include 'login.php';
}

if (isset($_POST['submit'])) {
    //connect to a database [by creating an object that calls database class].
    $conn = new Database;

    //accessing user input from the form.
    $username = $_POST['username'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $re_pwd = $_POST['re_pwd'];

    //creating a new user [by creating an object that calls register class].
    $objuser = new user($username, $firstname, $lastname, $email, $password);
    $username = $objuser->getusername();
    $fname = $objuser->getfirstname();
    $lname = $objuser->getlastname();
    $email = $objuser->getemail();
    $password = $objuser->getpassword();


    //inserting user details in the users table.
    if (!empty($username) && !empty($firstname) && !empty($lastname) && !empty($email) && !empty($password)) {

        // $sql = ("SELECT * FROM users WHERE username = '".$username."'");
        $sql = $conn->query("SELECT COUNT(`users_id`) FROM `users` WHERE `username` = '$username'");
        $count = $sql->fetchColumn();

        if ($count == '1') {
            $output = "<strong>username already exist please choose a deferent username </strong>";
        } else if (!preg_match('/\A(?=[\x20-\x7E]*?[A-Z])(?=[\x20-\x7E]*?[a-z])(?=[\x20-\x7E]*?[0-9])[\x20-\x7E]{6,}\z/', $password)) {
            $output = "<strong>passwords format: Dkdjkfk#89</strong>";
        } else if ($re_pwd != $password) {
            $output = "<strong>passwords must match</strong>";
        } else {
            $confirmedcode = rand();
            $password = md5($password);
            $sql = "INSERT INTO users(username, firstname, lastname, email, pwd, confirmed, confirmed_code, notify)
            VALUES('" . $username . "', '" . $fname . "', '" . $lname . "', '" . $email . "', '" . $password . "', '0', '" . $confirmedcode . "', '0')";

            $message =
                "
                Confirm Your Email
                Click the link below to verify ypur account
                http://localhost:8080/matcha/confirm_email.php?username=$username&code=$confirmedcode
            ";

            mail($email, "camagru Confirm Email", $message, "From: DoNotReply@matcha.com");
            echo "Registration Complite! Please confirem your email address ";

            //execute the INSERT query [by calling our quary() method form DATABASE class]
            $conn->query($sql);
        }
    }
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <style>
        .signup-container {
            max-width: 45%;
            height: 100%;
            padding: 40px;
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
            <h4>Connect with Attractive</h4>
            <h4>Woman/Man</h4>
            <p>The Highest Response Rate You’ve </p>
            <p> Experienced</p>
            <p>Find your love</p>
            <?php print("$output"); ?>
            <form action="" method="post" name="signup">
                <div class="col-sm-6">
                    <input class=" details username form-control" type="text" placeholder="Enter username" name="username" required>
                </div>
                <div class="col-sm-6">
                    <input class="details username form-control" type="text" placeholder="Enter firstname" name="firstname" required>
                </div>
                <div class="col-sm-6">
                    <input class="details username form-control" type="text" placeholder="Enter lastname" name="lastname" required>
                </div>
                <div class="col-sm-6">
                    <input class="details email form-control" type="email" placeholder="Enter email" name="email" required>
                </div>
                <div class="col-sm-6">
                    <input class="details password form-control" type="password" placeholder="Enter password" name="password" required>
                </div>
                <div class="col-sm-6">
                    <input class="details password form-control" type="password" placeholder="Enter Re-password" name="re_pwd" required>
                </div>
                <p><input class="btn signup" type="submit" name="submit" value="Signup"></p>

                <p>Alredy have an account? <a href="login.php" name="login">login</a></p>
            </form>
        </div>
    </div>
</body>

</html>