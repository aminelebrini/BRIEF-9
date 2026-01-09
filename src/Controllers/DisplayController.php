<?php

namespace Controllers;

use data\Data;
use Core\Controller;
use Models\Articles;
use Models\Commentaire;

class DisplayController extends Controller
{
    public function index()
    {
        if (!isset($_SESSION['user'])) {
            header("Location: /");
            exit;
        }
        $conn = Data::getInstance()->connection();

        $query = "SELECT u.id ,u.first_name, u.last_name , c.text, c.article_id ,c.user_id, c.ban_count FROM users as u INNER JOIN commentaires as c on u.id = c.user_id INNER JOIN articles as a ON c.article_id = a.id";
        $statement = $conn->prepare($query);
        $statement->execute();
        $Commentaires = $statement->fetchAll(\PDO::FETCH_ASSOC) ?? [];

        $AllCommentaire = [];

        foreach($Commentaires as $commetaires)
        {
            $AllCommentaire [] = new Commentaire(
                $commetaires['id'],
                $commetaires['text'],
                $commetaires['first_name'],
                $commetaires['last_name'],
                $commetaires['article_id'],
                $commetaires['user_id'],
                $commetaires['ban_count']
            );
        }
        $queryAllArticle = "
        SELECT 
            a.id,
         a.titre,
         a.contenu,
         a.date_publication,
         u.first_name,
         u.last_name,
         c.category_name
        FROM articles a
        INNER JOIN users u ON a.author_id = u.id
        LEFT JOIN article_categories ac ON a.id = ac.article_id
        LEFT JOIN categories c ON ac.category_id = c.id
        ";

        $statement = $conn->prepare($queryAllArticle);
        $statement->execute();
        $Article = $statement->fetchAll(\PDO::FETCH_ASSOC) ?? [];

        $AllArticle = [];
        foreach($Article as $article)
        {
            $author = $article['first_name'] . " " . $article['last_name'];
            $AllArticle [] = new Articles(
                $article['id'],
                $author,
                $article['category_name'],
                $article['contenu'],
                $article['titre'],
                $article['date_publication']
            );
        }

        $queryLike = "SELECT * FROM article_likes";
        $statement = $conn->prepare($queryLike);
        $statement->execute();
        $Likes = $statement->fetchAll(\PDO::FETCH_ASSOC) ?? [];
        $this->render("display",
            [
                "title" => 'Les articles',
                'AllArticle' => $AllArticle,
                'Likes' => $Likes,
                'AllCommentaire' => $AllCommentaire
            ]
        );
    }
}

?>