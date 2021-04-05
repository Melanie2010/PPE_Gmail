<?php
$bdd = new PDO('mysql:host=127.0.0.1;dbname=ppe_gmail', 'root', '');
 
if(isset($_POST['forminscription'])) {
   $nom = htmlspecialchars($_POST['nom']);
   $prenom = htmlspecialchars($_POST['prenom']);
   $mail = htmlspecialchars($_POST['mail']);
   $mdp = sha1($_POST['mdp']);
   if( !empty($_POST['nom']) AND !empty($_POST['prenom']) AND !empty($_POST['mail']) AND !empty($_POST['mdp']) ) {
      $prenomlength = strlen($prenom);
      if($prenomlength <= 255) {
            if(filter_var($mail, FILTER_VALIDATE_EMAIL)) {
               $reqmail = $bdd->prepare("SELECT * FROM data_compte WHERE mail = ?");
               $reqmail->execute(array($mail));
               $mailexist = $reqmail->rowCount();
               if($mailexist == 0){
                     $insertmbr = $bdd->prepare("INSERT INTO data_compte(nom, prenom, mail, mdp) VALUES(?, ?, ?, ?)");
                     $insertmbr->execute(array($nom, $prenom, $mail, $mdp));
                     $erreur = "Votre compte a bien été créé ! ";
                     header("Location: P_CONNEXION.php");
               } else {
                  $erreur = "Adresse mail déjà utilisée !";
               }
            } else {
               $erreur = "Votre adresse mail n'est pas valide !";
            }
      } else {
         $erreur = "Votre prenom ne doit pas dépasser 255 caractères !";
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
    <meta name="description" content="GMAIL">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap" rel="stylesheet">
    <title>GMAIL</title>
</head>
<body>
    <header>
        <h1><img src="./image/mail.png" alt="coney">Gmail</h1>     
        <ul>
            <li ><a href="#" class="menu_un">POUR LES PROS</a></li>
            <li ><a href="P_CONNEXION" class="menu_deux">CONNEXION</a></li>
            <li><a href="#formulaire" class="menu_trois">CREER UN COMPTE</a></li>
        </ul>
    </header>
    <main>
        <div class="header__bannière"> 
            <p class="description_bannière">Retrouvez la fluidité et la simplicité de Gmail sur tous vos appareil</p>
            <a href="#formulaire" class="boutton_creation_compte">CREER UN COMPTE</a>
            <a href="#formulaire"><img class="arrow" src="./image/arrow.png"></a>
        </div>
    </main>
    <footer>
        <div class="titre_boîte_de_réception">
            <p class="titre_un_creation_compte">Une boîte de réception</br>entièrement repensée</p>
            </br>
            <p class="titre_deux_creation_compte">
                Avec les nouveaux onglets personnalisables repérez</br>
                immediatement les nouveaux messages et choisissez</br>
                ceux que vous souhaitez lire en priorité </br>
            </p>
        </div>
        </br></br>
        <fieldset id="formulaire"><legend> Créer un compte </legend>
        <form action="" method="POST" class="form_inscription" action="">
            <div class="form_creation_compte">
                <label for="nom">Nom*</label>
                <input type="text" placeholder="Votre nom" name="nom" id="nom" value="<?php if(isset($nom)) { echo $nom; } ?>" />
            </div>
            </br>
            <div class="form_creation_compte">
                <label for="prenom">Prénom* </label>
                <input type="text" placeholder="Votre prenom" name="prenom" id="prenom" value="<?php if(isset($prenom)) { echo $prenom; } ?>" />
            </div>
            </br>
            <div class="form_creation_compte">
                <label for="mail">Mail* </label>
                <input type="email" placeholder="Votre mail" name="mail" id="mail" value="<?php if(isset($mail)) { echo $mail; } ?>" />
            </div>
            </br>
            <div class="form_creation_compte">
                <label for="mdp">Choisir votre mot de passe* </label>
                <input type="password" placeholder="Votre mot de passe" name="mdp" id="mdp"  />
            </div>
            </br>
            <div>
                <input  class="button_validation__creation_compte" type="submit" name="forminscription" value="VALIDER VOTRE COMPTE">
            </div>
        </form>
        </fieldset>
        <?php
         if(isset($erreur)) {
            echo '<font color="red">'.$erreur."</font>";
         }
         ?>
    </footer>

</body>
</html>






