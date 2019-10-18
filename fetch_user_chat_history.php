<?php

include '../classes/db_conn.php';

$conn = new Database;

session_start();

echo fetch_user_chat_history($_SESSION['user_id'], $_POST['to_user_id'], $conn);

?>