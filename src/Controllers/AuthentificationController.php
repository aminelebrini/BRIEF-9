<?php
namespace Controllers;

use Core\Controller;
use data\Data;

class AuthentificationController extends Controller{

    public function index()
    {
        $this->render('home',
            [
                'title' =>'home'
            ]); 
    }

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

        if($user['is_blocked'] === 1)
        {
            echo '<div class="fixed top-[10%] left-[50%] text-white">le compte est bloque</div>';
            exit;
        }
        else{

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
                    $_SESSION['author'] = $user;
                    header("Location: /author");
                    exit;
                }
            } else {
                echo "Les données sont invalides !";
            }
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

        $passwordHashed = password_hash($password, PASSWORD_BCRYPT);
        $registreQuery = "INSERT INTO users(first_name, last_name, email, role, password) VALUES(?,?,?,?,?)";
        $statement = $conn->prepare($registreQuery);

        if($statement->execute([$firstname, $lastname, $email, 'reader', $passwordHashed])) {
        
            $_SESSION['user'] = [
                'first_name' => $firstname,
                'last_name' => $lastname,
                'email' => $email,
                'role' => 'reader'
            ];
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
        header("Location: /");
        exit;
        
    } elseif(isset($_POST['login'])) {
        AuthentificationController::login();
    }
}
if(isset($_POST['logout'])) {
    AuthentificationController::logout();
}
