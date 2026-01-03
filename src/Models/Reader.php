<?php

    namespace Models;
    
    use data\connect_db\User;

   class Reader extends User
   {    
        public function __construct($id = '', $firstname = '', $lastname = '', $email = '', $role , $password = '')
        {
            parent::__construct($id = '', $firstname = '', $lastname = '', $email = '', 'reader' , $password = '');
        }
   }
?>