<?php

    namespace Models;

    use data\Data;

    class Commentaire
    {
        private int $id;
        private string $text;
        private $fname;
        private $lname;
        private $article_id;
        private $user_id;
        private $ban_count;
        
        public function __construct($id,$text,$fname, $lname, $article_id,$user_id, $ban_count)
        {
            $this->id = $id;
            $this->text = $text;
            $this->fname = $fname;
            $this->lname = $lname;
            $this->article_id = $article_id;
            $this->user_id = $user_id;
            $this->ban_count = $ban_count;
        }

        public function get_first_name()
        {
            return $this->fname;
        }

        public function get_last_name()
        {
            return $this->lname;
        }

        public function get_text()
        {
            return $this->text;
        }
        public function get_article_id()
        {
            return $this->article_id;
        }
        public function get_user_id()
        {
            return $this->user_id;
        }
        public function get_ban_count()
        {
            return $this->ban_count;
        }
    }
?>