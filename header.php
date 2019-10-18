<?php

include 'classes/db_conn.php';

session_start();

$conn = new Database;

function selectusers($query){
    
    $conn = new Database;
    $stmt=$conn->query($query);
    return $stmt->fetch();
}

$sql = "SELECT * FROM users where username ='".$_SESSION['username'] ."' LIMIT 1";
$data = selectusers($sql);

    $users_id = $data['users_id'];

    $sql = ("INSERT INTO login_details (users_id) VALUES ('".$users_id."')");
    $conn->query($sql);

if (isset($_POST['logout'])){
    session_start();
    session_destroy();

    header('location: index.php');
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Matcha_</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" media="screen" href="css/index.css">
    <style>
        
    </style>
</head>
<body>
    <nav class="navbar navbar-default navbar-fixed-top">
     
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">Matcha</a>
                </div>
               
                <form method="post" name="logout">
                    <div class="collapse navbar-collapse" id="myNavbar">
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="home.php?users_id=<?php echo $data['users_id'];?>"><span class="glyphicon glyphicon-home"></span>home</a></li>
                            <li><a href="edit_profile.php?users_id=<?php echo $data['users_id'];?>"><span class="glyphicon glyphicon-edit"></span>Profile</a></li>
                            <li><a href="profile.php?users_id=<?php echo $data['users_id'];?>"><span class="glyphicon glyphicon-user"></span>Profile</a></li>
                            <li><a href="chat.php?users_id=<?php echo $data['users_id'];?>"><img src="img/chat.png" width=20 height=20>Chat</a></li>
                            <li><a><input  class="btn-link" type="submit" name="logout" value="logout"/><span class="glyphicon glyphicon-log-out"></span></a></li>  
                            <li><a href="#" disabled><?php echo $_SESSION['username'];?></a></li>
                        </ul>
                    </div>
                </form>
               
     
    </nav>
</body>
</html>