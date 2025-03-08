<?php 
    include "../config/db.php";
    include "../models/StudentModel.php";

    class StudentController {
        private $studentModel;

        public function __construct() {
            $database = new Database();
            $db = $database->connect();

            $this->studentModel = new Student($db);
        }

        // ** this function does not accept parameters, it assigns them
        // ** to the StudentModel instance
        // ** then it calls $this->studentModel->create() to insert them into the db
        public function create($studentname, $studentid, $studentemail) {
            $this->studentModel->studentname = $studentname;
            $this->studentModel->studentid = $studentid;
            $this->studentModel->studentemail = $studentemail;

            return $this->studentModel->create();
        }

        public function read() {
            return $this->studentModel->read();
        }

        public function delete($studentid) {
            $this->studentModel->studentid = $studentid;

            return $this->studentModel->delete();
        }
    }




?>