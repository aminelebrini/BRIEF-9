<?php
    namespace Controllers;

    use data\Data;

    class AuthentificationController{

        public static function login()
        {
            if(!isset($_POST['email']) || !isset($_POST['password'])) return;

            $email = $_POST['email'];
            $password = $_POST['password'];

            $db = new Data();
            $conn = $db->connection();

            $query = "SELECT * FROM users WHERE email = ?";
            $statement = $conn->prepare($query);
            $statement->execute([$email]);
            $user = $statement->fetch(\PDO::FETCH_ASSOC);

            if($user && password_verify($password, $user['password'])) {
                $_SESSION['user'] = $user;
                header("Location: /display");
                exit;
            } else {
                echo "Les données sont invalides !";
            }
        }


        public static function signup($firstname, $lastname, $email,$password)
        {
            $db = new Data();
            $conn = $db->connection();

            $existQuery = "SELECT * FROM users WHERE email = ?";
            $statement = $conn->prepare($existQuery);
            $statement->execute([$email]);

                if ($statement->fetch()) {
                echo '<div class="bg-red-100 fixed top-[15%] left-[50%] border border-red-400 text-red-700 px-4 py-3 rounded mb-4" role="alert">
                    Cet email est déjà utilisé.
                </div>';
                return false; 
            }


            $passwordhached = password_hash($password, PASSWORD_BCRYPT);
            $registrequery = "INSERT INTO users(first_name, last_name, email, role, password) VALUES(?,?,?,?,?)";
            $statement = $conn->prepare($registrequery);
            if($statement->execute([$firstname, $lastname, $email, 'reader', $passwordhached]))
            {
                echo '<div class="bg-green-600 fixed top-[15%] left-[50%] border border-red-400 text-red-700 px-4 py-3 rounded mb-4" role="alert">
                        Inscription réussie !
                </div>';
            }

        }
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['signup']))
    {
        $firstname = $_POST['nom'] ?? null;
        $lastname = $_POST['prenom'] ?? null;
        $email = $_POST['email'] ?? null;
        $password = $_POST['password'] ?? null;


        if (AuthentificationController::signup($firstname, $lastname, $email, $password)) {
            header("Location: /home");
            exit;
        }
    }

    /*if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login']))
    {
        $email = $_POST['email'] ?? null;
        $password = $_POST['password'] ?? null;

        if(AuthentificationController::login($email,$password))
        {
            header("Location: /display");
            exit;
        }
    }*/

?>