<?php
    ob_start();
?>

<div class="color-content">

<p class="error-message">Le mot de passe n'est pas valide</p>

<p class="title-signup">Suite à une erreur dans le changement du mot de passe votre session a été interrompue.</p>
<a class="btn-return" href="index.php?action=logIn" title="Retour à la page de connexion">Retour à la page de connexion</a>

</div>

<?php
    $content = ob_get_clean();
    require 'templates/template.php';
?>