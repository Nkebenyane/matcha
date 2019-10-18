<?php
class LoginSystem{
    public function login($username, $password){

        if (!empty($username) && !empty($password)){
            $conn = new Database;
    
            $sql = $conn->query("SELECT * FROM users WHERE username = '".$username."' AND pwd = '".$password."'");
            $count = $sql->rowCount();
            
            if ($count == 1){
                header('location:home.php');
                $_SESSION['username'] =  $username;
            }else{
                echo'
                    <script>
                    window.onload = function() {
                        alert("You have entered incorrect credentials ");
                        location.href = "login.php";  
                    }
                    </script>
                ';
            }
        }else{
            echo'
            <script>
            window.onload = function() {
                alert("Data Not Recieved");
                location.href = "login.php";  
            }
            </script>
        ';
        }
    }

}
?>