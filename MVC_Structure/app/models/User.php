<?php
class User {
    private $db;
    public function __construct() {
        $this->db = new Database;
    }

  

    public function register($data) {
        $this->db->query('INSERT INTO donorreg (username, email, password,NID,contact,age,gender) VALUES(:username, :email, :password,:NID,:contact,:age,:gender)');

        //Bind values
        $this->db->bind(':username', $data['username']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);
        $this->db->bind(':NID', $data['NID']);
        $this->db->bind(':contact', $data['contact']);
        $this->db->bind(':age', $data['age']);
        $this->db->bind(':gender', $data['gender']);

        //Execute function
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function login($email, $password) {
        $this->db->query('SELECT * FROM donorreg WHERE email = :email');

        //Bind value
        $this->db->bind(':email', $email);

        $row = $this->db->single();

        $Password = $row->password;

        if (password_verify($password, $Password )) {
            return $row;
        } else {
            return false;
        }
    }

    //Find user by email. Email is passed in by the Controller.
    public function findUserByEmail($email) {
        //Prepared statement
        $this->db->query('SELECT * FROM donorreg WHERE email = :email');

        //Email param will be binded with the email variable
        $this->db->bind(':email', $email);
        $this->db->single();
        $rowDonor = $this->db->rowCount(); 

        //Check if email is already registered
        if($rowDonor > 0) {
            return true;
        } else {
            return false;
        }
    }
}
