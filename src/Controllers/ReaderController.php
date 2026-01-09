<?php
    namespace Controllers;

    use data\Data;
    use Core\Controller;


    class ReaderController extends Controller
    {
        public function index()
        {
            if (!(isset($_SESSION['user']) && $_SESSION['user']['role'] === 'reader')) {
                header("Location: /");
                exit;
            }
            $this->render("display",
                [
                    'title' => "reader",
                ]
                );
        }

        public static function liker_article()
        {
            $conn = Data::getInstance()->connection();
            $article_id = $_POST['article_id'];
            $user_id = $_POST['user_id'];

            $query = "INSERT INTO article_likes (user_id, article_id) VALUES (?,?)";
            $statement = $conn->prepare($query);
            $statement->execute([$user_id,$article_id]);

            header("Location: /display");
            exit;
        }

        public static function ajouter_commentaire()
        {
            $conn = Data::getInstance()->connection();
            $commentaire = $_POST['commentaire'];
            $reader_id = $_POST['reader_id'];
            $article_id = $_POST['article_id'];

            $query = "INSERT INTO commentaires (text, article_id, user_id) VALUES(?,?,?)";

            $statement = $conn->prepare($query);
            $statement->execute([$commentaire,$article_id, $reader_id]);

            header("Location: /display");
            exit;

        }
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['like']))
    {
        ReaderController::liker_article();
        
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ajouter']))
    {
        ReaderController::ajouter_commentaire();
        
    }

?>