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

    /* ==========================================
    
                GESTION DES UTILISATEURS
                
    ============================================= */

    // -----------------------------------
    // envoi sur formulaire d'inscription
    // -----------------------------------

    function signUp($errors=array()){           
        require 'app/views/front/inscription.php';
    }

    // --------------------------------
    // enregistrement de l'utilisateur
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

    // -----------------------------------
    // envoi page erreurRGPD
    // -----------------------------------

    function errorRGPD($id){
        require 'app/views/front/errorRGPD.php';
    }

    // -----------------------------------
    // affichage confirmation inscription
    // -----------------------------------
    function confirmRegister(){
        require 'app/views/front/confirmRegister.php';
    }
    // -------------------------------------
    // envoi sur formulaire de connexion
    // -------------------------------------

    function logIn($errors=array()){
        require 'app/views/front/connexion.php';
    }

    // ------------------------
    // connexion utilisateur
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
            // header('Location: index.php?action=connectUser&id=' .$idUser);
        }else{
            $errors['login-failed'] = 'Vos identifiants sont incorrects';
            $this->logIn($errors);            
        }         
    }

    // --------------------------------------------------------------------
    // envoi sur page erreur si les champs de la page connexion sont vides
    // --------------------------------------------------------------------

    function errorConnect(){
        require 'app/views/front/errorConnect.php';
    }
    
    // ------------------------
    // changer le mot de passe
    // ------------------------

    function changePassword($idUser,$pseudo, $password, $oldPassword, $newPassword, $confirmPassword){                
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
    // envoi sur page erreur si les champs pour changer mot de passe sont vides
    // ------------------------------------------------------------------------

    function errorChangePass(){
        require 'app/views/front/errorChangePass.php';
    }
    
    // ------------------------------------------------------------------------
    // envoi sur page erreur si le mot de passe saisi est invalide
    // ------------------------------------------------------------------------

    function errorPassInvalid(){
        require 'app/views/front/errorPassInvalid.php';
    }    

    /*============== GESTION DES COMMENTAIRES ================*/
    
    // accéder au formulaire de connexion de l'espace membre
    function goSpaceMember(){
        require 'app/views/front/inscription.php';
    }
    // poster un commentaires à partir d'un article de l'accueil
    function postComment($contentComment, $idUser, $idArticle){
        $comment = new \Project\Models\CommentManager();
        $postComment = $comment->postComment($contentComment, $idUser, $idArticle);
     header('Location: index.php?action=readNext&id='.$idArticle);    
    }

     // poster un commentaires à partir d'un article du blog
    //  function postCommentBlog($contentComment, $idUser, $idArticle){
    //     $comment = new \Project\Models\CommentManager();
    //     $postComment = $comment->postComment($contentComment, $idUser, $idArticle);
    //  header('Location: index.php?action=readArticle&id='.$idArticle);    
    // }


    // afficher les commentaires liés à l'article
    function getComments($id){
        $comment = new \Project\Models\CommentManager();
        $getComments = $comment->getComments($id);
        // require 'app/views/front/selectedArticle.php';
    }

    // afficher les commentaires liés à l'utilisateur
    function getUserComments($id){
        $comment = new \Project\Models\CommentManager();
        $userComments = $comment->getUserComments($id);
    }
    
    // ----------------------------------------
    // afficher le commentaire à modifier
    // ----------------------------------------

    function editComment($commentId){
        $comment = new \Project\Models\CommentManager();
        $getComment = $comment->getComment($commentId);
        $editComment = $getComment->fetch();
        require 'app/views/front/commentEdited.php';
    }

    // ----------------------------------
    // modifier le commentaire
    // ----------------------------------
    function updateComment($commentId, $updateComment, $date, $idUser){
        $comment = new \Project\Models\CommentManager();
        $updateComment = $comment->updateComment($commentId, $updateComment, $date);
        $commentUpdated = $updateComment->fetch();
        $userComments = $comment->getUserComments($idUser);
       
        // header('Location: index.php?action=readArticle');    
        require "app/views/front/dashboardUser.php";   
    }

    // ------------------------------
    // supprimer le commentaire
    // ------------------------------

    function deleteComment($commentId,$idUser){
        $comment = new \Project\Models\CommentManager();
        $deleteComment = $comment->deleteComment($commentId);
       
        $userComments = $comment->getUserComments($idUser);
        // header('Location: index.php?action=deleteComment&id='. $idUser);
    require "app/views/front/dashboardUser.php";
        
    }





    function connectForPost($id,$pseudo, $password, $idArticle){
             
      $user = new \Project\Models\UserManager();
        $userRegistered = $user->recupPassword($pseudo, $password);
        $result = $userRegistered->fetch(); // stocke cette ligne dans la variable result 
        $isPasswordCorrect = password_verify($password, $result['password']); // compare le mdp de la table avec celui saisi    
        $_SESSION['user_id'] = $result['user_id'];
        $_SESSION['pseudo'] = $result['pseudo'];
        // $_SESSION['mail'] = $result['mail'];
        $_SESSION['password'] = $result['password'];
        
        
        if($isPasswordCorrect){
            $article = new \Project\Models\ArticleManager();
            $selectArticle = $article->displayArticle($id);
            $displayArticle = $selectArticle->fetch();
            $comment = new \Project\Models\CommentManager();
            $getComments = $comment->getComments($id);
            // $comment = new \Project\Models\CommentManager();
        // $userComments = $comment->getUserComments($idUser);
            // require 'app/views/front/selectedArticle.php';
            header('Location: index.php?action=readArticle&id='. $idArticle);
        }else{
            $errors['login-failed'] = 'Vos identifiants sont incorrects';
            $this->logIn($errors);            
        } 
        
        
        
    }

 

    }