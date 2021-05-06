<?php
    ob_start();
?>

<!-- formulaire caché pour poster commentaire - affichage après connexion -->
<div class="display-container"> 
    <?php if(isset($_SESSION['pseudo'])): ?>        
        <div class="title-signup">
            <h2><?php echo 'Bienvenue'.'<span>'.$_SESSION['pseudo'].'*</span>'; ?></h2>
        </div>        
        <form class="form-comment" action="index.php?action=postComment&id=<?=$displayArticle['art_id'] ?>" method="POST">
            <textarea name="comment" placeholder="Commentaire..."></textarea>           
            <div class="btn-form">
                <input class="btn-submit" type="submit" value="Publier">
            </div>
        </form>
    <?php endif; ?>
</div>
            
<div class="articles-block selected-art">
    <!-- reprise de l'image et du titre de l'article sélectionné -->
    <div class="article-img">
        <img src="<?= $displayArticle['img'] ?>" alt="<?= $displayArticle['titleImg'] ?>">               
    </div>    
    <h2 class="selected-title"><?= htmlspecialchars($displayArticle['title']) ?></h2>                                       
</div> 

<section class="intro-container">        
    <?php foreach($detailArticles as $detailArticle): ?> 
          <!-- article complet -->
        <article class="articles-block">            
            <div class="article-text">
                <h3><?= htmlspecialchars($detailArticle['subtitle']) ?></h3>
                <p><?= htmlspecialchars($detailArticle['subcontent']) ?></p>
            </div>                                     
        </article>    
    <?php endforeach; ?>        
</section>  

<div class="connect-block">
    <!-- boutons pour poster un commentaire -->
    <h2>Laissez un commentaire</h2>
    <a class="btn-connect" href="index.php?action=signUp&id=<?= $displayArticle['art_id'] ?>" title="S'inscrire">Première fois ?</a>
    <button id="btn-connect">Déjà inscrit ?</button>
</div>

    <!-- explications apparaissant au passage de la souris -->
<span id="btnOneComment">Cliquez pour vous inscrire et pouvoir poster un commentaire</span>
<span id="btnTwoComment">Cliquez pour vous connecter et poster un commentaire</span>


<form id="form-connect" class="form-signup" action="index.php?action=connectForPost&id=<?= $displayArticle['art_id'] ?>" method="POST">  
    <!-- formulaire de connexion pour les membres -->
    <input class="input-range" type="text" name="pseudo" placeholder="Pseudo">           
    <div class="input-range">      
        <input class="input-range pass" type="password" name="password" placeholder="Mot de passe">          
        <i class="fas fa-eye pass-eye" title="Afficher"></i>
    </div>               
    <?php if(isset($errors['login-failed'])): ?>
        <!-- message erreur identifiants -->
        <span class="error"><?= $errors['login-failed'];?></span>
    <?php endif; ?>         
    <div class="btn-form btn-position">
        <input class="btn-submit" type="submit" value="Envoyer">
    </div>         
</form>

<section class="comments-block" id="comments-block">
    <!-- affichage des commentaires liés à l'article -->
    <?php foreach($getComments as $getComment): ?>  
        <article class="comment-detail">
            <p><?= htmlspecialchars($getComment['contentComment']) ?></p>
            <p class="p-date">Publié le <?= $getComment['dateComment'] ?></p>          
        </article> 
    <?php endforeach; ?>        
</section>

<?php
    $content = ob_get_clean();
    require 'templates/template.php';
?>