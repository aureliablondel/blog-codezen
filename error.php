<?php
    ob_start();
?>

<div class="color-content">
<p class="error-message">Désolée, Une erreur est survenue</p>

<a class="btn-return" href="/" title="Retour à l'accueil">Retour à l'accueil</a>
</div>

<?php
    $content = ob_get_clean();
    require 'app/views/front/templates/template.php';
?>