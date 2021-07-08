<?php ob_start(); ?>

<h2>Modifier l'article</h2>

<div class="new_article">       
    <form action="indexAdmin.php?action=updateArticle&id=<?= $articleEdited['art_id'] ?>" method="POST">
            <div class="title">        
                <label class="label_form" for="titleEdited">Titre de l'article</label>
                <input class="input_form" type="text" name="title" id="titleEdited" value="<?= htmlspecialchars($articleEdited['title']) ?>">
            </div>

            <div class="content">
                <label class="label_form" for="contentEdited">Contenu</label>      
                <textarea class="input_form" name="content" id="contentEdited"><?= htmlspecialchars($articleEdited['content']) ?></textarea>
            </div>

            <div class="imgEdited">
                <img src="<?= $articleEdited['img'] ?>" alt="<? $articleEdited['titleImg'] ?>">
            </div>            

            <div class="btn_container">
                <input type="submit" value="Editer" class="btn_gestion btn_blue text_submit">
            </div>
        </form>

        <div class="btn_return">
        <a href="indexAdmin.php?action=articles" title="Retour à la liste des articles">Retour aux articles</a>
        </div>
</div>

<?php $content = ob_get_clean(); ?> 
<?php require 'templates/template.php'; ?>