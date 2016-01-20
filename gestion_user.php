<?php require"function/verif_connexion.php";  ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<link rel="icon" type="image/png" href="images/favicon.png"/>
		<link rel="stylesheet" href="css/style.css" />
		<title>StartinG Blog</title>
	</head>

	<body>
		<header>
				<div class="logo">
					<a href="index.php"><img src="images/logo5.png" /></a>
				</div>
			
			<div class="formulaire">
			<?php if (!isset($_SESSION['pseudo'])) { ?>
				<form method="POST" action="index.php">
					<input  type="text" name="login" placeholder="User.."/>
					<input  type="password" name="password" placeholder="password.."/>
					<input type="submit" name="connexion" class="bouton" value="Connection" />
				</form>
					<?php }  	
					else if (isset($_SESSION['pseudo']) &&  $_SESSION['status'] == "lecteur") { 
					 
						if (isset($_SESSION['pseudo'])) {
		      				$req4 =$bdd->query('SELECT * FROM tp_user WHERE pseudo = "'.$_SESSION['pseudo'].'" ');
		      				$req4->execute();

		      				while ($dataValue = $req4->fetch()) {
		      					$_SESSION['status'] = $dataValue['status'];
		      				}
		      			}
					?>
				<nav>
					<ul>
						<li><a href="index.php"> Accueil </a></li>
					</ul>
				</nav>
			<?php }

			else if (isset($_SESSION['pseudo']) && isset($_SESSION['status']) && $_SESSION['status'] == "auteur") {
				
						if (isset($_SESSION['pseudo'])) {
		      				$req4 =$bdd->query('SELECT * FROM tp_user WHERE pseudo = "'.$_SESSION['pseudo'].'" ');
		      				$req4->execute();

		      				while ($dataValue = $req4->fetch()) {
		      					$_SESSION['status'] = $dataValue['status'];
		      				}
		      			}
					?>
				<nav>
					<ul>
						<li><a href="index.php"> Accueil </a></li>
						<li><a href="billet.php"> Creation de Billet </a></li>
						<li><a href="categorie.php"> Gestion des Categories </a></li>
						<li><a href="gestion_poster.php"> Gestion des Postes </a></li>
					</ul>
				</nav>
			<?php } 
			else if (isset($_SESSION['pseudo']) && isset($_SESSION['status']) && $_SESSION['status'] == "admin") {
				if (isset($_SESSION['pseudo'])) {
		      				$req4 =$bdd->query('SELECT * FROM tp_user WHERE pseudo = "'.$_SESSION['pseudo'].'" ');
		      				$req4->execute();

		      				while ($dataValue = $req4->fetch()) {
		      					$_SESSION['status'] = $dataValue['status'];
		      				}
		      			}
					?>
				<nav>
					<ul>
						<li><a href="index.php"> Accueil </a></li>
						<li><a href="billet.php"> Creation de Billet </a></li>
						<li><a href="categorie.php"> Gestion des Categories </a></li>
						<li><a href="gestion_user.php"> Gestion Users </a></li>
						<li><a href="gestion_poster.php"> Gestion des Postes </a></li>
					</ul>
				</nav>
			<?php }else if (isset($_SESSION['pseudo']) && isset($_SESSION['status']) && $_SESSION['status'] == "bannir") { 
				echo"<script> alert('Vous avez été Banni Désolé <br> Voir  !'); </script>";
				?>
				<form method="POST" action="index.php">
					<input  type="text" name="login" placeholder="User.."/>
					<input  type="password" name="password" placeholder="password.."/>
					<input type="submit" name="connexion" class="bouton" value="Connection" />
				</form>
			<?php } ?>
			</div>
		</header>
		<hr>
		<article>
				<div id="style_poste_user">
					<?php if (!isset($_SESSION['pseudo'])) { ?>
				<center><a href="inscription.php" style="color:#f00;font-weight: bold;">Creer un Compte</a></center>
				<?php }elseif(isset($_SESSION['pseudo']) && $_SESSION['status'] != "bannir") { ?>
				<p align="center"> Votre Ip : <?php echo $_SERVER["SERVER_ADDR"]; ?></p>
					<p align="center">
					<?php 
						if (isset($_SESSION['pseudo']) && $_SESSION['status'] != "bannir") {
		      				$req4 =$bdd->query('SELECT * FROM tp_user WHERE pseudo = "'.$_SESSION['pseudo'].'" ');
		      				$req4->execute();
		      				while ($dataValue = $req4->fetch()) {
		      					$_SESSION['status'] = $dataValue['status'];
		      					$_SESSION['photo'] = $dataValue['avatar'];
		      				}
		      			}
					?>
				<img src='uploader/<?php echo $_SESSION['photo']; ?>' class="avatar" />
				<p/><p align="center"> Bienvenue : <?php echo $_SESSION['pseudo']."<br> Votre Status :".$_SESSION['status']; ?>  </p>
				<p align="center"> <img src="images/logout.png" class="avs" />&nbsp;&nbsp;<font color="#ffffff"><a href="function/deconnexion.php">Se Deconnecter</a></font><br />
				<?php }

				if (isset($_SESSION['pseudo']) && $_SESSION['status'] == "bannir") { ?>
		      				<center><a href="inscription.php" style="color:#f00;font-weight: bold;">Creer un Compte</a></center>
		      	<?php } ?>
				<hr />
				</div>
				<div id="style_poste">

					<fieldset class="aff_pro" style=" overflow: auto;">
                      <legend>Droit d'Acces User</legend>
                            <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
                                <select name="login_user" id="sexe">
                                <option></option>
                                  <?php 
                                  $rep = $bdd->query(" SELECT id_user, pseudo FROM tp_user ORDER BY pseudo ASC");
                                  while ($donnee = $rep->fetch()) {
                                   echo "<option value=".$donnee['id_user'].">".$donnee['pseudo']."</option>";
                                  } ?>
                                </select>
                                <select name="status" id="sexe">
                                  <option>Choisir un Status</option>
                                  <option value="lecteur">Lecteur</option>
                                  <option value="auteur">Auteur</option>
                                  <option value="bannir">Bannir</option>
                                  <option value="admin">Administrateur</option>
                                </select>
                                <button name="edit" class="bout">Editer</button>
                            </form>
                            <?php 
                              if (isset($_POST['edit']) && empty($_POST['edit'])) {
                                $login_user = $_POST['login_user'];
                                $status = $_POST['status'];
                                $reque = $bdd->prepare("UPDATE tp_user SET status = '$status' WHERE id_user = ? ");
                                $res = $reque->execute(array($login_user));
                                echo"Status Modifier .";
                              }
                             ?>
                  </fieldset>

                  <fieldset  class="aff_pro" style="overflow: auto;">
                      <legend>Suppression d'un User</legend>
                            <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
                                <select name="login_user" id="sexe">
                                <option></option>
                                  <?php 
                                  $rep = $bdd->query("SELECT id_user, pseudo FROM tp_user ORDER BY pseudo ASC");
                                  while ($donnee = $rep->fetch()) {
                                   echo "<option value=".$donnee['id_user'].">".$donnee['pseudo']."</option>";
                                  } ?>
                                </select>
                                <button name="del" class="bout">Supprimer Complete</button>
                            </form>
                           <?php if (isset($_POST['del']) && empty($_POST['del'])) { 
                           			$login_user = $_POST['login_user'];
                           			echo "<script>var r = confirm('Confirmation de Suppression!');</script>";
	                                $reque = $bdd->prepare("DELETE tp_user FROM tp_user JOIN tp_billet ON tp_user.id_user = tp_billet.id_user WHERE tp_billet.id_user = ? ");
	                                $res = $reque->execute(array($login_user));
	                                echo"Suppression Complete Valide";
	                              } ?>
 
                            <hr />
                            <strong>Suppression Simple</strong>
                            <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
                                <select name="login_user" id="sexe">
                                <option></option>
                                  <?php 
                                  $rep = $bdd->query(" SELECT id_user, pseudo FROM tp_user ORDER BY pseudo ASC");
                                  while ($donnee = $rep->fetch()) {
                                   echo "<option value=".$donnee['id_user'].">".$donnee['pseudo']."</option>";
                                  } ?>
                                </select>
                                <button name="del_only" class="bout">Supprimer User</button>
                            </form>
	                             <?php   
	                             if (isset($_POST['del_only'])) {
	                             	$idalts = $_POST['login_user'];
	                             	echo "<script>var r = confirm('Confirmation de Suppression!');</script>";
	                                $reque = $bdd->prepare(" DELETE tp_user FROM tp_user  WHERE id_user = ? ");
	                                $res = $reque->execute(array($idalts));
	                                echo"Suppression User Valide";
	                                }
                              	?>
                  </fieldset>


                  <fieldset  class="aff_pro" style="width: 350px; overflow: auto;">
                      <legend>Lister les User</legend>
                                  <?php 
                                  $rep = $bdd->query(" SELECT * FROM tp_user ORDER BY pseudo ASC");
                                  while ($donnee = $rep->fetch()) { ?>
                                  	<p> <img src='uploader/<?php echo $donnee['avatar']; ?>' class="avatars" /> <?php echo $donnee['pseudo']." - ".$donnee['status']." - ".$donnee['date_inscription']; ?> </p><br/>
                                 <?php } ?>

                  </fieldset>

                  <!-- ******************************************************************** -->

                  <fieldset class="aff_pro" style="overflow: auto;">
				        <legend id="mod">Editer</legend>
				          <form id="edit" action="" method="POST">
				            <select name="idMembre" id="sexe">
				                  <option>Nom et Prénom</option>
				                  <?php 
				                  $reqt = 'SELECT * FROM tp_user';
				                  $reps = $bdd->query($reqt);
				                  while ($dataNow = $reps->fetch()) { ?>
				                    <option  value="<?php echo $dataNow['id_user']; ?>"><?php echo $dataNow['pseudo']; ?></option>
				                  <?php } ?>
				            </select>
				            <select name="idChamp" id="sexe">
				                  <option>Champs a Modifier</option>
				                  <option value="pseudo">login</option>
				                  <option value="password">password</option>
				                  <option value="nom">nom</option>
				                  <option value="prenom">prenom</option>
				                  <option value="sexe">sexe</option>
				                  <option value="status">status</option>
				                  <option value="email">email</option>
				                  <option value="date_inscription">date_inscription</option>
				            </select>
				            <input required type="name" name="val_edit" placeholder="Valeur a Editer" class="form_style" />
				            <input type="submit" value="Modifier" name="btn_edit"class="bout"/>
				        </form>
				        <?php 
				          if (isset($_POST['btn_edit'])) {

				            $idUser = $_POST['idMembre'];
				            $Champ    = $_POST['idChamp'];
				            $valEdit  = $_POST['val_edit'];

				            $req = " UPDATE tp_user SET " . $Champ . " = ? WHERE id_user = ? ";
				            $reponse = $bdd->prepare($req);
				            $reponse->execute(array($valEdit, $idUser));
				          }
				        
				         ?>
      				</fieldset>

      				<fieldset class="aff_pro" style="width: 630px; overflow: auto;">
      					<legend>Trier par Role</legend>
      					<form action="" method="POST">
      						<select name="trier" id="sexe">
                                  <option>Choisir un Status</option>
                                  <option value="lecteur">Lecteur</option>
                                  <option value="auteur">Auteur</option>
                                  <option value="bannir">Bannir</option>
                                  <option value="admin">Administrateur</option>
                                </select>
                                <button name="rechercher" class="bout">Rechercher</button>
      					</form>
      					 <?php 
							if (isset($_POST['rechercher'])) {
					              $trier=$_POST['trier'];

					              $reponse = $bdd->prepare("SELECT * FROM tp_user WHERE status = '".$trier."'   ");
					              $reponse->execute();
					              ?>
					              <fieldset class="aff_pro" style="width: 430px;">
					              <?php
					              while ($donnee = $reponse -> fetch() ) { 		              	
					                echo "<p>".$donnee['pseudo']." -- ".$donnee['status']." -- ".$donnee['date_inscription']."</p>";  
					              } ?>
					             </fieldset>
					             <?php
					          }
				        
				         ?>
      				</fieldset>

      <fieldset>
        <legend>  Inscrire Un Utilisateur  </legend>

        <form method="POST" action="gestion_user.php" enctype="multipart/form-data">
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
              <input type="submit" name="inscription" class="bout" value="inscription" required/>
            </div> 
      </form>

       <?php require"function/inscription.php"; ?>
      </fieldset>

				</div>
							
		</article>

	</body>
	</html>
