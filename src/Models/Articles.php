<?php
    namespace Models;

    use data\Data;

    class Articles{
        private $id;
        private $author;
        private $categories;
        private $contenu;
        private $titre;
        private $date_pubication;


        public function __construct($id, $author,$categories, $contenu, $titre, $date_pubication)
        {
            $this->id = $id;
            $this->author = $author;
            $this->categories = $categories;
            $this->contenu = $contenu;
            $this->titre = $titre;
            $this->date_pubication = $date_pubication;
        }
        public function get_id()
        {
            return $this->id;
        }
        public function get_author()
        {
            return $this->author;
        }
        public function get_categorie()
        {
            return $this->categories;
        }
        public function get_contenu()
        {
            return $this->contenu;
        }
        public function get_titre()
        {
            return $this->titre;
        }
        public function get_date_publication()
        {
            return $this->date_pubication;
        }
    }
?>