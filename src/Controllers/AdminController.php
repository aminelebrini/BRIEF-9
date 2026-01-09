<?php

    namespace Controllers;

    use data\Data;
    use Core\Controller;
    use Models\Commentaire;
    use Models\Articles;




    class AdminController extends Controller
    {
        public function index() {
        
        if (!(isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin')) {
            header("Location: /");
            exit;
        }
        
        $conn = Data::getInstance()->connection();

        $query = "SELECT u.*, c.* FROM users as u INNER JOIN commentaires as c on u.id = c.user_id INNER JOIN articles as a ON c.article_id = a.id";
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
                $banCount);

            }


        $query = "SELECT * FROM categories";
        $statement = $conn->prepare($query);
        $statement->execute();
        $Categories = $statement->fetchAll(\PDO::FETCH_ASSOC) ?? [];


        $queryAllArticle = "SELECT u.first_name, u.last_name, a.* FROM users AS  u INNER JOIN articles as a ON u.id = a.author_id;";
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
                $article['category_name'] ?? "globale",
                $article['contenu'],
                $article['titre'],
                $article['date_publication']
            );
        }

        $this->render("admindash", [
            'title' => "Tableau de Bord Admin",
            'Categories' => $Categories,
            'AllCommentaire' => $AllCommentaire,
            'AllArticle' => $AllArticle
        ]);
}

        public static function add_category():void{

            $category_name = $_POST['category_name'];


            $conn = Data::getInstance()->connection();

            $query = "INSERT INTO categories (category_name) VALUES(?)";
            $statement = $conn->prepare($query);
            
            if($statement->execute([$category_name]))
            {
                $_SESSION['flash'] = [
                    'type' => 'success',
                    'message' => 'La catégorie a été ajoutée avec succès !'
                ];
                header("Location: /admindash");
                exit;
            }
        }

        public function remove_category()
        {
            if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remove_categorie']))
            {
                $category_id = $_POST['remove_categorie'];
                
                $conn = Data::getInstance()->connection();

                $delete_query = "DELETE FROM categories where id = ?";
                $statement = $conn->prepare($delete_query);
                if($statement->execute([$category_id]))
                {
                    $_SESSION['flash'] = [
                        'type' => 'success',
                        'message' => 'La catégorie a été supprimée avec succès !'
                    ];
                }

                header("Location: /admindash");
                exit;
            }
        }

        public function classification()
        {
            if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['validation']))
            {
                $conn = Data::getInstance()->connection();
                $article_id = $_POST['id_article'];
                $categorie_id = $_POST['id_categorie'];

                $query = "INSERT INTO article_categories (article_id, category_id) VALUES(?,?)";
                $statement = $conn->prepare($query);
                $statement->execute([$article_id, $categorie_id]);

            }
            header("Location: /admindash");
             exit;
        }
    }

?>