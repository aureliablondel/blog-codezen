<?php ob_start(); ?>

<!-- <h2>Création administrateur</h2>
Le formulaire est caché une fois l'administrateur créé

<form class="form-admin" action="indexAdmin.php?action=createAdmin" method="POST">    
    <label for="createPseudo">Pseudo</label>
    <input class="input_form" type="text" id="createPseudo" name="createPseudo">
    <label for="createPass">Mot de passe</label>
    <input class="input_form" type="password" id="createPass" name="createPass">
    
    <div class="btn_container btn_subcon">
        <input type="submit" value="Envoyer" class="btn_gestion btn_blue text_submit">
    </div>
</form> -->

<h2>Connexion administrateur</h2>

<form class="form-admin" action="indexAdmin.php?action=validAdmin" method="POST">    
    <div class=input-connect>
        <label for="pseudoAdmin">Pseudo</label>
        <input class="input_form" type="text" id="pseudoAdmin" name="pseudoAdmin">
    </div>
    <div class=input-connect>
        <label for="passAdmin">Mot de passe</label>
        <input class="input_form" type="password" id="passAdmin" name="passAdmin">
    </div>    
    
    <?php if(isset($error['login-failed'])): ?>      
        <p class="error"><?= $error['login-failed'];?></p>
    <?php endif; ?>

    <div class="btn_container btn_subcon">
        <input type="submit" value="Envoyer" class="btn_gestion btn_blue text_submit">
    </div>
</form>

<?php $content = ob_get_clean(); ?> 
<?php require 'templates/template.php'; ?>