<?php
    ob_start();
?>

<img src="" alt="rue 404">
<p>Désolée, il n'y a personne à cette adresse !</p>

<a class="btn-return" href="/">Retour à l'accueil</a>


<?php
    $content = ob_get_clean();
    require 'app/views/front/templates/template.php';
?>