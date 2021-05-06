<?php
    ob_start();
?>

<div class="color-content">

    <p class="error-message">Les champs ne sont pas correctement renseignés</p>

    <a class="btn-return" href="index.php?action=logIn" title="Retour à la page de connexion">Retour à la page de connexion</a>

</div>

<?php
    $content = ob_get_clean();
    require 'templates/template.php';
?>