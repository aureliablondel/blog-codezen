<?php

namespace Project\Models;

class UserManager extends Manager{

    // ------------------------------------
    // requête pour CREER l'ADMINISTRATEUR
    // ------------------------------------

    public function createAdmin($firstname, $mdp){
        $bdd = $this->dbConnect();
        $user = $bdd->prepare('INSERT INTO users(firstname, mdp) VALUE (?,?)');
        $user->execute(array($firstname, $mdp));
    }

    // --------------------------------------
    // requête pour CREER nouvel UTILISATEUR
    // --------------------------------------
    public function registerUser($pseudo, $mail, $registeredPass){
        $bdd = $this->dbConnect();
        $user = $bdd->prepare('INSERT INTO users(pseudo, mail, password) VALUE (?,?,?)');
        $user->execute([$pseudo, $mail, $registeredPass]);
    }

    // ----------------------------------------------------------------------------
    // requête pour RECUPERER le mot de passe de l'utilisateur pour vérification
    // ----------------------------------------------------------------------------

    public function recupPassword($pseudo){
        $bdd = $this->dbConnect();
        $req = $bdd->prepare('SELECT user_id, pseudo, password FROM users WHERE pseudo = ?');
        $req->execute(array($pseudo));
        return $req;
    }

    // --------------------------------------
    //requête pour CHANGER le mot de passe
    // --------------------------------------

    public function changePassword($idUser, $newPassword){
        $bdd = $this->dbConnect();
        $req = $bdd->prepare('UPDATE users SET password = :newpassword WHERE user_id = :user_id');
        $req->execute([
            'user_id' => $idUser,
            'newpassword' => $newPassword
        ]);
    }  
}