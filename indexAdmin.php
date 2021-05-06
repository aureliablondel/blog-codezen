<?php

session_start();
// Ouvre une nouvelle session

require_once __DIR__ . '/vendor/autoload.php';

if($_SERVER['HTTP_HOST'] != "blog-codezen.herokuapp.com"){
    // pour éviter l'affichage des identifiants bdd
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();
}

try{
    $backController = new \Project\Controllers\Back\BackController();

    if(isset($_GET['action'])){

        // -----------------------------------------
        // CREATION de l'ADMINISTRATEUR
        // -----------------------------------------

        if($_GET['action'] == 'createAdmin'){
            $pseudoAdmin = htmlspecialchars($_POST['createPseudo']);
            $passAdmin = password_hash(htmlspecialchars($_POST['createPass']), PASSWORD_DEFAULT);
            $backController->createAdmin($pseudoAdmin, $passAdmin);
        }    

        // -----------------------------------------
        // CONNEXION de l'ADMINISTRATEUR
        // -----------------------------------------

        elseif($_GET['action'] == 'validAdmin'){
            $pseudoAdmin = htmlspecialchars($_POST['pseudoAdmin']);
            $passAdmin = htmlspecialchars($_POST['passAdmin']);
            $backController->validAdmin($pseudoAdmin, $passAdmin);
        }        

        // ------------------------------------------
        // retour au TABLEAU DE BORD
        // ------------------------------------------

        elseif($_GET['action'] == 'tbAdmin'){
            $backController->tbAdmin();
        }

        /*            
            ====================== GESTION DES ARTICLES ======================            
        */
        // -----------------------------------------
        // AFFICHE tous les articles
        // -----------------------------------------

        elseif($_GET['action'] == 'articles'){            
            $backController->getArticles();
        }

        // -----------------------------------------
        // envoie sur la page de CREATION d'article
        // -----------------------------------------

        elseif($_GET['action'] == 'createArticle'){
            $backController->goPageNewArticle();
        }

        // ------------------------------------------
        // enregistre un NOUVEL article
        // ------------------------------------------

        elseif($_GET['action'] == 'logArticle'){
            $idImg = htmlspecialchars($_POST['selectImg']);           
            $newTitle = htmlspecialchars($_POST['title']);
            $newContent = htmlspecialchars($_POST['content']);
            $backController->createArticle($newTitle, $newContent, $idImg);            
        }
        // -------------------------------------------
        // EDITE l'article selectionné
        // -------------------------------------------

        elseif($_GET['action'] == 'editArticle'){
            $id = htmlspecialchars($_GET['id']);
            $backController->editArticle($id);
        }

        // -------------------------------------------
        // MODIFIE l'article   
        // -------------------------------------------

        elseif($_GET['action'] == 'updateArticle'){           
            $id = htmlspecialchars($_GET['id']);
            $updateTitle = htmlspecialchars($_POST['title']);
            $updateContent = htmlspecialchars($_POST['content']);
            $backController->updateArticle($id, $updateTitle, $updateContent);
        }

        // ------------------------------------------
        // SUPPRIME l'article
        // ------------------------------------------

        elseif($_GET['action'] == 'deleteArticle'){
            $id = htmlspecialchars($_GET['id']);
            $backController->deleteArticle($id);
        }

        /*
            ==================== GESTION DES IMAGES =================
        */
        // ----------------------------------------
        // AFFICHE toutes les images
        // ----------------------------------------

        elseif($_GET['action'] == 'images'){            
            $backController->getImages();
        }

        // ----------------------------------------
        // charge la page de CREATION d'image
        // ----------------------------------------

        elseif($_GET['action'] == 'image'){
            $backController->goPageNewImg();
        }

        // --------------------------------------------
        // ENREGISTRE une nouvelle image dans la BDD
        // --------------------------------------------

        elseif($_GET['action'] == 'uploadImg'){
            $title = htmlspecialchars($_POST['title']);            
            if(!empty($title)){
                $backController->uploadImg($title);
                }         
        } 

        // ---------------------------------------
        // SUPPRIME une image
        // ---------------------------------------

        elseif($_GET['action'] == 'deletImg'){
            $id = htmlspecialchars($_GET['id']);
            $backController->deletImg($id);
        }  

        // ---------------------------------------
        // DECONNEXION;
        // ---------------------------------------

        elseif($_GET['action'] == 'disconnection'){            
            session_destroy();
            header('Location: indexAdmin.php');     
        }
        
        else{       
            require "error.php";
        }

    }else{
        $backController->connectAdmin();
    }

} catch(Exception $e){ 
    die('Erreur: ' . $e->getMessage());
}
