<?php
    ob_start();
?>

<div class="color-content">

    <div class="title-signup">
        <h2>Page en construction</h2>
        <p>Retrouvez bientôt mes tutos sur cette page</p>
    </div>

    <a class="btn-return" href="/" title="Retour à l'accueil">Retour à la page d'accueil</a>

</div>

<?php
    $content = ob_get_clean();
    require 'templates/template.php';
?>
