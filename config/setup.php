<?php
// include 'classes/db_conn.php';

$conn = new Database;

        $sql = "CREATE TABLE IF NOT EXISTS users (
                users_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
                username VARCHAR(30) NOT NULL,
                firstname VARCHAR(30) NOT NULL,
                lastname VARCHAR(30) NOT NULL,
                email VARCHAR(50),
                pwd VARCHAR(255) NOT NULL,
                confirmed INT(11),
                confirmed_code INT(11),
                notify INT(6),
                reg_date TIMESTAMP)";
        
        $conn->query($sql);

        $sql = "CREATE TABLE IF NOT EXISTS user_profile (
                profile_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                users_id INT(6) UNSIGNED,
                username VARCHAR(30) NOT NULL,
                profile_pic VARCHAR(255),
                gender VARCHAR(30),
                age INT(6),
                biography VARCHAR(255),
                locations VARCHAR(255),
                FOREIGN KEY (users_id) REFERENCES users(users_id)
                ON DELETE CASCADE ON UPDATE CASCADE
                )"
                ;
        $conn->query($sql);

        $sql = "CREATE TABLE IF NOT EXISTS pictures (
                picture_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                users_id INT(6) UNSIGNED,
                username VARCHAR(30) NOT NULL,
                profile_pic VARCHAR(255),
                FOREIGN KEY (users_id) REFERENCES users(users_id)
                ON DELETE CASCADE ON UPDATE CASCADE
                )"
                ;
        $conn->query($sql);

        $sql = "CREATE TABLE IF NOT EXISTS interest (
                interest_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                users_id INT(6) UNSIGNED,
                interest VARCHAR(50),
                FOREIGN KEY (users_id) REFERENCES users(users_id)
                ON DELETE CASCADE ON UPDATE CASCADE
                )"
                ;
        $conn->query($sql);


        $sql = "CREATE TABLE IF NOT EXISTS login_details (
                login_details_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                users_id INT(6) UNSIGNED,
                last_activity TIMESTAMP,
                FOREIGN KEY (users_id) REFERENCES users(users_id)
                ON DELETE CASCADE ON UPDATE CASCADE
                )"
                ;
        $conn->query($sql);

 
        $sql = "CREATE TABLE IF NOT EXISTS chat_message (
                chat_message_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                to_chat_id INT(6) UNSIGNED,
                from_chat_id INT(6) UNSIGNED,
                chat_message VARCHAR(255),
                timestamp TIMESTAMP,
                FOREIGN KEY (to_chat_id) REFERENCES users(users_id)
                ON DELETE CASCADE ON UPDATE CASCADE
                )"
                ;
        $conn->query($sql);

        $sql = "CREATE TABLE IF NOT EXISTS likes (
                likes_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                users_id INT(6) UNSIGNED,
                freind_req_from VARCHAR(50),
                freind_req_to VARCHAR(50),
                Accept INT(6),
                FOREIGN KEY (users_id) REFERENCES users(users_id)
                ON DELETE CASCADE ON UPDATE CASCADE
                )"
                ;
        $conn->query($sql);
?>