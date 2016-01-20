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

                  <!-- ******************************************************************** -->
      <fieldset style="height: 400px;overflow: scroll;">
      	<legend>Liste des Commentaires</legend>
      	 <?php 
              $rep = $bdd->query(" SELECT * FROM commentaire LEFT JOIN tp_user ON commentaire.id_user = tp_user.id_user ORDER BY date_com DESC");
              while ($donnee = $rep->fetch()) { ?>
              	<p id="liste"><?php echo "Titre :".$donnee['titre_commentaire']." <br/> ".$donnee['commentaire']." <br />Date du Commentaire : ".$donnee['date_com']." <br /> Commentaire de : <a href='commentaire_info.php?sreemsvxy56Ycbsupload67=".$donnee['id_user']."' style='color:#55C;'>".$donnee['pseudo']."</a>"; ?> </p><br/>
        <?php } ?>
      </fieldset>

      <fieldset style="height: 200px;overflow: auto;">
      	<legend>Modifier Un commentaire</legend>
      	 				<form action="" method="POST">
				            <select name="idMembre" id="sexe" style="width: 600px;">
				                  <option>Titre du Commentaire</option>
				                  <?php 
				                  $reqt = 'SELECT * FROM commentaire LEFT JOIN tp_user ON commentaire.id_user = tp_user.id_user ORDER BY titre_commentaire ASC';
				                  $reps = $bdd->query($reqt);
				                  while ($dataNow = $reps->fetch()) { ?>
				                    <option  value="<?php echo $dataNow['id_tags']; ?>"><?php echo $dataNow['titre_commentaire']." - Commentaire de : ".$dataNow['pseudo']; ?></option>
				                  <?php } ?>
				            </select>
				            <select name="idChamp" id="sexe" style="width: 600px;">
				                  <option>Champs a Modifier</option>
				                  <option value="titre_commentaire">Titre_commentaire</option>
				                  <option value="commentaire">Commentaire</option>
				                  <option value="date_com">Date du Commentaire</option>
				            </select>
				            <input required type="name" name="val_edit" placeholder="Valeur a Editer" class="form_style" style="width: 600px;" />
				            <input type="submit" value="Modifier" name="btn_edit_commentaire"class="bout"/>
				        </form>
				        <?php 
				          if (isset($_POST['btn_edit_commentaire'])) {

				            $idUser = $_POST['idMembre'];
				            $Champ    = $_POST['idChamp'];
				            $valEdit  = $_POST['val_edit'];

				            $req = " UPDATE commentaire SET " . $Champ . " = ? WHERE id_tags = ? ";
				            $reponse = $bdd->prepare($req);
				            $reponse->execute(array($valEdit, $idUser));
				          }
				        
				         ?>
      </fieldset>

      <fieldset style="height: 100px;overflow: auto;">
      	<legend>Supprimer Un commentaire</legend>
      		<form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
                    <select name="idCom" id="sexe" style="width: 600px;">
				                  <option>Titre du Commentaire</option>
				                  <?php 
				                  $reqt = 'SELECT * FROM commentaire LEFT JOIN tp_user ON commentaire.id_user = tp_user.id_user ORDER BY titre_commentaire ASC';
				                  $reps = $bdd->query($reqt);
				                  while ($dataNow = $reps->fetch()) { ?>
				                    <option  value="<?php echo $dataNow['id_tags']; ?>"><?php echo $dataNow['titre_commentaire']." - Commentaire de : ".$dataNow['pseudo']; ?></option>
				                  <?php } ?>
				    </select>
                 <button name="del_only_com" class="bout">Supprimer un commentaire</button>
            </form>
	                             <?php   
	                             if (isset($_POST['del_only_com'])) {
	                             	$idalts = $_POST['idCom'];
	                             	echo "<script>var r = confirm('Confirmation de Suppression!');</script>";
	                                $reque = $bdd->prepare(" DELETE commentaire FROM commentaire  WHERE id_tags = ? ");
	                                $res = $reque->execute(array($idalts));
	                                echo"Suppression Valide";
	                                }
                              	?>
      </fieldset>

      <fieldset style="height: 400px;overflow: auto;">
      	<legend>Liste des Billets</legend>
      	<?php 
              $rep = $bdd->query(" SELECT * FROM tp_billet LEFT JOIN tp_user ON tp_billet.id_user = tp_user.id_user ORDER BY date_post DESC");
              while ($donnee = $rep->fetch()) { ?>
              	<p><?php echo "Titre :".$donnee['titre']." <br/> ".$donnee['corps']." <br />Posté le : ".$donnee['date_post']." <br /> Auteur : ".$donnee['pseudo']; ?> </p><hr/><br/>
        <?php } ?>
      </fieldset>

      <fieldset style="height: 200px;overflow: auto;">
      	<legend>Modification des Billets</legend>
      	<form action="" method="POST">
				            <select name="idMembre" id="sexe" style="width: 600px;">
				                  <option>Titre du Billet</option>
				                  <?php 
				                  $reqt = 'SELECT * FROM tp_billet LEFT JOIN tp_user ON tp_billet.id_user = tp_user.id_user ORDER BY titre ASC';
				                  $reps = $bdd->query($reqt);
				                  while ($dataNow = $reps->fetch()) { ?>
				                    <option  value="<?php echo $dataNow['id_billet']; ?>"><?php echo $dataNow['titre']." - Commentaire de : ".$dataNow['pseudo']; ?></option>
				                  <?php } ?>
				            </select>
				            <select name="idChamp" id="sexe" style="width: 600px;">
				                  <option>Champs a Modifier</option>
				                  <option value="titre">Titre</option>
				                  <option value="chapo">Description</option>
				                  <option value="corps">Corps du Billet</option>
				                  <option value="image">Image du Poste</option>
				                  <option value="date_post">Date du Poste</option>
				            </select>
				            <input required type="name" name="val_edit" placeholder="Valeur a Editer" class="form_style" style="width: 600px;" />
				            <input type="submit" value="Modifier" name="btn_edit_billet"class="bout"/>
				        </form>
				        <?php 
				          if (isset($_POST['btn_edit_billet'])) {

				            $idUser   = $_POST['idMembre'];
				            $Champ    = $_POST['idChamp'];
				            $valEdit  = $_POST['val_edit'];

				            $req = " UPDATE tp_billet SET " . $Champ . " = ? WHERE id_billet = ? ";
				            $reponse = $bdd->prepare($req);
				            $reponse->execute(array($valEdit, $idUser));
				          }
				        
				         ?>
      </fieldset>

      <fieldset style="height: 100px;overflow: auto;">
      	<legend>Suppression des Billets</legend>
      	<form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
                    <select name="idBill" id="sexe" style="width: 600px;">
				                  <option>Titre du Billet</option>
				                  <?php 
				                  $reqt = 'SELECT * FROM tp_billet LEFT JOIN tp_user ON tp_billet.id_user = tp_user.id_user ORDER BY titre ASC';
				                  $reps = $bdd->query($reqt);
				                  while ($dataNow = $reps->fetch()) { ?>
				                    <option  value="<?php echo $dataNow['id_billet']; ?>"><?php echo $dataNow['titre']." - Poster Par : ".$dataNow['pseudo']; ?></option>
				                  <?php } ?>
				    </select>
                 <button name="del_only_billet" class="bout">Supprimer un Billet</button>
            </form>
	                             <?php   
	                             if (isset($_POST['del_only_billet'])) {
	                             	$idBill = $_POST['idBill'];
	                             	echo "<script>var r = alert('Confirmation de Suppression!');</script>";
	                                $reque = $bdd->prepare(" DELETE tp_billet FROM tp_billet  WHERE id_billet = ? ");
	                                $res = $reque->execute(array($idBill));
	                                echo"Suppression Valide";
	                                }
                              	?>
      </fieldset>

      <fieldset style="height: 200px;overflow: auto;">
      	<legend>Modification des Tags</legend>
      	<form action="" method="POST">
				            <select name="idMembre" id="sexe" style="width: 600px;">
				                  <option>Nom du Tags</option>
				                  <?php 
				                  $reqt = 'SELECT * FROM tags ORDER BY nom_tags ASC';
				                  $reps = $bdd->query($reqt);
				                  while ($dataNow = $reps->fetch()) { ?>
				                    <option  value="<?php echo $dataNow['id_tags']; ?>"><?php echo $dataNow['nom_tags']; ?></option>
				                  <?php } ?>
				            </select>
				            <input required type="name" name="val_edit" placeholder="Valeur a Editer" class="form_style" style="width: 600px;" />
				            <input type="submit" value="Modifier Tags" name="edit_tags"class="bout"/>
				        </form>
				        <?php 
				          if (isset($_POST['edit_tags'])) {

				            $idUser   = $_POST['idMembre'];
				            $valEdit  = $_POST['val_edit'];

				            $req = " UPDATE tags SET nom_tags = ? WHERE id_tags = ? ";
				            $reponse = $bdd->prepare($req);
				            $reponse->execute(array($valEdit, $idUser));
				          }
				        
				         ?>
      </fieldset>

      <fieldset style="height: 100px;overflow: auto;">
      	<legend>Suppression des Tags</legend>
      	<form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
                    <select name="idTags" id="sexe" style="width: 600px;">
				                  <option>Nom Tags</option>
				                  <?php 
				                  $reqt = 'SELECT * FROM tags ORDER BY nom_tags ASC';
				                  $reps = $bdd->query($reqt);
				                  while ($dataNow = $reps->fetch()) { ?>
				                     <option  value="<?php echo $dataNow['id_tags']; ?>"><?php echo $dataNow['nom_tags']; ?></option>
				                  <?php } ?>
				    </select>
                 <button name="del_tags" class="bout">Supprimer Tags</button>
            </form>
	                             <?php   
	                             if (isset($_POST['del_tags'])) {
	                             	$idTgas = $_POST['idTags'];
	                             	echo "<script>var r = alert('Confirmation de Suppression!');</script>";
	                                $reque = $bdd->prepare(" DELETE tags FROM tags  WHERE id_tags = ? ");
	                                $res = $reque->execute(array($idTgas));
	                                echo"Suppression Tags Valide";
	                                }
                              	?>
      </fieldset>

				</div>
							
		</article>

	</body>
	</html>
