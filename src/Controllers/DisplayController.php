<?php

namespace Controllers;

use data\Data;
use Core\Controller;

class DisplayController extends Controller
{
    public function index()
    {
        $conn = Data::getInstance()->connection();
        $queryAllArticle = "SELECT a.id, a.titre , a.contenu, a.date_publication , u.first_name, u.last_name FROM articles as a INNER JOIN users as u ON a.author_id = u.id";
        $statement = $conn->prepare($queryAllArticle);
        $statement->execute();
        $AllArticle = $statement->fetchAll(\PDO::FETCH_ASSOC) ?? [];

        $queryLike = "SELECT * FROM article_likes";
        $statement = $conn->prepare($queryLike);
        $statement->execute();
        $Likes = $statement->fetchAll(\PDO::FETCH_ASSOC) ?? [];
        $this->render("display",
            [
                "title" => 'Les articles',
                'AllArticle' => $AllArticle,
                'Likes' => $Likes
            ]
        );
    }
}

?>