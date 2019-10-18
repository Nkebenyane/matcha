<?php
include "header.php";
$conn = new Database;
$username = $_SESSION['username'];

if (!isset($_SESSION['username'])) {
    header('location: index.php');
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link rel="stylesheet" type="text/css" media="screen" href="css/index.css" /> -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        .our-team:hover .picture img {
            box-shadow: 0 0 0px 14px white;
            transform: scale(0.7);
        }

        .column {
            /* background-color: #f6f6f6; */
            border: 5px solid white;
            /* padding-top: 2%; */
            width: 240px;
            height: 280px;
        }

        .fa {
            font-size: 20px;
        }

        .checked {
            color: orange;
        }

        .row.content {
            height: 450px
        }

        /* On small screens, set height to 'auto' for sidenav and grid */
        @media screen and (max-width: 767px) {
            .sidenav {
                height: auto;
                padding: 15px;
            }

            .row.content {
                height: auto;
            }
        }
    </style>
</head>

<body>
    <div class="container-fluid text-center">

        <h2 class="text-center">Suggestions</h2>

        <div class="row">
            <div class="col-sm-3">
                <?php
                include 'search.php';
                include 'friend.php';
                ?>
            </div>
            <div class="col-sm-8">
                <?php
                $sql = $conn->query("SELECT * FROM user_profile WHERE username != '" . $_SESSION['username'] . "'");
                $count = $sql->rowCount();
                if ($count > 0) {
                    while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
                        extract($row);
                        ?>
                        <?php $sql2 = $conn->query("SELECT COUNT(`likes_id`) AS FRAME_RATING FROM `likes` WHERE freind_req_to = '" . $row['username'] . "'"); ?>
                        <div class="col-sm-8 column">
                            <div class="our-team ">
                                <div class="picture">
                                    <img src="uploads/<?php echo $row['profile_pic'] ?>" class="img-circle" width="136" height="136" alt="profile picture" />
                                </div>
                                <div class="team-content">
                                    <h5 class="name"><?php echo $row['username']; ?></h5>
                                    <a class="btn btn-default" href="more.php?users_id=<?php echo $row['users_id'] ?>&username=<?php echo $row['username']; ?>">More</a>
                                </div>
                                <p>User Rating
                                    <?php
                                            $row2 = $sql2->fetch(PDO::FETCH_ASSOC);
                                            if ($row2['FRAME_RATING'] == 0) {
                                                ?>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                    <?php
                                            }
                                            if ($row2['FRAME_RATING'] == 1) {
                                                ?>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                    <?php
                                            }
                                            if ($row2['FRAME_RATING'] == 2) {
                                                ?>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                    <?php
                                            }
                                            if ($row2['FRAME_RATING'] == 3) {
                                                ?>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                    <?php
                                            }
                                            if ($row2['FRAME_RATING'] == 4) {
                                                ?>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star"></span>
                                    <?php
                                            }
                                            if ($row2['FRAME_RATING'] >= 5) {
                                                ?>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                    <?php
                                            }
                                            ?>

                                </p>
                            </div>
                        </div>
                <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>
</body>

</html>