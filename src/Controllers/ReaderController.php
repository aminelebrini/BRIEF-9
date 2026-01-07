<?php
    namespace Controllers;

    use data\Data;
    use Core\Controller;


    class ReaderController extends Controller
    {
        public function index()
        {
            $conn = Data::getInstance()->connection();
            $queryLike = "SELECT * FROM article_likes";
            $statement = $conn->prepare($queryLike);
            $statement->execute();
            $Likes = $statement->fetchAll(\PDO::FETCH_ASSOC) ?? [];
            $this->render("display",
                [
                    'title' => "reader",
                    'Likes' => $Likes
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