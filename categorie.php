<?php require"function/verif_connexion.php";  ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<link rel="icon" type="image/png" href="images/"/>
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
		      					$_SESSION['id_user'] = $dataValue['id_user'];
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
		      					$_SESSION['id_user'] = $dataValue['id_user'];
		      				}
		      			}
					?>
				<nav>
					<ul>
						<li><a href="index.php"> Accueil </a></li>
						<li><a href="billet.php"> Creation de Billet </a></li>
						<li><a href="categorie.php"> Gestion des Categories </a></li>
						<li><a href="gestion_user.php"> Gestion Users </a>
						<li><a href="gestion_poster.php"> Gestion des Postes </a></li>
						</li>
					</ul>
				</nav>
			<?php }else if (isset($_SESSION['pseudo']) && isset($_SESSION['status']) && $_SESSION['status'] == "bannir") { 
				echo"<script> alert('Vous avez été Banni Désolé !'); </script>";
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
					<fieldset>
					<?php require"function/creer_cat.php"; ?>
						<legend>Ajouter une Categorie</legend>
						<form method="POST" action="categorie.php">
						<input type="text" name="name_categorie" maxlength="100" class="text_billet" placeholder="Entrez une Categorie" />
							<input type="submit" value="Creer" class="bout" name="create_cat" />
						</form>
					</fieldset>

					<fieldset>
						<legend>Supprimer une Categorie</legend>
						<form method="POST" action="categorie.php">
						<select name="idCatsup" id="sexe" style="margin-top:10px;">
				                  <option>Liste des Categories</option>
				                  <?php 
				                  $reqt = 'SELECT * FROM categorie';
				                  $reps = $bdd->query($reqt);
				                  while ($dataNow = $reps->fetch()) { ?>
				                    <option  value="<?php echo $dataNow['id_categorie']; ?>"><?php echo $dataNow['nom_categories']; ?></option>
				                  <?php } ?>
				            </select>
							<input type="submit" value="Supprimer" class="bout" name="sup_cat" />
						</form>
								<?php   
	                             if (isset($_POST['sup_cat'])) {
	                             	$idCat_Sup = $_POST['idCatsup'];
	                             	echo "<script>var r = alert('Confirmation de Suppression!');</script>";
	                                $reque = $bdd->prepare("DELETE categorie FROM categorie WHERE id_categorie = ? ");
	                                $res = $reque->execute(array($idCat_Sup));

	                                $reque = $bdd->prepare(" DELETE tp_billet FROM tp_billet  WHERE id_categorie = ? ");
	                                $res = $reque->execute(array($idCat_Sup));

	                                echo"Suppression Valide";
	                                }
                              	?>
					</fieldset>

					<fieldset>
				        <legend>Modification d'information</legend>
				          <form action="" method="POST">
				            <select name="idCat" id="sexe" style="margin-top:10px;">
				                  <option>Liste des Categories</option>
				                  <?php 
				                  $reqt = 'SELECT * FROM categorie';
				                  $reps = $bdd->query($reqt);
				                  while ($dataNow = $reps->fetch()) { ?>
				                    <option  value="<?php echo $dataNow['id_categorie']; ?>"><?php echo $dataNow['nom_categories']; ?></option>
				                  <?php } ?>
				            </select>
				            <input required type="name" name="val_edit" placeholder="Valeur a Editer" />
				            <input type="submit" value="Modifier" name="mod_cat" class="bout" />
				        </form>
				        <?php 
				          if (isset($_POST['mod_cat'])) {

				            $idCat = $_POST['idCat'];
				            $valEdit  = $_POST['val_edit'];

				            $req = " UPDATE categorie SET nom_categories = ? WHERE id_categorie = ? ";
				            $reponse = $bdd->prepare($req);
				            $reponse->execute(array($valEdit, $idCat));
				          }
				        
				         ?>
      				</fieldset>
				</div>
							
		</article>

	</body>
	</html>
