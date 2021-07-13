<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Comment déboguer son code, comment développer son site en mobile first ou trouver des tutoriels sur le développement d'un projet en MVC ? Autant de thèmes que vous trouverez dans ce blog pour développeuses conçu pour répondre aux questions les plus basiques, et vous donner des astuces testées et approuvées.">
    <title>Code Zen - Le blog pour futur développeuses</title>       
    <!-- feuilles de style -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="app/public/front/css/style.css">
</head>

<body>
    <header class="header-container">
        <!-- logo -->
        <div class="logo-block">
            <h1><a href="/" title="Retour à l'accueil">Code Zen</a></h1>        
        </div>        
        <div class="right-block">
            <!-- zone de recherche -->
            <div class="search-container">
                <form class="search-form" action="index.php?action=searchArticle" method="POST">
                    <input type="search" name="q" placeholder="Rechercher">
                    <button><i class="fas fa-search"></i></button>
                </form>       
            </div>
            <!-- connexion et déconnexion -->
            <div class="log-container">                              
                <a class="space-member" href="index.php?action=logIn" title="Se connecter à son espace"><span>Espace membre</span></a>
                <a class="power-off" href="index.php?action=disconnection" title="Se déconnecter"><i class="fas fa-power-off"></i></a>
            </div>
            <!-- menu -->
            <div class="nav-container">
                <div id="burger">
                    <i class="fas fa-bars"></i>
                </div>
                <nav id="header-menu">
                    <ul id="list-menu">
                        <li><a href="/" title="Retour à l'accueil">Accueil</a></li>
                        <li><a href="index.php?action=blog" title="Aller sur le blog">Blog</a></li>
                        <li><a href="index.php?action=tutos" title="Consulter les tutoriels">Tutoriels</a></li>                
                    </ul>
                </nav>                    
            </div>
        </div>       
    </header>

    <main class="main-content">        
        <?= $content ?>
    </main>

    <footer>
        <aside class="footer-content">
        <p>Copyright Aurélia Blondel - Kercode - 2021</p>
        <a href="index.php?action=mentions" title="Lire les mentions légales">Mentions légales</a>
        </aside>
    </footer>    
    
    <!-- scripts js -->
    <script src="app/public/front/js/burger.js"></script>
    <script src="app/public/front/js/passwordMask.js"></script>
    <script src="app/public/front/js/connectButton.js"></script>
    <script src="app/public/front/js/displayForm.js"></script>
    <script src="app/public/front/js/alertRGPD.js"></script>
</body>
</html>
