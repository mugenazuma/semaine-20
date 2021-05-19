<?php

session_start();
//var_dump($_POST);
//var_dump(isset($_POST['Registration_date']));
if(isset($_POST['name']) && isset($_POST['firstname'])&& isset($_POST['mail_Address'])&& isset($_POST['Login'])&& isset($_POST['password']) && isset($_POST['Registration_date']))
{
    // connexion à la base de données
    
    require ("connexion_bdd.php"); // Inclusion de notre bibliothèque de fonctions
    
    $db = connexionBase("localhost","root","","jarditou") // Appel de la fonction de connexion
           or die('could not connect to database');
    //var_dump($db);

   // pour éviter les injections xml et sql, pour qu'il soit interprété en code
    $name = htmlspecialchars($_POST['name']);
    $firstname = htmlspecialchars($_POST['firstname']);
    $mail_Address = htmlspecialchars($_POST['mail_Address']);
    $login = htmlspecialchars($_POST['Login']);
    $password = htmlspecialchars($_POST['password']);
    $Registration_date = htmlspecialchars($_POST['Registration_date']);


    
    if($name !== "" && $firstname !== ""&& $mail_Address !== ""&& $login !== ""&& $password !== ""&& $Registration_date !== "")
    {
        $requete = "SELECT count(*)as resultat FROM users where 
              users_Name = '".$name."' and users_firstname = '".$firstname."' and users_mail_Address = '".$mail_Address."' and users_Login = '".$login."' and users_password = '".$password."'and users_Registration_date = '".$Registration_date."'" ;
        $result = $db->query($requete);
        //var_dump($requete);
        //var_dump($result);
        $users=$result->fetch(PDO::FETCH_OBJ);
        //var_dump($users);

      $resultat=$users->resultat;
     // var_dump($resultat);
        if($resultat!=0) // prise en compte de tout les champs renseigné
        {
           $_SESSION['name'] = $name;
           header('Location: principal.php');
          // var_dump($_SESSION);
        }
        else
        {
           header('Location: login.php?erreur=1'); // informations incorrect
        }
    }
    else
    {
       header('Location: login.php?erreur=2'); // informations vide
    }
}
else
{
  header('Location: login.php');
}

?>