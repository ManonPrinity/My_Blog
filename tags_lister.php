<?php require"function/verif_connexion.php";  ?>
<?php require"function/pagination.php";  ?>
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
				echo"<script> alert('Vous avez été Banni Désolé'); </script>";
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
						<?php 
						if (!isset($_SESSION['pseudo']) || isset($_SESSION['pseudo'])) {

      						$search_tags = $_POST['search_tags'];
				            $sqls= " SELECT * FROM tp_user LEFT JOIN tp_billet ON tp_user.id_user = tp_billet.id_user LEFT JOIN rel_tags_billet ON tp_billet.id_billet = rel_tags_billet.id_billet LEFT JOIN tags ON rel_tags_billet.id_tags = tags.id_tags WHERE tags.nom_tags LIKE '%".$search_tags."%' ";
				            

				            $req = $bdd->query($sqls);
				            while ($donnee = $req->fetch() ) { 
				            	$_SESSION['idBillet'] = $donnee['id_billet'];
				            	 ?>
				             <div>
      							<div id="id_titre"> <?php echo "<p><strong>".$donnee['titre']."</strong></p>"; ?> </div>
      							<div id="id_chapo"> <?php echo "<p>".$donnee['chapo']."</p>"; ?> </div>
      							<div id="id_post">  <?php echo "<p>".$donnee['status']." : ".$donnee['pseudo']."<br/> Publier le :".$donnee['date_post']."<a href='commentaire.php?sreemsvxy56Y63MIKyvnbsdnsbcbsupload67dump=".$_SESSION['idBillet']."' style='float:right;'>Details et Commentaires</a> </p>"; ?>  
      							</div>
      						</div>

				           <?php }  
				          } ?>
				           
				          
				</div>
				<div id="coter_right">
					<h3><u>Categories</u></h3><br/>
					<ul>
					<?php 
					$ret = "SELECT * FROM categorie";
					$red = $bdd->query($ret);
					while ($dataV = $red->fetch()) {
						echo "<li class='cat_n'><a href='#'>" .$dataV['nom_categories']. "</a></li>";
					}
					 ?>
					</ul>
					<hr width="250px" /> 
					<form action="" method="POST">
						<input type="text" name="search_tags" placeholder="Recherche par TAGS" />
						<input type="submit" value="Valider" class="bout" name="tagsPuts" />
					</form>
				</div>	
		</article>

	</body>
	</html>
