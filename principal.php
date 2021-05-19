
<html>
    <head>
        <meta charset="utf-8">
        <!-- importer le fichier de style -->
        <link rel="stylesheet" href="style.css" media="screen" type="text/css" />
    </head>
    <body style='background:#fff;'>
        <div id="content">
        <?php
    require ("connexion_bdd.php"); // Inclusion de notre bibliothèque de fonctions
    $db = connexionBase("localhost","root","","jarditou"); // Appel de la fonction de connexion
    
    ?>
            <a href='principal.php?deconnexion=1'><span>Déconnexion</span></a>
            
            <!-- tester si l'utilisateur est connecté -->
            <?php
                session_start();
                if(isset($_GET['deconnexion']))
                {
                var_dump ($_GET['deconnexion']);
                 
                   if($_GET['deconnexion']==true)
                   {  
                       var_dump($_GET['deconnexion']==true);
                      session_unset();
                      header("Location:login.php");
                   }
                }
                else if($_SESSION !== ""){
                    $user = $_SESSION;
                    // afficher un message
                    echo "<br>Bonjour, vous êtes connectés";
                }
            ?>
            
        </div>
    </body>
</html>