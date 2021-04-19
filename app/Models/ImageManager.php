<?php

namespace Project\Models;

class ImageManager extends Manager{

    // ----------------------------------------------------------------------------
    // requête pour AFFICHER les images dans un catalogue
    // ----------------------------------------------------------------------------
    public function getImages(){
        $bdd = $this->dbConnect();
        $req = $bdd->query('SELECT * FROM images ORDER BY img_id DESC');
        return $req;
    }

    // ----------------------------------------
    // requête pour CHARGER une nouvelle image
    // ----------------------------------------
    public function uploadImg($title, $target_file){
        $bdd = $this->dbConnect();        
        $req = $bdd->prepare('INSERT INTO images(titleImg, img) VALUE(?,?)');
        $req->execute(array($title, $target_file));
        return $req;
    }  

    // ---------------------------------
    // requête pour SUPPRIMER une image 
    // ---------------------------------
    public function deletImg($id){
        $bdd = $this->dbConnect();
        $req = $bdd->prepare('DELETE FROM images WHERE img_id = ?');
        $req->execute([$id]);
        return $req;
    }
}