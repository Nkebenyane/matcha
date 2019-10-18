<?php
include 'classes/db_conn.php';
include 'config/database.php';
include 'config/setup.php';
$conn = new Database;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Matcha_</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" media="screen" href="css/index.css">
    <style>
        #home-bg {
            height: 100%;
            text-align: center;
            background-image: url(img/rawpixel-593602-unsplash.jpg);
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            position: relative;
        }

        #members-bg {
            height: 100%;
            text-align: center;
            /* background-image: url(img/rawpixel-593602-unsplash.jpg); */
            /* background-position: center;
            background-repeat: no-repeat;
            background-size: cover; */
            position: relative;
        }
    </style>
</head>

<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">

    <!-----------navigation bar----------->
    <!-- <nav class="navbar navbar-default navbar-fixed-top">
        <div class="navbar-header">
            <a class="navbar-brand" href="#myPage">Matcha</a>
        </div>
        <ul class="nav navbar-nav">
            <li><a href="#portfolio">MEMBERS</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li><a class="login-trigger" href="signup.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
            <li><a class="login-trigger" href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
        </ul>
    </nav> -->
    <!-------------- ---------------->

    <div id="home-bg">
        <div class="container-fluid text-center">
            <?php
            include 'signup.php';
            ?>
        </div>
    </div>

    <!---------Members Section) ----------->

    <div id="members-bg">
        <div class="container-fluid text-center">
            <div class="row">
                <?php
                $sql = $conn->query("SELECT * FROM user_profile");
                $count = $sql->rowCount();
                $i = 0;
                if ($count > 0) {
                    while ($i <= 8 && $row = $sql->fetch(PDO::FETCH_ASSOC)) {
                        extract($row);
                        ?>
                        <div class="col-sm-3">
                            <img src="uploads/<?php echo $row['profile_pic'] ?>" style="width:100%; border-radius:100%; height:150px; width:150px" alt="profile picture" />

                            <div class="title">
                                <h3 class="name"><?php echo $row['username']; ?></h3>
                                <p><?php echo $row['gender'] ?></p>
                                <p>age <?php echo $row['age']; ?>, <?php echo $row['locations']; ?></p>
                            </div>
                        </div>
                <?php
                        $i++;
                    }
                }
                ?>
            </div>
        </div>
    </div>

    <!---------- need t know ---------------->
    <div class="container-fluid text-center">
        <div calss="row">
            <div class="col-sm-4">
                <img src="img/globale.png" style="height:120px; width:120px" />
                <h2>Global</h2>
                <p>You never know where you'll find love.</p>
            </div>

            <div class="col-sm-4">
                <img src="img/protected.png" style="height:120px; width:120px" />
                <h2>Protection</h2>
                <p>Your safety is provided by leading anti-scam system in the industry.</p>
            </div>

            <div class="col-sm-4">
                <img src="img/verified.jpg" style="height:120px; width:120px" />
                <h2>Verification</h2>
                <p>All members are personally confirmed by our staff to prove they are real.</p>
            </div>
        </div>
    </div>


    <!----footer section ---->
    <footer class="container-fluid text-center">
        <a href="#myPage" title="To Top">
            <span class="glyphicon glyphicon-chevron-up"></span>
        </a>
        <p>Made By <a href="#" title="">www.Maipato.com</a></p>
    </footer>

    <script src="js/index.js"></script>
</body>

</html>