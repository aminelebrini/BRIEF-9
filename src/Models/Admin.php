<?php

namespace Models;

use data\connect_db\User;

    class Admin extends User{

        public function __construct($id = '', $firstname = '', $lastname = '', $email = '', $role = 'admin', $password = '')
        {
            parent::__construct($id, $firstname, $lastname, $email, $role, $password);
        }
    }

?>