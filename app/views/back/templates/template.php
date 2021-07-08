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
                <a href="/"><h1>Code Zen</h1></a>      
            </div>

            <div class="navadmin">
            <!-- menu -->
                <nav>
                    <ul>                        
                        <li><a href="indexAdmin.php?action=disconnection" title="Déconnexion de la session">Déconnexion</a></li>                        
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