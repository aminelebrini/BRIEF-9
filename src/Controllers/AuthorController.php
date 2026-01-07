<?php

namespace Controllers;

    use data\Data;
    use Core\Controller;

    class AuthorController extends Controller
    {
        public function index()
        {
            $conn = Data::getInstance()->connection();
            $query = "SELECT * FROM commentaires";
            $statement = $conn->prepare($query);
            $statement->execute();
            $Commentaires = $statement->fetchAll(\PDO::FETCH_ASSOC) ?? [];


            $queryAllArticle = "SELECT * FROM articles";
            $statement = $conn->prepare($queryAllArticle);
            $statement->execute();
            $AllArticle = $statement->fetchAll(\PDO::FETCH_ASSOC) ?? [];

            $queryLike = "SELECT * FROM article_likes";
            $statement = $conn->prepare($queryLike);
            $statement->execute();
            $Likes = $statement->fetchAll(\PDO::FETCH_ASSOC) ?? [];

            $this->render('author', [
                'title' => "Espace Auteur",
                'Commentaires' => $Commentaires,
                'AllArticle' => $AllArticle,
                'Likes' => $Likes
            ]);
        }
        
        public static function addArticle()
        {
            $conn = Data::getInstance()->connection();
            $articleTitle = $_POST['title'];
            $articleContent = $_POST['content'];
            $authorId = $_POST['pub'];

            $queryAddArticle = "INSERT INTO articles (author_id, titre, contenu) VALUES (?,?,?)";
            $statement = $conn->prepare($queryAddArticle);
            $statement->execute([$authorId, $articleTitle, $articleContent]);
        }
        public static function modifierArticle()
        {
            // $conn = Data::getInstance()->connection();
            // $queryAllArticle = "SELECT * FROM articles";
            // $statement = $conn->prepare($queryAllArticle);
            // $statement->execute();
            // $AllArticle = $statement->fetchAll(\PDO::FETCH_ASSOC) ?? [];
            // $_SESSION['AllArticle'] = $AllArticle;

        }
        
        
    }

    if($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['pub']))
    {
        AuthorController::addArticle();
        header("Location: /author");
        exit;
    }
?>
