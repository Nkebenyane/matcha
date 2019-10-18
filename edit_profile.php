<?php
include 'header.php';
$conn = new Database;

if (!isset($_SESSION['username'])) {
    header('location: index.php');
}

$output = "";

if (isset($_POST['btn-add'])) {

    $users_id = $_GET['users_id'];
    $age = $_POST['age'];

    $sex = $_POST['gender'];
    $users_name = $_POST['username'];
    $biography = $_POST['biography'];
    $locations = $_POST['locations'];

    $images = $_FILES['profile']['name'];
    $tmp_dir = $_FILES['profile']['tmp_name'];
    $imageSize = $_FILES['profile']['size'];

    $upload_dir = 'uploads/';
    $imgExt = strtolower(pathinfo($images, PATHINFO_EXTENSION));
    $valid_extensions = array('jpej, jpg, png, gif, pdf,');
    $picProfile = rand(1000, 1000000) . "." . $imgExt;

    move_uploaded_file($tmp_dir, $upload_dir . $picProfile);

    $sql = $conn->query("SELECT * FROM user_profile WHERE users_id = '" . $users_id . "'");
    $count = $sql->rowCount();
    if ($count === 0) {
        $sql = "INSERT INTO user_profile (users_id, username, profile_pic, gender, age, biography, locations)
        VALUES ('" . $users_id . "', '" . $users_name . "', '" . $picProfile  . "','" . $sex . "','" . $age . "','" . $biography . "','" . $locations . "')";
        $conn->query($sql);
        $output = "I am trying to make you work";
    } else if ($count === 1) {

        if (!empty($images)) {
            $sql = "UPDATE user_profile 
            SET profile_pic = '" . $picProfile . "'
            WHERE users_id = '" . $users_id . "'";
            $conn->query($sql);
            $output = "your profile picture is modified";
        }
        if (!empty($_POST['gender'])) {
            $sex = $_POST['gender'];

            $sql = "UPDATE user_profile 
            SET gender = '" . $sex . "'
            WHERE users_id = '" . $users_id . "'";
            $conn->query($sql);
            $output = "your gender is modified";
        }
        if (!empty($users_name)) {
            $sql = "UPDATE user_profile 
            SET username = '" . $users_name . "'
            WHERE users_id = '" . $users_id . "'";
            $conn->query($sql);
            $output = "your username is modified";
        }
        if (!empty($age)) {
            $sql = "UPDATE user_profile 
            SET age = '" . $age . "'
            WHERE users_id = '" . $users_id . "'";
            $conn->query($sql);
            $output = "your age is modified";
        }
        if (!empty($biography)) {
            $sql = "UPDATE user_profile 
            SET biography = '" . $biography . "'
            WHERE users_id = '" . $users_id . "'";
            $conn->query($sql);
            $output = "your biography is modified";
        }
        if (!empty($locations)) {
            $sql = "UPDATE user_profile 
            SET locations = '" . $locations . "'
            WHERE users_id = '" . $users_id . "'";
            $conn->query($sql);
            $output = "your location is modified";
        }
        if (!empty($_POST['interest'])) {
            foreach ($_POST['interest'] as $interest) {

                $sql = "INSERT INTO interest (users_id, interest) VALUES ('" . $users_id . "','" . $interest . "')";
                $conn->query($sql);
            }
        }
        if (empty($users_name) && empty($picProfile) && empty($sex) && empty($age) && empty($biography) && empty($locations)) {
            $output = "nothing to updated";
        }
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Edit Profile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        .frame {
            height: 220px;
            width: 220px;
            border-radius: 40px;
            background-color: gray;
        }

        #upload {
            background-image: url('') no-repeat top center fixed;
            black url(/images/back.jpg) no-repeat top center fixed;
            -webkit-background-size: cover;
            background-size: cover;
            display: inline-block;
            height: 200px;
            width: 200px;
            border-radius: 100px;
            margin: 10px;
        }
    </style>
</head>

<body>
    <br />
    <div class="container-fluid text-center">
        <h1>Edit your profile</h1>
        <p>Find your love</p>
    </div>
    <div class="container">
        <div class="row">
            <?php print($output); ?>
            <div class="frame">
                <div class="col-sm-3" id="upload">
                </div>
            </div>
            <br />
            <div class="col-sm-10">

                <form method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-sm-5">
                            <input type="file" name="profile" id="try_this" class="form-control" onchange="showImage.call(this)" accept=*/image/> </div> </div> <script>
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
                        </div>

                    </div>
                    <div>
                        <hr />
                        <div class="container">

                            <!------Gender------->
                            <label class="control-label col-sm-2">Gender:</label>
                            <div class="col-sm-10">
                                <label class="radio-inline">
                                    <input type="radio" name="gender" value="male">Male
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="gender" value="female">Female
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="gender" value="other">Other
                                </label>
                            </div>
                            <br />
                            <br />

                            <!------Username----------->
                            <label class="control-label col-sm-2">Username:</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="username" value="<?php echo $_SESSION['username']?>"/><br />
                            </div>
                            <!------Age----------->
                            <label class="control-label col-sm-2">Age:</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="age" /><br />
                                <br />
                            </div>
                            <!------Location-------->

                            <label class="control-label col-sm-2">Location:</label>
                            <div class="col-sm-10">

                                <input class="form-control" type="text" name="locations" /><br />
                            </div>
                            <!------Biography------->
                            <label class="control-label col-sm-2">biography:</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" rows="6" id="comments" type="text" name="biography"></textarea>
                            </div>
                            <br />
                            <br />

                            <!------Interests------->
                            <label class="control-label col-sm-2">Interest:</label>
                            <div class="row">
                                <div class="col-sm-2">
                                    <p><input type="checkbox" name="interest[]" value="Man" /> Man</p>
                                    <p><input type="checkbox" name="interest[]" value="Woman" /> Woman</p>
                                </div>
                                <div class="col-sm-2">
                                    <p><input type="checkbox" name="interest[]" value="Family" /> Family</p>
                                    <p><input type="checkbox" name="interest[]" value="Dancing" /> Dancing</p>
                                </div>
                                <div class="col-sm-2">
                                    <p><input type="checkbox" name="interest[]" value="Personal growth" /> Personal growth</p>
                                    <p><input type="checkbox" name="interest[]" value="Work / Career" /> Work / Career</p>
                                </div>
                                <div class="col-sm-2">
                                    <p><input type="checkbox" name="interest[]" value="Politics" /> Politics</p>
                                    <p><input type="checkbox" name="interest[]" value="Travel" /> Travel</p>
                                </div>
                            </div>

                            <!------Submit button---->
                            <div class="col-sm-3">
                                <button class="btn btn-default" type="submit" name="btn-add">upload</button>
                            </div>
                </form>
            </div>
            <script src="js/upload_img.js"></script>
</body>

</html>