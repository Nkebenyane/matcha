<?php

include '../classes/db_conn.php';

$conn = new Database;

session_start();

echo 'Hello World!';

$data = array(
    ':to_user_id'  => $_POST['to_user_id'],
    ':from_user_id'  => $_SESSION['users_id'],
    ':chat_message'  => $_POST['chat_message'],
    ':status'   => '1'
);

$query = "INSERT INTO chat_message (to_user_id, from_user_id, chat_message, status) 
VALUES (:to_user_id, :from_user_id, :chat_message, :status)
";

$statement = $conn->prepare($query);

if ($statement->execute($data)) {
    echo fetch_user_chat_history($_SESSION['user_id'], $_POST['to_user_id'], $conn);
}
