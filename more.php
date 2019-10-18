<?php

include 'header.php';
$conn = new Database;

$users_id = $_GET['users_id'];
$username = $_GET['username'];


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
<body>

    <div id="contact" class="container">
        <div class="container-fluid"></div>
            
    	<div class="tab-content no-border padding-24">
				<div id="home" class="tab-pane in active">
                    <div class="row">
                        <?php
                        $sql = $conn->query("SELECT * FROM user_profile WHERE users_id = '".$users_id."'");
                        $count = $sql->rowCount();
                        if ($count > 0)
                        {
                            while($row = $sql->fetch(PDO::FETCH_ASSOC))
                            {
                                extract($row);
                                ?>

                            <div class="col-xs-12 col-sm-3 center">
                                <span class="profile-picture"> 
                                        <img class="editable img-responsive" alt=" Avatar" id="avatar2" src="uploads/<?php echo $row['profile_pic'];?>"> 
                                </span>

                                <div class="space space-4"></div>
                                    <a href="like.php?users_id=<?php echo $row['users_id']?>&username=<?php echo $row['username']?>" class="btn btn-sm btn-block btn-primary">
                                    <i class="ace-icon fa fa-envelope-o bigger-110"></i>
                                    <span class="bigger-110">Like</span>
                                    </a>
                                </div>

                                <div class="col-xs-12 col-sm-9">
                                    <h4 class="blue">
                                        <span class="middle"><?php echo $row['username'];?></span>
                                    </h4>
                                    <div class="profile-user-info">
                                  
                                        <div class="profile-info-row">
                                            <div class="profile-info-name">Age</div>
                                            <div class="profile-info-value">
                                                <?php echo $row['age'];?>
                                            </div>
                                        </div>
                                        <div class="profile-info-row">
                                            <div class="profile-info-name">Gender</div>
                                            <div class="profile-info-value">
                                                <?php echo $row['gender'];?>
                                            </div>
                                        </div>
                                        <div class="profile-info-row">
                                            <div class="profile-info-name">Location</div>
                                            <div class="profile-info-value">
                                                <?php echo $row['locations'];?>
                                            </div>
                                        </div>


                                              <div class="profile-info-row">
                                            <div class="profile-info-name">Interest</div>

                                            <div class="profile-info-value">
                                                <?php
                                                    $sql = $conn->query("SELECT * FROM interest WHERE users_id = '".$users_id."'");
                                                    while ($row = $sql->fetch(PDO::FETCH_ASSOC)){
                                                ?>
                                                    <?php echo "#".$row['interest'].", ";?>
                                                <?PHP
                                                    }
                                                    ?>
                                            </div>
                            </div>	
                    </div>
        </div>
                        
		<div class="col-xs-12 col-sm-12">
			<div class="widget-box transparent">
				<div class="widget-header widget-header-small">
					<h4 class="widget-title smaller">
					    <i class="ace-icon fa fa-check-square-o bigger-110"></i>
							Little About Me
                    </h4>
				</div>
			    <div class="widget-body">
			    <div class="widget-main">
                    <p>
                        <?php echo $row['biography'];?>
                    </p>
                </div>
					</div>
				</div>
            </div>
            <?php
                 }
                     }
            ?>
        </div>
        <!---------------------------------Displaying imagies of the pictures table------------------------>
        <div class="row">
            <?php
                $sql = $conn->query("SELECT * FROM pictures WHERE username = '".$username."'");
                $conn = $sql->rowCount();
                if ($count > 0)
                {
                    while ($row = $sql->fetch(PDO::FETCH_ASSOC))
                    {
                        extract($row);
                        ?>

                         <div class="col-sm-4">
                            <p><img src="uploads/<?php echo $row['profile_pic'];?>" class="" height="200" width="300" alt="profile picture"></p> 
                         </div>
            <?php
                }
            }
            ?>
        </div>
        
    </div>
</body>
</html>