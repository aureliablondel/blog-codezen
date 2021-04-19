<?php

namespace Project\Models;

class CommentManager extends Manager{

    // ------------------------------------
    // requête pour POSTER un commentaire
    // ------------------------------------

    public function postComment($contentComment, $idUser, $idArticle){
        $bdd = $this->dbConnect();
        $req = $bdd->prepare('INSERT INTO comments(contentComment, idUser, idArticle) VALUE (?,?,?)');
        $req->execute([$contentComment, $idUser, $idArticle]);
        return $req;
    }

    // -----------------------------------------------------------
    // requête pour RECUPERER les commentaires liés à un ARTICLE
    // -----------------------------------------------------------

    public function getComments($id){
        $bdd = $this->dbConnect();
        $req = $bdd->prepare('SELECT contentComment, dateComment FROM comments WHERE idArticle = ?');
        $req->execute([$id]);
        return $req;
    }

    // ---------------------------------------------------------
    // requête pour RECUPERER les commentaires d'un UTILISATEUR
    // ---------------------------------------------------------

    public function getUserComments($idUser){
        $bdd = $this->dbConnect();
        $req = $bdd->prepare('SELECT contentComment, comment_id, dateComment FROM comments WHERE idUser = ?');
        $req->execute([$idUser]);
        return $req;
    }

    // ---------------------------------------
    // requete pour AFFICHER un commentaire
    // ---------------------------------------

    public function getComment($commentId){
        $bdd = $this->dbConnect();
        $req = $bdd->prepare('SELECT comment_id, contentComment, dateComment FROM comments WHERE comment_id = ?');
        $req->execute([$commentId]);
        return $req;
    }

    // --------------------------------------
    // requête pour MODIFIER un commentaire
    // --------------------------------------

    public function updateComment($commentId, $updateComment, $date){
        $bdd = $this->dbConnect();
        $req = $bdd->prepare('UPDATE comments SET contentComment = :contentComment, dateComment = :dateComment WHERE comment_id = :comment_id');
        $req->execute([
            'comment_id' => $commentId,           
            'contentComment' => $updateComment,
            'dateComment' => $date
            ]);
        return $req;
    }

    // --------------------------------------
    // requête pour SUPPRIMER un commentaire
    // ---------------------------------------

    public function deleteComment($commentId){
        $bdd = $this->dbConnect();
        $req = $bdd->prepare('DELETE FROM comments WHERE comment_id=?');
        $req->execute([$commentId]);
        return $req;
    }
}



