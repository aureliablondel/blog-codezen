<?php
session_start();
require_once __DIR__ . '/vendor/autoload.php';
// Ouvre une nouvelle session

if($_SERVER['HTTP_HOST'] !=  "blog-codezen.herokuapp.com"){
    // pour éviter l'affichage des identifiants bdd
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();
}

try{    
    
    $frontController = new \Project\Controllers\Front\FrontController();

    if(isset($_GET['action'])){

         /*        
            ============== GESTION DES ARTICLES =================            
        */
        // ----------------------------------
        // RECHERCHE des articles
        // ----------------------------------
        
        if($_GET['action'] == 'searchArticle'){            
            $search = htmlspecialchars($_POST['q']);             
            $search = trim($search); 
            $frontController->search($search);
        }
       
        // ----------------------------------
        // envoi sur BLOG
        // ----------------------------------

        elseif($_GET['action'] == 'blog'){
            $frontController->blog();
        }

        // ----------------------------------
        // envoi sur TUTOS
        // ----------------------------------

        elseif($_GET['action'] == 'tutos'){
            $frontController->tutos();
        }
      
        // ------------------------------------------
        // SELECTION d'un article à partir du blog
        // ------------------------------------------

        elseif($_GET['action'] == 'readArticle'){
            $id = $_GET['id'];            
            $frontController->display($id);
        }
        
        // ----------------------------------------------
        // SELECTION d'un article à partir de l'accueil
        // ----------------------------------------------

        elseif($_GET['action'] == 'readNext'){
            $id = $_GET['id'];            
            $frontController->nextArticle($id);
        }

        /*        
            ============== GESTION DES UTILISATEURS =================            
        */
        // ---------------------------------------------
        // envoi sur le formulaire d'INSCRIPTION
        // ---------------------------------------------

        elseif($_GET['action'] == 'signUp'){
            $frontController->signUp();
        }

        // --------------------------------------------
        // enregistrement du NOUVEL UTILISATEUR
        // --------------------------------------------

        elseif($_GET['action'] == 'registerUser'){            
            $id = $_GET['id'];            
            $pseudo = htmlspecialchars($_POST['pseudo']);
            $mail = htmlspecialchars($_POST['mail']);
            $mail = filter_var($mail, FILTER_SANITIZE_EMAIL);            
            $password = htmlspecialchars($_POST['password']);
            $confirmPassword = htmlspecialchars($_POST['confirm-password']);
            $registeredPass = password_hash(htmlspecialchars($_POST['password']), PASSWORD_DEFAULT);
            $frontController->registerUser($id, $pseudo, $mail, $password, $confirmPassword, $registeredPass);        
        }       

        // ----------------------------------------
        // envoi sur le formulaire de CONNEXION
        // ----------------------------------------
        
        elseif($_GET['action'] == 'logIn'){
            $frontController->logIn();
        }

        // -------------------------
        // CONNEXION utilisateur
        // -------------------------

        elseif($_GET['action'] == 'connectUser'){            
            $pseudo = htmlspecialchars($_POST['pseudo']);
            $password = htmlspecialchars($_POST['password']);
            if(!empty($pseudo && $password)){          
                $frontController->connectUser($pseudo, $password);
            }else{                
                $frontController->errorConnect();
            }
        }

        // -----------------------
        // CHANGER mot de passe
        // -----------------------

        elseif($_GET['action'] == 'changePassword'){
            $idUser = $_GET['id'];                
            $pseudo = $_SESSION['pseudo'];
            $oldPassword = htmlspecialchars($_POST['oldpassword']);
            $newPassword = password_hash(htmlspecialchars($_POST['newpassword']), PASSWORD_DEFAULT);                     
                        
            if(!empty($oldPassword && $newPassword)){          
                $frontController->changePassword($idUser, $pseudo, $oldPassword, $newPassword);
            }else{                
                $frontController->errorChangePass();
            }          
        }
        
        /*
            ================ POST COMMENTAIRES ================
        */        
        // ---------------------------------
        // POSTER un commentaire
        // ---------------------------------

        elseif($_GET['action'] == 'postComment'){
            $idArticle = $_GET['id'];
            $idUser = $_SESSION['user_id'];
            $contentComment = htmlspecialchars($_POST['comment']);            
            $frontController->postComment($contentComment, $idUser, $idArticle);
        }

        // -----------------------------------------
        // SE CONNECTER pour POSTER un commentaire
        // -----------------------------------------

        elseif($_GET['action'] == 'connectForPost'){
            $id = $_GET['id'];
            $pseudo = htmlspecialchars($_POST['pseudo']);
            $password = htmlspecialchars($_POST['password']);
            if(!empty($pseudo && $password)){          
                $frontController->connectForPost($id, $pseudo, $password);
            }else{                
                $frontController->errorConnect();
            }
        }

        // -----------------------------------------------
        // AFFICHER le commentaire à modifier
        // -----------------------------------------------
        
        elseif($_GET['action'] == 'updateComment'){
            $commentId = $_GET['id'];
            $frontController->editComment($commentId);          
        }

        // ---------------------------
        // MODIFIER le commentaire
        // ---------------------------

        elseif($_GET['action'] == 'submitComment'){
            $commentId = $_GET['id'];            
            $updateComment = htmlspecialchars($_POST['contentComment']);
            $date = $_POST['date'];
            $idUser = $_SESSION['user_id'];
            $frontController->updateComment($commentId, $updateComment, $date, $idUser);
        }

        // --------------------------
        // SUPPRIMER le commentaire
        // --------------------------

        elseif($_GET['action'] == 'deleteComment'){
            $commentId = $_GET['id'];
            $idUser = $_SESSION['user_id'];
            $frontController->deleteComment($commentId, $idUser);
        }
        
        // ---------------------------------
        // lien vers les mentions légales
        // ---------------------------------

        elseif($_GET['action'] == 'mentions'){
            require 'app/views/front/mentions.php';
        }

        // --------------
        // DECONNEXION
        // --------------

       elseif($_GET['action'] == 'disconnection'){            
            session_destroy();
            // on ferme la session
            header('Location: index.php');
        }else{            
            require "error.php";
        }    
    
    }else{       
        $frontController->accueil();
        // si pas d'action on appelle la variable et on applique la méthode accueil définie ds fichier FrontController
    }

}catch(Exception $e){ 
    die('Erreur: ' . $e->getMessage());
}

