<?php
    include 'classes/db_conn.php';
    session_start();

    $conn = new Database;
    
    $users_id = $_GET['users_id'];
    $friend = $_GET['username'];
    $username = $_SESSION['username'];


    $sql = $conn->query("SELECT COUNT(`likes_id`) FROM `likes` WHERE freind_req_from = '$username' AND `freind_req_to` = '$friend'");
    $count = $sql->fetchColumn();

    if ($count == '1')
    {
        echo "<script>alert('you can not like more than once');window.location.href='home.php';</script>"; 
    }else if ($count != '1')
    {
        $sql = "INSERT INTO likes (users_id, freind_req_from, freind_req_to, Accept) VALUES ('".$users_id."', '".$username."','".$friend."','0') ";
        $conn->query($sql);
        header('location: home.php');
    }

?>