<?php
    ob_start();
?>

<div class="color-content">

<p class="error-message">Vous devez accepter les conditions d'utilisation du site pour pouvoir poster des commentaires</p>

<p class="title-signup">Les données que vous saisissez ne seront pas utilisées à des fins commerciales. Elles serviront uniquement pour pouvoir vous connecter une prochaine fois.</p>
<a class="btn-return" href="index.php?action=signUp&id=<?=$id?>">Retour à la page d'inscription</a>
<a class="btn-return" href="index.php?action=goRGPD">Consulter la politique du site</a>

</div>

<?php
    $content = ob_get_clean();
    require 'templates/template.php';
?>