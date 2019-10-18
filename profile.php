<?php
include 'header.php';

$conn = new Database;
$users_id = $_GET['users_id'];
$username = $_SESSION['username'];


if (!isset($_SESSION['username'])) {
    header('location: index.php');
}

if (isset($_POST['add-img'])) {
    $images = $_FILES['profile']['name'];
    $tmp_dir = $_FILES['profile']['tmp_name'];
    $imageSize = $_FILES['profile']['size'];

    $upload_dir = 'uploads/';
    $imgExt = strtolower(pathinfo($images, PATHINFO_EXTENSION));
    $valid_extensions = array('jpej, jpg, png, gif, pdf,');
    $picProfile = rand(1000, 1000000) . "." . $imgExt;

    move_uploaded_file($tmp_dir, $upload_dir . $picProfile);

    $sql = $conn->query("SELECT profile_pic FROM pictures WHERE users_id = '" . $users_id . "'");
    $i = 0;
    while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
        $i++;
    }
    if ($i < 4) {

        $sql = "INSERT INTO pictures (users_id, username, profile_pic)
                VALUES('" . $users_id . "','" . $username . "','" . $picProfile . "')";
        $conn->query($sql);
    }
}

if (isset($_POST['picture_id'])) {

    $t = $_POST['picture_id'];

    $sql = ("DELETE FROM pictures WHERE picture_id = '" . $t . "' AND username = '" . $username . "' ");
    $conn->query($sql);
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" media="screen" href="css/more.css">
    <link rel="stylesheet" type="text/css" media="screen" href="css/index.css">
</head>

<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">
    <div id="contact" class="container">
        <div class="container-fluid"></div>
        <div class="tab-content no-border padding-24">
            <div id="home" class="tab-pane in active">
                <div class="row">
                    <?php
                    $sql = $conn->query("SELECT * FROM user_profile WHERE username = '" . $username . "'");
                    $count = $sql->rowCount();
                    if ($count > 0) {
                        while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
                            extract($row);
                            ?>

                            <div class="col-xs-12 col-sm-3 center">
                                <span class="profile-picture">
                                    <img class="editable img-responsive" alt=" Avatar" id="avatar2" src="uploads/<?php echo $row['profile_pic']; ?>">
                                </span>
                                <div class="space space-4"></div>
                            </div>

                            <div class="col-xs-12 col-sm-9">
                                <h4 class="blue">
                                    <span class="middle"><?php echo $row['username']; ?></span>
                                </h4>
                                <div class="profile-user-info">
                                    <div class="profile-info-row">
                                        <div class="profile-info-name">Age</div>
                                        <div class="profile-info-value">
                                            <?php echo $row['age']; ?>
                                        </div>
                                    </div>
                                    <div class="profile-info-row">
                                        <div class="profile-info-name">Gender</div>
                                        <div class="profile-info-value">
                                            <?php echo $row['gender']; ?>
                                        </div>
                                    </div>
                                    <div class="profile-info-row">
                                        <div class="profile-info-name">Location</div>
                                        <div class="profile-info-value">
                                            <?php echo $row['locations']; ?>
                                        </div>
                                    </div>
                            <?php
                                }
                            }
                            ?>
                            <div class="profile-info-row">
                                <div class="profile-info-name">Interest</div>

                                <div class="profile-info-value">
                                    <?php
                                    $sql = $conn->query("SELECT * FROM interest WHERE users_id = '" . $users_id . "'");
                                    while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
                                        ?>
                                        <?php echo "#" . $row['interest'] . ", "; ?>
                                    <?PHP
                                    }
                                    ?>
                                </div>
                            </div>
                                </div>
                            </div>
                </div>
                <div id="down" class="container-fluid text-center">
                    <div class="col-sm-10">
                        <form method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-sm-5">
                                    <input type="file" name="profile" id="try_this" class="form-control" onchange="showImage.call(this)" accept=*/image/> </div> <script>
                                    function showImage()
                                    {
                                    if (this.files && this.files[0])
                                    {
                                    var obj = new FileReader();
                                    obj.onload = function(data){
                                    var image = document.getElementById("image");
                                    image.src = data.target.result;
                                    image.style.display = "block";
                                    }
                                    obj.readAsDataURL(this.files[0]);
                                    }
                                    }
                                    </script>
                                    <div class="col-sm-3">
                                        <button class="btn btn-default" type="submit" name="add-img">upload</button>
                                    </div>
                                </div>

                                <br />
                            </div>
                            <div class="row ">
                                <?php
                                $sql = $conn->query("SELECT * FROM pictures WHERE username = '" . $username . "'");
                                $count = $sql->rowCount();
                                if ($count > 0) {
                                    while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
                                        extract($row);

                                        ?>
                                        <div class="col-sm-4">
                                            <p><img src="uploads/<?php echo $row['profile_pic']; ?>" height="200" width="300" alt="profile picture"></p>
                                            <p><input class="btn btn-default" type="submit" name="picture_id" value="<?PHP echo $row['picture_id'] ?>" /></p>

                                        </div>
                                <?php
                                    }
                                }
                                ?>
                            </div>
                        </form>
                        <a href="#myPage" title="To Top">
                            <span class="glyphicon glyphicon-chevron-up"></span>
                        </a>
                        <p>Made By <a href="#" title="Visit w3schools">www.Maipato.com</a></p>
                    </div>
                    <script src="js/upload_img.js"></script>
                </div>
        </div>

</body>

</html>