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

            $this->render('author', [
                'title' => "Espace Auteur",
                'Commentaires' => $Commentaires
            ]);
        }
        
        public static function addArticle()
        {
            
        }
    }

?>