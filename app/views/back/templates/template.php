<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord - Espace administrateur</title>
    <!-- feuille de style -->
    <link rel="stylesheet" href="app/public/back/css/style.css">    
</head>

<body>

    <header>
        <div class="headercontainer">
            <div class="logo">
                <h1>Code Zen</h1>        
            </div>

            <div class="navadmin">
            <!-- menu -->
                <nav>
                    <ul>
                        <li><a href="indexAdmin.php?action=tbAdmin" title="Retour au tableau de bord">Tableau de bord</a></li>
                        <li><a href="indexAdmin.php?action=disconnection" title="Déconnexion de la session">Déconnexion</a></li>
                        <li><a href="/" title="Aller sur le site">Accès au site</a></li>
                    </ul>
                </nav>       
            </div>
        </div>
    </header>

    <main>
        <div class="maincontainer">
            <?= $content ?>
        </div>
    </main>
   
</body>

</html>