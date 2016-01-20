<?php require"function/verif_connexion.php";  ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" href="images/logobarre.png"/>
    <link rel="stylesheet" href="css/style.css" />
    <title>StartinG Blog</title>
  </head>

  <body>
    <header>
        <div class="logo">
          <img src="images/logo5.png" />
        </div>
      
      <div class="formulaire">
      <?php if (!isset($_SESSION['pseudo'])) { ?>
        <form method="POST" action="index.php">
          <input  type="text" name="login" placeholder="User.."/>
          <input  type="password" name="password" placeholder="password.."/>
          <input type="submit" name="connexion" class="bouton" value="Connection" />
        </form>
      <?php } ?>
      <?php if (isset($_SESSION['pseudo'])) { ?>
        Accueil - Creation de Billet - Editer mon Profil 
      <?php } ?>
      </div>
        
      <div class="info_user">
        <?php if (!isset($_SESSION['pseudo'])) { ?>
          <a href="inscription.php">Creer un Compte</a>
        <?php } ?>
        <?php if(isset($_SESSION['pseudo'])) { ?>
          <p align="right"><img src="images/avartar.png" class="av" /><br/> Bienvenue : <?php echo $_SESSION['pseudo']; ?>  </p>
          <p align="right"> <img src="images/logout.png" class="avs" /><font color="#ffffff"><a href="function/deconnexion.php">Se Deconnecter</a></font><br />
        <?php } ?>

      </div>
    </header>
    <hr>
    <article>
        <div id="style_poste" style="margin-left: 500px;">
      
      <fieldset>
        <legend>  Inscrivez-vous  </legend>

        <form method="POST" action="inscription.php" enctype="multipart/form-data">
            <div class="forma">
              <label for="nom">Nom :</label>
              <input type="nom" name="nom" id="nom" placeholder="Nom" required />
            </div>
            <div class="forma">
              <label for="prenom">Prenom :</label>
              <input type="prenom" name="prenom" id="prenom" placeholder="Prenom" required/>
            </div>
            <div class="forma">
              <label for="sexe">Sexe : </label>
              <select name="sexe" id="sexe">
                <option>Votre Sexe</option>
                <option value="homme">Homme</option>
                <option value="femme">Femme</option>
              </select>
            </div>
            <div class="forma">
              <label for="email">Email :</label>
              <input type="text" name="email" id="email" placeholder="Votre Email" required/>
            </div>
            <div class="forma">
              <label for="avatar">Avatar :</label>
              <input type="file" name="avatar" id="avatar" placeholder="Avatar" required/>
            </div>
            <div class="forma">
              <label for="login">Login : </label>
              <input type="text" name="login" id="login" placeholder="Login" required/>
            </div>
            <div class="forma">
              <label for="password">Mot de passe :</label>
              <input type="password" name="password" id="password" placeholder="Password" required/>
            </div>
            <div class="forma">
              <label for="confirm">Confirmation :</label>
              <input type="password" name="password_2" id="confirm"  placeholder="Confirmation Password" required/>
            </div>
            <div class="forma">
              <input type="submit" name="inscription" id="bout" value="inscription" required/>
            </div> 
      </form>

       <?php require"function/inscription.php"; ?>
      </fieldset>
      

        </div>
              
    </article>

  </body>
  </html>
