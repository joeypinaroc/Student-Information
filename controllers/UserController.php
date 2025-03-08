<?php
    include "config/db.php";
    include "models/UserModel.php";

    class UserController {
        private $userModel;

        public function __construct() {
            $database = new Database();
            $db = $database->connect();

            $this->userModel = new User($db); // construct User object with db connection variable
        }
    }


?>