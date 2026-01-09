<?php

namespace Controllers;

    use data\Data;
    use Core\Controller;
    use Models\Commentaire;

    class AuthorController extends Controller
    {
        public function index()
        {
            if (!(isset($_SESSION['user']) && $_SESSION['user']['role'] === 'author')) {
                header("Location: /");
                exit;
            }
            $conn = Data::getInstance()->connection();
            $query = "SELECT u.id ,u.first_name, u.last_name , c.text, c.article_id, c.user_id , c.ban_count FROM users as u INNER JOIN commentaires as c on u.id = c.user_id INNER JOIN articles as a ON c.article_id = a.id";
            $statement = $conn->prepare($query);
            $statement->execute();
            $Commentaires = $statement->fetchAll(\PDO::FETCH_ASSOC) ?? [];

            $AllCommentaire = [];

            foreach($Commentaires as $commetaires)
            {
                $banCount = $commetaires['ban_count'] ?? 0;
                $AllCommentaire [] = new Commentaire(
                $commetaires['id'],
                $commetaires['text'],
                $commetaires['first_name'],
                $commetaires['last_name'],
                $commetaires['article_id'],
                $commetaires['user_id'],
                $banCount
            );
        }


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
                'AllCommentaire' => $AllCommentaire,
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
