<?php ob_start(); ?>

<h2>Tableau de bord</h2>

<section class="card_gestion">

    <div class="card_tb">
        <h3><a href="indexAdmin.php?action=articles" title="Afficher tous les articles">Mes articles</a></h3>     
    </div>

    <div class="card_tb">
        <h3><a href="indexAdmin.php?action=images" title="Afficher toutes les images">Mes images</a></h3>        
    </div>
    
</section>

<!-- fonction php pour injecter le template -->
<?php $content = ob_get_clean(); ?>
<?php require 'templates/template.php'; ?>