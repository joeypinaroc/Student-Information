<?php
    class Student {
        private $conn;

        public $studentname;
        public $studentid;
        public $studentemail;

        public function __construct($db) {
            $this->conn = $db;
        }

        public function create() {
            $query = "INSERT INTO students(studentname, studentid, studentemail) VALUES (?, ?, ?)";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("sss", $this->studentname, $this->studentid, $this->studentemail);

            return $stmt->execute();
        }

        public function read() {
            $query = "SELECT * FROM students";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            return $stmt->get_result();
        }

        public function delete() {
            $query = "DELETE FROM students WHERE studentid = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("s", $this->studentid);

            return $stmt->execute();
        }
    }
?>