<?php

include 'classes/db_conn.php';
$conn = new Database;

ini_set('display_errors;1');
ini_set('display_startup_errors;1');
error_reporting(E_ALL);
session_start();

$sql = ("UPDATE login_details SET last_activity = now() WHERE login_details_id = '".$_SESSION['login_details_id']."'");
$conn->query($sql);

?>