<?php
      
        // include 'classes/db_conn.php';
      $conn = new Database;

//    session_start();

    $output = "";
   
   if (isset($_POST['accept']))
   {
       $accept = $_POST['accept'];
       
       $sql = ("UPDATE likes SET Accept = '1' WHERE freind_req_from = '".$accept."' AND freind_req_to = '".$_SESSION['username']."'");
       $conn->query($sql);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

      <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css"> -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <title>Document</title>
</head>
<body>
        <div class="contaner">
            <p> People who liked you</p>
            <table class="table table-hover">
                <?php
                    $sql = $conn->query("SELECT * FROM likes WHERE freind_req_to = '".$_SESSION['username']."' AND Accept = '0'");
                    $count = $sql->rowCount();
                        if ($count == 0)
                        {
                            $output .= '<p>no one likes you yet</p>';
                        }else if ( $count > 0){

                        while ($row = $sql->fetch(PDO::FETCH_ASSOC))
                        {
                            extract($row);
                            ?> 
                        <tbody>

                            <form method="post">
                                <tr>
                                    <td><?php echo $row['freind_req_from']?></td>
                                    <td><input class="btn btn-success" type="submit" name="accept" value="<?php echo $row['freind_req_from']?>"/></td> 
                                </tr>
                            </form>
                        </tbody>
                    <?php
                    }
                    }
                    ?>
                    <?php print($output); ?>
            </table>
        </div>
    
</body>
</html>