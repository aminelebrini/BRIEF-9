<?php
    namespace Controllers;

    use data\Data;
    use Core\Controller;


    class ReaderController extends Controller
    {
        public function index()
        {
            
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
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['like'])
    {
        ReaderController::liker_article();
        
    }

?>