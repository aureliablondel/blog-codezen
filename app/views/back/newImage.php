<?php ob_start(); ?>

<h2>Ajouter une image</h2>

<div class="new_article">   
    <form action="indexAdmin.php?action=uploadImg" method="POST" enctype="multipart/form-data" class="formImg">
        <div class="title">
            <label class="label_form" for="titleImg">Titre SEO</label>
            <input class="input_form" type="text" name="title" id="titleImg">
        </div>

        <div class="btn_file">
            <input type="file" id="fileToUpload" name="fileToUpload" class="filesImg">
        </div>

        <div class="btn_container">
            <div class="btn_submit">
                <input type="submit" value="Enregistrer" name="submit" class="btn_gestion btn_blue text_submit">        
                <input type="reset" value="Annuler" class="btn_gestion btn_red text_submit">
            </div>            
        </div>
    </form>

    <div class="btn_return">
        <a href="indexAdmin.php?action=images" title="Retour au catalogue des images">Retour aux images</a>
    </div>

</div>

<?php $content = ob_get_clean(); ?>
<?php require 'templates/template.php'; ?>