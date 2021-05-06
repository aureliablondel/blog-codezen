<?php
    ob_start();
?>

<h2 class="blog-title">Mon Blog Zen</h2>

<section class="intro-container">        
    <?php foreach($blogArticles as $blogArticle): ?>   
        <!-- articles du blog -->
        <article class="articles-block">
            <div class="article-img">
                <img src="<?= $blogArticle['img'] ?>" alt="<?= $blogArticle['titleImg'] ?>">
            </div>
            <div class="article-text">
                <h3><?= htmlspecialchars($blogArticle['title']) ?></h3>
                <p><?= htmlspecialchars($blogArticle['content']) ?></p>
            </div>                                     
        </article> 
        <a class="link-article" href="index.php?action=readArticle&id=<?= $blogArticle['art_id'] ?>" title="Lire l'article complet">Lire la suite</a>   
    <?php endforeach; ?>        
</section>

<?php
    $content = ob_get_clean();
    require 'templates/template.php';
?>