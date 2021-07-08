<?php ob_start(); ?>

<h2>Catalogue des images</h2>

<div class="btn_gestion btn_grey">
        <a href="indexAdmin.php?action=image" title="enregistrer une nouvelle image">Nouvelle image</a>
    </div>

<section class="images"> 
    <div class="all_images">   
        <?php foreach($getImages as $getImage):?>        
            <div class="box_img">
                <div class="img_art">
                    <img src="<?= $getImage['img'] ?>" alt="<?= $getImage['titleImg'] ?>">
                </div>
            
                <div class="btn_img">
                    <a href="indexAdmin.php?action=deletImg&id=<?= $getImage['img_id'] ?>" title="Supprimer l'image">Supprimer</a>
                </div>
            </div>        
        <?php endforeach ?>
    </div>
    
</section>

<a href="indexAdmin.php?action=tbAdmin">Retour au tableau de bord</a>

<?php $content = ob_get_clean(); ?>
<?php require 'templates/template.php'; ?>