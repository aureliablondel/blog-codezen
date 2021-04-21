<?php
    ob_start();
?>

<img src="" alt="rue 404">
<p>Désolée, il n'y a personne à cette adresse !</p>

<a class="btn-return" href="index.php?action=signUp&id=<?=$id?>">Retour à l'accueil</a>


<?php
    $content = ob_get_clean();
    require 'templates/template.php';
?>