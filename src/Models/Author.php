<?php

namespace Models;

use data\connect_db\User;

    class Author extends User{

        public function __construct($id = '', $firstname = '', $lastname = '', $email = '', $role = 'author', $password = '')
        {
            parent::__construct($id, $firstname, $lastname, $email, $role, $password);
        }
    }

?>