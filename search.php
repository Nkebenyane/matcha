<?php
//   include 'classes/db_conn.php';
$conn = new Database;
//   session_start();

$output = "";

if (isset($_POST['submit'])) {

    $search = $_POST['search'];
    $search = preg_replace("#[^0-9a-z]#i", "", $search);

    $sql = $conn->query("SELECT * FROM user_profile WHERE age LIKE '" . $search . "' OR username LIKE '" . $search . "' OR locations LIKE '" . $search . "'");
    $count = $sql->rowCount();
    if ($search == $_SESSION['username']) {
        $output = "You can not search your self you are loged in fool";
    } else if ($count == 0) {
        $output = "There was no search results";
    } else {
        while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
            $username = $row['username'];
            $users_id = $row['users_id'];

            $output .= '<table class="table table-hover">';
            $output .= '<tr>';
            $output .= '<th>Username</th>';
            $output .= '<th>Age</th>';
            $output .= '<th>Location</th>';
            $output .= '<th>Gender</th>';
            $output .= '</tr>';

            $output .= '<tr>';
            $output .= '<td><a href="more.php?users_id=' . $users_id . '&username=' . $username . '" >' . $username . '</a> </td>';
            $output .= '<td> ' . $row['age'] . '</td>';
            $output .= '<td> ' . $row['locations'] . '</td>';
            $output .= '<td> ' . $row['gender'] . '</td>';
            $output .= '</tr>';
            $output .= '</table>';
        }
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Matcha_</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
    <!-- <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css"> -->
    <!-- <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css"> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- <link rel="stylesheet" type="text/css" media="screen" href="css/index.css"> -->
</head>

<body>
        <form class="navbar-form navbar-left" name="logout" action="" method="post">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search and Filter" name="search">
                <div class="input-group-btn">
                    <input class="btn btn-default" type="submit" name="submit"><span class="glyphicon glyphicon-edit">
                        <i class="glyphicon glyphicon-search"></i>
                </div>
            </div>
        </form>
        <?php print("$output"); ?>
</body>

</html>