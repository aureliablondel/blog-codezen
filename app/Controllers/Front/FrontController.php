<?php

namespace Project\Controllers\Front;

class FrontController{

    /* ==========================================
                GESTION DES ARTICLES    
    =============================================*/

    // ---------------------------------------------
    // affichage des articles dans la page ACCUEIL
    // ---------------------------------------------

    function accueil(){
        $article = new \Project\Models\ArticleManager();
        $introArticles = $article->getIntroArticles();
        $profileArticle = $article->getProfileArticle();
        $profilArticle = $profileArticle->fetch();
        $lastArticles = $article->getLastArticles();
        require 'app/views/front/accueil.php'; // méthode qui retourne la page accueil
    } 
    
    // --------------------------------
    // RECHERCHE article dans le site
    // --------------------------------

    function search($search){
        $resSearch = new \Project\Models\ArticleManager();
        $selectSearchs = $resSearch->search($search);
        require 'app/views/front/resultSearch.php';
    }

    // --------------------------------
    // affichage articles dans le BLOG
    // --------------------------------

    function blog(){
        $article = new \Project\Models\ArticleManager();
        $blogArticles = $article->getBlogArticles();
        require 'app/views/front/blog.php';
    }

    // ----------------------------------------------------
    // affichage de l'article SELECTIONNE à partir du blog
    // ----------------------------------------------------

    function display($id){
        $article = new \Project\Models\ArticleManager();
        $selectArticle = $article->displayArticle($id);
        $displayArticle = $selectArticle->fetch();
        $detailArticles = $article->detailArticle($id);
        $comment = new \Project\Models\CommentManager();
        $getComments = $comment->getComments($id);
        require 'app/views/front/selectedArticle.php';
    }

    // ---------------------------------------------------------
    // affichage de l'article SELECTIONNE à partir de l'accueil
    // ---------------------------------------------------------

    function nextArticle($id){
        $article = new \Project\Models\ArticleManager();
        $selectArticle = $article->displayArticle($id);
        $displayArticle = $selectArticle->fetch();
        $detailArticles = $article->detailArticle($id);
        $comment = new \Project\Models\CommentManager();
        $getComments = $comment->getComments($id);
        require 'app/views/front/selectedArticle.php';
    }
    // ---------------------------------------------------------
    // envoi sur la page TUTOS
    // ---------------------------------------------------------
    function tutos(){
        require 'app/views/front/tutos.php';
    }

    /*        
        ============== GESTION DES UTILISATEURS =================            
    */
    // -----------------------------------
    // envoi sur formulaire d'INSCRIPTION
    // -----------------------------------

    function signUp($errors=array()){           
        require 'app/views/front/inscription.php';
    }

    // --------------------------------
    // INSCRIPTION de l'utilisateur
    // --------------------------------

    function registerUser($id, $pseudo, $mail, $password, $confirmPassword, $registeredPass){       
        
        if(empty($pseudo)){
            $errors['pseudo-empty'] = 'Veuillez renseigner le pseudo';
        }        
        if(!empty($pseudo) && empty($mail)){
            $errors['mail-empty'] = "Veuillez renseigner l'adresse mail";
        }
        if(!empty($pseudo && $mail) && empty($password)){
            $errors['password-empty'] = 'Veuillez saisir un mot de passe';
        }
        if(!empty($password) && strlen($password)<8){
            $errors['password-tooshort'] = 'Le mot de passe doit comporter 8 caractères minimum';
        }
        if(!empty($password) && empty($confirmPassword)){
            $errors['confirm-empty'] = 'Veuillez confirmer le mot de passe';
        }
        if(!empty($password && $confirmPassword) && $password != $confirmPassword){            
            $errors['password-notconfirmed'] = 'Les deux mots de passe doivent être identiques';           
        }           
        if(empty($errors)){  
               
            $user = new \Project\Models\UserManager(); 
            $newUser = $user->registerUser($pseudo, $mail, $registeredPass); 
            $userRegistered = $user->recupPassword($pseudo, $registeredPass);
            $result = $userRegistered->fetch(); // stocke cette ligne dans la variable result 
            
            $_SESSION['user_id'] = $result['user_id'];
            $_SESSION['pseudo'] = $result['pseudo'];       
            $_SESSION['password'] = $result['password'];     
            $article = new \Project\Models\ArticleManager();
            $selectArticle = $article->displayArticle($id);
            $displayArticle = $selectArticle->fetch();
            $detailArticles = $article->detailArticle($id);
            $comment = new \Project\Models\CommentManager();
            $getComments = $comment->getComments($id);            
            require 'app/views/front/selectedArticle.php'; 
              
        }else{         
            $this->signUp($errors);
        }
    }    
    
    // -------------------------------------
    // envoi sur formulaire de CONNEXION
    // -------------------------------------

    function logIn($errors=array()){
        require 'app/views/front/connexion.php';
    }

    // ------------------------
    // CONNEXION utilisateur
    // ------------------------

    function connectUser($pseudo, $password){
        $user = new \Project\Models\UserManager();
        $userRegistered = $user->recupPassword($pseudo);
        $result = $userRegistered->fetch();
        // stockage du mot de passe récupéré dans la variable result pour faire la comparaison avec le mot de passe saisi
        $isPasswordCorrect = password_verify($password, $result['password']);       
        $idUser = $_SESSION['user_id'] = $result['user_id'];
        $pseudo = $_SESSION['pseudo'] = $result['pseudo'];
        
        if($isPasswordCorrect){
            $comment = new \Project\Models\CommentManager();
            $userComments = $comment->getUserComments($idUser);            
             require 'app/views/front/dashboardUser.php';            
        }else{
            $errors['login-failed'] = 'Vos identifiants sont incorrects';
            $this->logIn($errors);            
        }         
    }

    // --------------------------------------------------------------------
    // envoi sur page ERREUR si les champs de la page connexion sont vides
    // --------------------------------------------------------------------

    function errorConnect(){
        require 'app/views/front/errorConnect.php';
    }
    
    // ------------------------
    // CHANGER le mot de passe
    // ------------------------

    function changePassword($idUser,$pseudo, $oldPassword, $newPassword){                
        $user = new \Project\Models\UserManager();
        $userRegistered = $user->recupPassword($pseudo);
        $result = $userRegistered->fetch();        
        $isPasswordCorrect = password_verify($oldPassword, $result['password']);

        if($isPasswordCorrect){
            $userPass = $user->changePassword($idUser, $newPassword);            
            header('Location: index.php?action=logIn');
        }else{
            require 'app/views/front/errorPassInvalid.php';
        }        
    }

    // ------------------------------------------------------------------------
    // envoi sur page ERREUR si les champs pour changer mot de passe sont vides
    // ------------------------------------------------------------------------

    function errorChangePass(){
        require 'app/views/front/errorChangePass.php';
    }    

    /*
        ============== GESTION DES COMMENTAIRES ================
    */  
    // --------------------------
    // POSTER un commentaire
    // --------------------------

    function postComment($contentComment, $idUser, $idArticle){
        $comment = new \Project\Models\CommentManager();
        $postComment = $comment->postComment($contentComment, $idUser, $idArticle);
        header('Location: index.php?action=readNext&id='.$idArticle);    
    }

    // --------------------------
    // SE CONNECTER pour POSTER un commentaire
    // --------------------------

    function connectForPost($id, $pseudo, $password){             
        $user = new \Project\Models\UserManager();
        $userRegistered = $user->recupPassword($pseudo, $password);
        $result = $userRegistered->fetch();
        $isPasswordCorrect = password_verify($password, $result['password']); 
        $_SESSION['user_id'] = $result['user_id'];
        $_SESSION['pseudo'] = $result['pseudo'];        
        $_SESSION['password'] = $result['password'];        
        
        if($isPasswordCorrect){
            $article = new \Project\Models\ArticleManager();
            $selectArticle = $article->displayArticle($id);
            $displayArticle = $selectArticle->fetch();
            $comment = new \Project\Models\CommentManager();
            $getComments = $comment->getComments($id);            
            header('Location: index.php?action=readArticle&id='. $id);
        }else{
            require 'app/views/front/errorConnect.php';     
        } 
    }

    // ---------------------------------------------
    // AFFICHER les commentaires liés à l'article
    // ---------------------------------------------

    function getComments($id){
        $comment = new \Project\Models\CommentManager();
        $getComments = $comment->getComments($id);        
    }

    // -----------------------------------------------
    // AFFICHER les commentaires liés à l'utilisateur
    // -----------------------------------------------

    function getUserComments($id){
        $comment = new \Project\Models\CommentManager();
        $userComments = $comment->getUserComments($id);
    }
    
    // ----------------------------------------
    // AFFICHER le commentaire à modifier
    // ----------------------------------------

    function editComment($commentId){
        $comment = new \Project\Models\CommentManager();
        $getComment = $comment->getComment($commentId);
        $editComment = $getComment->fetch();
        require 'app/views/front/commentEdited.php';
    }

    // ----------------------------------
    // MODIFIER le commentaire
    // ----------------------------------

    function updateComment($commentId, $updateComment, $date, $idUser){
        $comment = new \Project\Models\CommentManager();
        $updateComment = $comment->updateComment($commentId, $updateComment, $date);
        $commentUpdated = $updateComment->fetch();
        $userComments = $comment->getUserComments($idUser);
        require "app/views/front/dashboardUser.php";   
    }

    // ------------------------------
    // SUPPRIMER le commentaire
    // ------------------------------

    function deleteComment($commentId,$idUser){
        $comment = new \Project\Models\CommentManager();
        $deleteComment = $comment->deleteComment($commentId);       
        $userComments = $comment->getUserComments($idUser);
        require "app/views/front/dashboardUser.php";        
    }
        
    
        
    

 

    }