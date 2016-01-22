
<?php 

	if (isset($_POST['create_cat'])) {
		$categorie = $_POST['name_categorie'];
		$requete_verif=$bdd->query('SELECT id_categorie FROM categorie WHERE nom_categories = "'.$categorie.'" ');
      	$requete_verif->execute();

	    if (empty($requete_verif->fetch())){
	      	$reqs = $bdd->prepare("INSERT INTO categorie (nom_categories) VALUES(:nom_categorie) ");
			$reponse = $reqs->execute(array(":nom_categorie" => $categorie));
			echo"<script> alert('Categorie Creer '); </script>";
	    }else{
	      	echo"<script> alert('Cette categorie existe deja !'); </script>";
	    }
	}

 ?>
