<?php 
    class User {
        private $conn; // connection string

        public $username;
        public $email;
        public $password;

        // database connection is handled separately in db.php
        // __construct($db) ensures User model can execute database queries
        // no need to establish a new db connection everytime User is created
        public function __construct($db) {
            $this->conn = $db;
        }

        public function create() {
            $query = "INSERT INTO users(username, email, password) VALUES(?, ?, ?)"; // SQL query, prepared statement
            $stmt = $this->conn->prepare($query); // prepares the SQL statement to be executed safely
            $stmt->bind_param("sss", $this->username, $this->email, $this->password); // bind parameters

            return $stmt->execute(); // execute query
        }

        // **used different method similar to class
        // function to login, passes the password parameter and check if match
        // public function login($password) {
        //     $query = "SELECT password FROM users WHERE email = ?";
        //     $stmt = $this->conn->prepare($query);
        //     $stmt->bind_param("s", $this->email);
        //     $stmt->execute();
        //     $result = $stmt->get_result();

        //     if($result->num_rows == 1) {
        //         $row = $result->fetch_assoc();
        //         if(password_verify($password, $row["password"])) return true;
        //     }
        //     return false; // invalid login
        // }


    }
?>