<?php

namespace Project\Controllers\Back;

class BackController{

    // -----------------------------------
    // affichage page de CONNEXION
    // -----------------------------------

    function connectAdmin($error = array()){
        require 'app/views/back/connectAdmin.php';
    }

    // -----------------------------------
    // CREATION administrateur
    // -----------------------------------

    function createAdmin($pseudoAdmin, $passAdmin){
        $user = new \Project\Models\UserManager();
        $createAdmin = $user->createAdmin($pseudoAdmin, $passAdmin);
        require 'app/views/back/tableauDeBord.php';
    }

    // ------------------------------------
    // CONNEXION administrateur
    // ------------------------------------

    function validAdmin($pseudoAdmin, $passAdmin){
        $user = new \Project\Models\UserManager();
        $adminRegistered = $user->recupPassAdmin($pseudoAdmin);
        $result = $adminRegistered->fetch();
                    
        $isPassAdminCorrect = password_verify($passAdmin, $result['pass_admin']);        

        if($isPassAdminCorrect){            
            require 'app/views/back/tableauDeBord.php';            
        }else{
            $error['login-failed'] = 'Vos identifiants sont incorrects';
            $this->connectAdmin($error); 
        }
    }

    // ------------------------------------
    // affichage du TABLEAU DE BORD
    // ------------------------------------

    function tbAdmin(){
        require 'app/views/back/tableauDeBord.php'; 
    }

   /* ====================================================
                GESTION DES ARTICLES    
    ======================================================*/

    // -----------------------------------
    // AFFICHAGE des articles
    // -----------------------------------

    function getArticles(){
        $articles = new \Project\Models\ArticleManager();
        $allArticles = $articles->getArticles();
        require 'app/views/back/articles.php';
    }

    // -----------------------------------------------
    // affichage du formulaire de CREATION d'article 
    // -----------------------------------------------

    function goPageNewArticle(){
        $image = new \Project\Models\ImageManager();
        $getImages = $image->getImages();
        require 'app/views/back/newArticle.php';
    }

    // ------------------------------------
    // CREATION d'un nouvel article
    // ------------------------------------

    function createArticle($newTitle, $newContent, $idImg){
        $article = new \Project\Models\ArticleManager();
        $newarticle = $article->createArticle($newTitle, $newContent, $idImg);
        header('Location: indexAdmin.php?action=articles'); 
    }

    // -----------------------------------
    // EDITION de l'article à modifier
    // -----------------------------------

    function editArticle($id){
        $article = new \Project\Models\ArticleManager();
        $editArticle = $article->editArticle($id);
        $articleEdited = $editArticle->fetch();
        require 'app/views/back/articleEdited.php';
    }

    // ----------------------------------
    // MODIFICATION d'un article
    // ----------------------------------

    function updateArticle($id, $updateTitle, $updateContent){
        $article = new \Project\Models\ArticleManager();
        $updateArticle = $article->updateArticle($id, $updateTitle, $updateContent);
        header('Location: indexAdmin.php?action=articles');
    }

    //----------------------------------
    // SUPPRESSION de l'article
    // ---------------------------------
    function deleteArticle($id){
        $article = new \Project\Models\ArticleManager();
        $delArticle = $article->deleteArticle($id);        
        header('Location: indexAdmin.php?action=articles');
    }

    /* ====================================================
                GESTION DES IMAGES    
    ======================================================*/

    // --------------------------------
    // AFFICHAGE de toutes les images
    // --------------------------------

    function getImages(){
        $image = new \Project\Models\ImageManager();
        $getImages = $image->getImages();
        require 'app/views/back/images.php';
    }

    // -------------------------------------------
    // redirection vers page de CREATION d'image
    // -------------------------------------------
    function goPageNewImg(){
        require 'app/views/back/newImage.php';
    }

    // ---------------------------------
    // chargement de la NOUVELLE image
    // ---------------------------------

    function uploadImg($title){

        //spécifie le répertoire ou le fichier est stocké
        $target_dir = "app/public/back/images/"; 
        //spécifie le chemin du fichier à télécharger
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]); 
        $uploadOk = 1; 
        //contient l'extension du fichier
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION)); 

        // on vérifie que le fichier image est une image réelle
        if(isset($_POST['submit'])){
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                // limite la taille des images
                if($check !==false){
                    if($_FILES["fileToUpload"]["size"] > 500000){
                        echo "Désolé, votre fichier est trop volumineux.";
                        $uploadOk = 0;
                    }
                    // gestion des formats
                    elseif($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif"){
                        echo "Seuls les formats JPG, JPEG, PNG & GIF files sont autorisés.";
                        $uploadOk = 0;
                    }
                    // message si on a une de ces deux erreurs 
                    elseif($uploadOk == 0){
                        echo "Désolé, votre fichier n'a pu être envoyé.";
                    // si tout est ok, essai de chargement de l'image
                    }else{
                        if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)){                  
                            $image = new \Project\Models\ImageManager();
                            $uploadImg = $image->uploadImg($title, $target_file);                        
                            header('Location: indexAdmin.php?action=createArticle');
                        }else{
                            echo "Désolé, une erreur est survenue dans l'envoi de votre fichier.";
                        }
                    }
                }else{
                    echo "Ce fichier n'est pas une image.";
                    $uploadOk = 0;
                }
        }       
    }    

    // ---------------------------------------------------
    // suppression de l'image dans la bdd / table images
    // ---------------------------------------------------

    function deletImg($id){
        $image = new \Project\Models\ImageManager();
        $delImage = $image->deletImg($id);
        header('Location: indexAdmin.php?action=images');
    }

}