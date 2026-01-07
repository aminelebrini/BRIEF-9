<?php

namespace Controllers;

use data\Data;
use Core\Controller;

class DisplayController extends Controller
{
    public function index()
    {
        $conn = Data::getInstance()->connection();
        $queryAllArticle = "SELECT a.titre , a.contenu, a.date_publication , u.first_name, u.last_name FROM articles as a INNER JOIN users as u WHERE a.author_id = u.id";
        $statement = $conn->prepare($queryAllArticle);
        $statement->execute();
        $AllArticle = $statement->fetchAll(\PDO::FETCH_ASSOC) ?? [];
        $_SESSION['AllArticle'] = $AllArticle;
        $this->render("display",
            [
                "title" => 'Les articles',
                'AllArticle' => $AllArticle
            ]
        );
    }
}

?>