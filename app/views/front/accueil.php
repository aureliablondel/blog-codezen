<?php
    ob_start();
?>

<header>
    <!-- en-tête de l'accueil -->
    <div class="principal-img">
        <img src="app/public/front/images/bureau-zen.png" alt="bureau zen">
    </div>
    <div class="title-block">
        <h2 class="principal-title">Mon blog de (futur)développeuse</h2>
    </div>
</header>
    <!-- titre accueil -->
<h2 class="welcome-title">Bonjour, je m'appelle Aurelia et je vous souhaite la bienvenue sur mon site.</h2>
    
<section class="intro-container">        
    <?php foreach($introArticles as $introArticle): ?>  
        <!-- articles de présentation du blog --> 
        <article class="articles-block">
            <div class="article-img">
                <img src="<?= $introArticle['img'] ?>" alt="<?= $introArticle['titleImg'] ?>">
            </div>
            <div class="article-text">
                <h2><?= htmlspecialchars($introArticle['title']) ?></h2>
                <p><?= htmlspecialchars($introArticle['content']) ?></p>
            </div>                          
        </article>    
    <?php endforeach; ?>        
</section>
    
<div class="split-block">
    <!-- bandeaux de séparation -->
    <h2 class="split-title">Mon profil</h2>
</div>

<section class="intro-container"> 
        <!-- article de présentation du profil -->
    <article class="articles-block">
        <div class="article-img">
            <img src="<?= $profilArticle['img'] ?>" alt="<?= $profilArticle['titleImg'] ?>">
        </div>
        <div class="article-text">
            <h2><?= htmlspecialchars($profilArticle['title']) ?></h2>
            <p><?= htmlspecialchars($profilArticle['content']) ?></p>
        </div>                                
    </article>              
</section>

<div class="split-block">
    <!-- bandeaux de séparation -->
    <h2 class="split-title">Mes derniers articles</h2>
</div>

<section class="intro-container">        
    <?php foreach($lastArticles as $lastArticle): ?> 
          <!-- présentation des derniers articles publiés -->
        <article class="articles-block">
            <div class="article-img">
                <img src="<?= $lastArticle['img'] ?>" alt="<?= $lastArticle['titleImg'] ?>">                 
            </div>            
            <div class="article-text">
                <h2><?= htmlspecialchars($lastArticle['title']) ?></h2>
                <p class="date-edit">Publié le <?= $lastArticle['dateEdit']; ?></p>
                <p><?= htmlspecialchars($lastArticle['content']) ?></p>
            </div>                                     
        </article>  
        <a class="link-article" href="index.php?action=readNext&id=<?= $lastArticle['art_id'] ?>" title="Lire l'article complet">Lire l'article</a>  
    <?php endforeach; ?>        
</section>

<?php
    $content = ob_get_clean();
    require 'templates/template.php';
?>


