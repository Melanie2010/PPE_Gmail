<?php
session_start();
$bdd = new PDO('mysql:host=127.0.0.1;dbname=ppe_gmail', 'root', '');

if(isset($_POST['formconnexion'])) {
   $mailconnect = htmlspecialchars($_POST['mailconnect']);
   $mdpconnect = sha1($_POST['mdpconnect']);  
   if(!empty($mailconnect) AND !empty($mdpconnect)) {
      $requser = $bdd->prepare("SELECT * FROM data_compte WHERE mail = ? AND mdp = ?");
      $requser->execute(array($mailconnect, $mdpconnect));
      $userexist = $requser->rowCount();
      if($userexist == 1) {
         $userinfo = $requser->fetch();
         $_SESSION['id'] = $userinfo['id'];
         $_SESSION['mail'] = $userinfo['mail'];
         $erreur = "Vous êtes bien connectés";
      } else {
         $erreur = "Mauvais nom ou mot de passe !";
      }
   } else {
      $erreur = "Tous les champs doivent être complétés !";
   }
}
?>
  
<!DOCTYPE html5>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Gnom">
    <link rel="stylesheet" href="./css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap" rel="stylesheet">
    <title>Gmail</title>
</head>
<body>
    <header>
        <h1><img src="./image/mail.png" alt="coney">Gmail</h1>     
        <ul>
            <li><a href="#" class="menu_un">POUR LES PROS</a></li>
            <li><a href="P_CONNEXION" class="menu_deux">CONNEXION</a></li>
            <li><a href="index" class="menu_trois">CREER UN COMPTE</a></li>
        </ul>
    </header>
    <p class="titre_connexion">Bienvenue dans votre espace </p>  
    <main> 
        </br>
        <fieldset><legend> Connectez-vous à votre compte </legend>
        <form class="connexion_champs" action="" method="POST"  action="">
            <div class="form_creation_compte">
                <label for="mail">Mail</label>
                <input type="email" name="mailconnect" placeholder="Votre mail" />
            </div></br>
            <div class="form_creation_compte">
                <label for="mdp">Mot de passe* </label>
                <input type="password" name="mdpconnect"placeholder="Votre mot de passe" />
            </div></br>
            <div class="form_creation_compte">
                <input class="button_validation__creation_compte" type="submit"name="formconnexion" value="CONNEXION A VOTRE COMPTE"/>
            </div>
        </form>
        </fieldset>
        <?php
         if(isset($erreur)) {
            echo '<font color="red">'.$erreur."</font>";
         }
         ?>
    </main>
       

</body>
</html>







