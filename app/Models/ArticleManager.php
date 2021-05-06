<?php

namespace Project\Models;

class ArticleManager extends Manager{

    /* ===============================================
                    REQUETES EN BACK
    ================================================== */

    // -----------------------------------------------------
    // requête pour CREER un article dans la table articles
    // -----------------------------------------------------

    public function createArticle($newTitle, $newContent, $idImg){
        $bdd = $this->dbConnect();
        $req = $bdd->prepare('INSERT INTO articles(title, content, idImg) VALUE (?,?,?)');
        $req->execute([$newTitle, $newContent, $idImg]);
        return $req;
    }

    // ----------------------------------------------------------------------------
    // requête pour AFFICHER les articles de la table en ordre inverse de création
    // ----------------------------------------------------------------------------

    public function getArticles(){
        $bdd = $this->dbConnect();
        $req = $bdd->query('SELECT art_id, title, content, titleImg, img FROM articles LEFT JOIN images ON articles.idImg = images.img_id ORDER BY art_id DESC');
        return $req;
    }

    // ----------------------------------------------------------
    // requête pour AFFICHER l'article sélectionné dans la liste
    // ----------------------------------------------------------

    public function editArticle($id){
        $bdd = $this->dbConnect();       
        $req = $bdd->prepare('SELECT art_id, title, content, titleImg, img FROM articles INNER JOIN images ON articles.idImg = images.img_id WHERE art_id = ?');
        $req->execute([$id]);       
        return $req;
    }

    // ---------------------------------
    // requête pour MODIFIER un article
    // ---------------------------------

    public function updateArticle($id, $updateTitle, $updateContent){
        $bdd = $this->dbConnect();
        $req = $bdd->prepare('UPDATE articles SET title = :title, content = :content WHERE art_id = :art_id');
        $req->execute([
            'art_id' => $id,
            'title' => $updateTitle,
            'content' => $updateContent
            ]);
        return $req;
    }

    // ----------------------------------
    // requête pour SUPPRIMER un article
    // ----------------------------------

    public function deleteArticle($id){
        $bdd = $this->dbConnect();
        $req = $bdd->prepare('DELETE FROM articles WHERE art_id=?');
        $req->execute([$id]);
        return $req;
    }

    /* =====================================
                REQUETES EN FRONT
    ========================================*/

    // ----------------------------------------------------------
    // requête pour AFFICHER les articles de catégorie ACCUEIL
    // ----------------------------------------------------------
    
    public function getIntroArticles(){
        $bdd = $this->dbConnect();
        $req = $bdd->query('SELECT title, content, img, titleImg FROM articles LEFT JOIN images ON articles.idImg = images.img_id WHERE category = "accueil" ORDER BY dateEdit DESC');
        return $req;
    }

    // ---------------------------------------------------------
    // requête pour AFFICHER l'article de la catégorie PROFIL
    // ---------------------------------------------------------
    
    public function getProfileArticle(){
        $bdd = $this->dbConnect();
        $req = $bdd->query('SELECT title, content, img, titleImg FROM articles LEFT JOIN images ON articles.idImg = images.img_id WHERE category = "profil"');
        return $req;
    }

    // -------------------------------------------------------
    // requête pour AFFICHER les 4 DERNIERS articles publiés
    // -------------------------------------------------------

    public function getLastArticles(){
        $bdd = $this->dbConnect();
        $req = $bdd->query('SELECT art_id, title, content, img, titleImg, DATE_FORMAT(dateEdit, "%d/%m/%Y") AS dateEdit FROM articles LEFT JOIN images ON articles.idImg = images.img_id WHERE category = "blog" ORDER BY dateEdit DESC LIMIT 4');
        return $req;
    }
   
    // ------------------------------------------
    // requête pour AFFICHER articles dans BLOG
    // ------------------------------------------

    public function getBlogArticles(){
        $bdd = $this->dbConnect();
        $req = $bdd->query('SELECT art_id, title, content, img, titleImg FROM articles LEFT JOIN images ON articles.idImg = images.img_id WHERE category = "blog" ORDER BY dateEdit DESC');
        return $req;
    }

    // -------------------------------------------------------------------------
    // requête pour AFFICHER article sélectionné AVEC les COMMENTAIRES associés
    // -------------------------------------------------------------------------
    public function displayArticle($id){
        $bdd = $this->dbConnect();
        $req = $bdd->prepare('SELECT art_id, title, content, dateEdit, img, titleImg, contentComment FROM articles LEFT JOIN images ON articles.idImg = images.img_id LEFT JOIN comments ON articles.art_id = comments.idArticle WHERE art_id = ?');
        $req->execute([$id]);
        return $req;
    }

    // ---------------------------------------------------------
    // requête pour AFFICHER le DETAIL de l'article sélectionné
    // ---------------------------------------------------------
    public function detailArticle($id){
        $bdd = $this->dbConnect();
        $req = $bdd->prepare('SELECT subtitle, subcontent FROM details LEFT JOIN articles ON articles.art_id = details.idBlogArt WHERE art_id = ?');
        $req->execute([$id]);
        return $req;
    }

    // ------------------------------------
    // requête pour RECHERCHE sur le site
    // ------------------------------------

    public function search($search){
        $bdd = $this->dbConnect();
        $req = $bdd->prepare('SELECT title, content FROM articles WHERE title LIKE ? OR content LIKE ?');
        $req->execute(['%'.$search.'%', '%'.$search.'%']);       
        return $req;       
    }
}