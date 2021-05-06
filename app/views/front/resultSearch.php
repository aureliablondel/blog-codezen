<?php ob_start(); ?>

<h2 class="blog-title">Resultats de la recherche</h2>

<div class="color-content">
    <!-- affiche tous les articles comprenant le mot recherché -->
    <section class="intro-container">           
        <?php foreach($selectSearchs as $selectSearch): ?>   
            <article class="articles-block">
                <div class="article-text">                
                    <h3><?= htmlspecialchars($selectSearch['title']) ?></h3>
                    <p><?= htmlspecialchars($selectSearch['content']) ?></p>                          
                </div> 
            </article>   
            <?php endforeach; ?>  
    </section>
    </div>
<?php
    $content = ob_get_clean();
    require 'templates/template.php';
?>