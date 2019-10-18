<?php
class user
{
    private $username;
    private $firstname;
    private $lastname;
    private $email;
    private $password;

    public function __construct($uname,$fname, $lname, $mail, $pwd)
    {
            $this->username = $uname;
            $this->firstname = $fname;
            $this->lastname = $lname;
            $this->email = $mail;
            $this->password = $pwd;
    }
    public function getusername()
    {
            return $this->username;
    }
    public function getfirstname()
    {
            return $this->firstname;
    }
    public function getlastname()
    {
            return $this->lastname;
    }
    public function getemail()
    {
            return $this->email;
    }
    public function getpassword()
    {
            return $this->password;
    }
}
?>