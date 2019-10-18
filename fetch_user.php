<?php


    include 'classes/db_conn.php';
    $conn = new Database;
   
    // ini_set('display_errors;1');
    // ini_set('display_startup_errors;1');
    // error_reporting(E_ALL);
    session_start();
    


    
    function fetch_user_last_activity($user_id, $connect)
    {
        $sql = " SELECT * FROM login_details WHERE users_id = '$user_id' ORDER BY last_activity DESC LIMIT 1";
       
        $user = $connect->query($sql);  
        $result = $user->fetchAll(PDO::FETCH_ASSOC);
        foreach($result as $row)
        {
            return $row['last_activity'];
        }
    }

    function fetch_user_chat_history($from_user_id, $to_user_id, $connect)
    {
        $sql = "SELECT * FROM chat_message 
        WHERE (from_user_id = '".$from_user_id."'
        AND to_user_id = '".$to_user_id."')
        OR (from_user_id = '".$to_user_id."'
        AND to_user_id = '".$from_user_id."') 
        ORDER BY timestamp DESC
        ";

        $statement = $connect->prepare($sql);
        $statement->execute();

        $user = $connect->query($sql);  
        $result = $user->fetchAll(PDO::FETCH_ASSOC);
        $result = $statement->fetchAll();
        $output = '<ul class="list-unstyled">';
        foreach($result as $row)
        {
            $user_name = '';
            if ($row["from_user_id"] == $from_user_id)
            {
                $user_name = '<b class="text-success">You</b>';
            }
            else
            {
                $user_name = '<b class="text-danger">'.get_user_name($row['from_user_id'], $connect).'</b>';      
            }
            $output .= '<li style="border-bottom:1px dotted #ccc">
                <p>'.$user_name.' - '.$row['chat_message'].'
                    <div align="right">
                        - <small><em> '.$row['timestamp'].'</em><small>
                    </div>
                </p>
            </li>
            ';
        }
        $output .= '</ul>';
        return $output;
    }

    function get_user_name($user_id, $connect)
    {
        $sql = " SELECT * FROM login_details WHERE users_id = '$user_id' ORDER BY last_activity DESC LIMIT 1";
        $statement = $connect->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll();
        foreach($result as $row)
        {
            return $row['username'];
        }
    }

    


    
   
   $sql = ("SELECT * FROM users WHERE username != '".$_SESSION['username']."'");

    $user = $conn->query($sql);  
    $result = $user->fetchAll(PDO::FETCH_ASSOC);

    $output = '
                <table class="table table-bordered table-striped">
                    <tr>
                        <td>Username</td>
                        <td>Status</td>
                        <td>Action</td>
                    </tr>
                ';

                foreach($result as $row)
                {
                    $status = "";
                    $current_timestamp = strtotime(date('Y-m-d H:i:s').'-10 second');
                    $current_timestamp = date('Y-m-d H:i:s', $current_timestamp);
                    $user_last_activity = fetch_user_last_activity($row['users_id'], $conn);
                    if ($user_last_activity > $current_timestamp)
                    {
                        $status = '<span class="label label-success">Online<span>';
                    }
                    else
                    {
                        $status = '<span class="label label-danger">Offline<span>';
                    }
                    $output .='
                    <tr>
                        <td>'.$row['username'].'</td>
                        <td>'.$status.'</td>
                        <td><button type="button" class="btn btn-info btn-xs
                                start_chat" data-touserid="'.$row['users_id'].'"
                                data-tousername="'.$row['username'].'">start
                                Chat</button></td>
                    </tr>   
                    ';
                }
    $output .= '</table>';
    
    echo $output;
