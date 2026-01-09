<?php
    namespace Controllers;

    use data\Data;
    use Core\Controller;


    class BannerCommentaire extends Controller{


        public function index()
        {
            $this->render('display',[]);
        }

        public function banner_Commentaire()
        {

            if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['banner']))
            {
                $article_id = $_POST['id_article'];
                $user_id = $_POST['id_user'];
                $conn = Data::getInstance()->connection();

                $query = "UPDATE commentaires SET ban_count = ban_count + 1 WHERE article_id = ? AND user_id = ?";
                $statement = $conn->prepare($query);
                $statement->execute([$article_id,$user_id]);
                
                $queryselect = "SELECT ban_count FROM commentaires WHERE user_id = ?";
                $statement = $conn->prepare($queryselect);
                $statement->execute([$user_id]);
                $countResult = $statement->fetch(\PDO::FETCH_ASSOC);
                $banCount = $countResult['ban_count'];

                
                if($banCount >= 3)
                {
                    $queryupdate = "UPDATE users SET is_blocked = 1 WHERE id = ?";
                    $statement = $conn->prepare($queryupdate);
                    $statement->execute([$user_id]);

                    $querydele = "DELETE FROM commentaires WHERE user_id = ?";
                    $statement = $conn->prepare($querydele);
                    $statement->execute([$user_id]);
                }
                header("Location: /display");
                exit;
            }
        }
    }
?>