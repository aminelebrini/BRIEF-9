<?php

    namespace Controllers;

    use data\Data;
    use Core\Controller;



    class AdminController extends Controller
    {

        public function index() {
        
        $conn = Data::getInstance()->connection();

        $query = "SELECT * FROM commentaires";
        $statement = $conn->prepare($query);
        $statement->execute();
        $Commentaires = $statement->fetchAll(\PDO::FETCH_ASSOC) ?? [];

        $query = "SELECT * FROM categories";
        $statement = $conn->prepare($query);
        $statement->execute();
        $Categories = $statement->fetchAll(\PDO::FETCH_ASSOC) ?? [];

        $this->render("admindash", [
            'title' => "Tableau de Bord Admin",
            'Categories' => $Categories,
            'Commentaires' => $Commentaires 
        ]);
}

        public static function add_category():void{

            $category_name = $_POST['category_name'];


            $db = new Data();
            $conn = $db->connection();

            $query = "INSERT INTO categories (category_name) VALUES(?)";
            $statement = $conn->prepare($query);
            
            if($statement->execute([$category_name]))
            {
                $_SESSION['flash'] = [
                    'type' => 'success',
                    'message' => 'La catégorie a été ajoutée avec succès !'
                ];
                header("LOcation: /admindash");
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

                header("LOcation: /admindash");
                exit;
            }
        }
    }

?>