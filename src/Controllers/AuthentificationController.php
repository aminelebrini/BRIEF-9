<?php
namespace Controllers;

use data\Data;

class AuthentificationController {

    public static function login()
    {
        if(!isset($_POST['email']) || !isset($_POST['password'])) return;

        $email = $_POST['email'];
        $password = $_POST['password'];

        $conn = Data::getInstance()->connection();
         

        $query = "SELECT * FROM users WHERE email = ?";
        $statement = $conn->prepare($query);
        $statement->execute([$email]);
        $user = $statement->fetch(\PDO::FETCH_ASSOC);

        if($user && password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user;

            if($user['role'] === 'reader') {
                header("Location: /display");
                exit;
            }

            if($user['role'] === 'admin') {
                header("Location: /admindash");
                exit;
            }

            if($user['role'] === 'author')
            {
                header("Location: /author");
                exit;
            }
        } else {
            echo "Les données sont invalides !";
        }
    }

    public static function signup()
    {
        if(!isset($_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['password'])) return;

        $firstname = $_POST['nom'];
        $lastname = $_POST['prenom'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $conn = Data::getInstance()->connection();

        $existQuery = "SELECT * FROM users WHERE email = ?";
        $statement = $conn->prepare($existQuery);
        $statement->execute([$email]);

        if ($statement->fetch()) {
            echo '<div class="bg-red-100 fixed top-[15%] left-[50%] border border-red-400 text-red-700 px-4 py-3 rounded mb-4" role="alert">
                    Cet email est déjà utilisé.
                  </div>';
            return false; 
        }

        $passwordHashed = password_hash($password, PASSWORD_BCRYPT);
        $registreQuery = "INSERT INTO users(first_name, last_name, email, role, password) VALUES(?,?,?,?,?)";
        $statement = $conn->prepare($registreQuery);

        if($statement->execute([$firstname, $lastname, $email, 'reader', $passwordHashed])) {
            echo '<div class="bg-green-600 fixed top-[15%] left-[50%] border border-red-400 text-red-700 px-4 py-3 rounded mb-4" role="alert">
                    Inscription réussie !
                  </div>';

            $_SESSION['user'] = [
                'first_name' => $firstname,
                'last_name' => $lastname,
                'email' => $email,
                'role' => 'reader'
            ];
            header("Location: /home");
            exit;
            
        }
    }
    public static function logout()
    {
        session_destroy();
        header("Location: /");
        exit;
    }
}

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(isset($_POST['signup'])) {
        AuthentificationController::signup();
    } elseif(isset($_POST['login'])) {
        AuthentificationController::login();
    }
}
if(isset($_POST['logout'])) {
    AuthentificationController::logout();
}
