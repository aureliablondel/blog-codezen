<?php ob_start(); ?>

<h2>Liste des articles</h2>

<div class="btn_gestion btn_grey">
    <a href="indexAdmin.php?action=createArticle" title="Créer un nouvel article">Nouvel article</a>
</div>

<section class="all_articles"> 
    <div class="articles">
        <?php foreach($allArticles as $allArticle): ?>
            <article class="article">
                <div class="card_article">
                    <div class="imgOfArticle">
                        <img src="<?= $allArticle['img'] ?>" alt="<?= $allArticle['titleImg'] ?>">
                    </div>
                    <h3><?= htmlspecialchars($allArticle['title']) ?></h3>
                    <p><?= htmlspecialchars($allArticle['content']) ?></p>                
                </div>

                <div class="btn">                   
                    <div class="btn_gestion btn_blue">
                        <a href="indexAdmin.php?action=editArticle&id=<?= $allArticle['art_id'] ?>" title="Afficher l'article à modifier">Modifier</a>
                    </div>
                            
                    <div class="btn_gestion btn_red">
                        <a href="indexAdmin.php?action=deleteArticle&id=<?= $allArticle['art_id'] ?>" title="supprimer l'article">Supprimer</a>
                    </div>
                </div>
            </article>
        <?php endforeach; ?>
    </div>    
</section>

<a href="indexAdmin.php?action=tbAdmin">Retour au tableau de bord</a>

<?php $content = ob_get_clean(); ?>
<?php require 'templates/template.php'; ?>