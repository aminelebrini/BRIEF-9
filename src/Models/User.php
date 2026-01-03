<?php
    namespace data\connect_db;

    
    abstract class User{
        private $id;
        private $firstname;
        private $lastname;
        private $email;
        private $role;
        private $password;

        protected $conn;

        public function __construct($conne, $id = '', $firstname = '', $lastname = '', $email = '', $role = 'reader', $password = '') {
        $this->conn = $conne;
        $this->id = $id;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->email = $email;
        $this->role = $role;
        $this->password = $password;
    }
        public function get_id(){
            return $this->id;
        }
        public function get_firstname(){
            return $this->firstname;
        }
        public function get_lastname(){
            return $this->lastname;
        }
        public function get_email(){
            return $this->email;
        }
        public function get_role(){
            return $this->role;
        }
    }
?>