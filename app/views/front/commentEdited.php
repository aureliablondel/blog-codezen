<?php
    ob_start();    
?>

<div class="color-content">

<div class="title-commentEdited">
    <h2 >Modifiez votre commentaire</h2>
    </div>
    <form class="form-comment" action="index.php?action=submitComment&id=<?= $editComment['comment_id'] ?>" method="POST">
        <textarea name="contentComment" id="contentComment"><?= htmlspecialchars($editComment['contentComment']) ?></textarea>
        <label for="date">Publié le</label>
        <input type="datetime-local" name="date" id="date" Placeholder="<?= $editComment['dateComment'] ?>">
        <div class="btn-form">
            <input class="btn-submit" type="submit" value="Envoyer">
        </div>  
    </form>
</div>
</div>


<?php
    $content = ob_get_clean();
    require 'templates/template.php';
?>