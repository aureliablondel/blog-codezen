<?php

namespace Project\Models;

class UserManager extends Manager{

    // ------------------------------------
    // requête pour CREER l'ADMINISTRATEUR
    // ------------------------------------

    public function createAdmin($pseudoAdmin, $passAdmin){
        $bdd = $this->dbConnect();
        $user = $bdd->prepare('INSERT INTO admins(pseudo_admin, pass_admin) VALUE (?,?)');
        $user->execute([$pseudoAdmin, $passAdmin]);
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
    // requête pour RECUPERER le mot de passe de l'ADMINISTRATEUR pour vérification
    // ----------------------------------------------------------------------------

    public function recupPassAdmin($pseudoAdmin){
        $bdd = $this->dbConnect();
        $req = $bdd->prepare('SELECT pseudo_admin, pass_admin FROM admins WHERE pseudo_admin = ?');
        $req->execute([$pseudoAdmin]);
        return $req;
    }

    // ----------------------------------------------------------------------------
    // requête pour RECUPERER le mot de passe de l'UTILISATEUR pour vérification
    // ----------------------------------------------------------------------------

    public function recupPassword($pseudo){
        $bdd = $this->dbConnect();
        $req = $bdd->prepare('SELECT user_id, pseudo, password FROM users WHERE pseudo = ?');
        $req->execute([$pseudo]);
        return $req;
    }

    // --------------------------------------
    // requête pour CHANGER le mot de passe
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