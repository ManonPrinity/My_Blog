
<?php 
SESSION_START();

require"function/data_bd.php"; 

if (isset($_POST['connexion'])) {
	if(isset($_POST['login']) AND !empty($_POST['login']) AND isset($_POST['password']) AND !empty($_POST['password'])){
	// tout les champ on ete remplit
      $login    = htmlspecialchars($_POST['login']);
      $password = htmlspecialchars(sha1($_POST['password']));
      $status_row1="lecteur";
      $status_row2="auteur";
      $status_row3="admin";
      $status_row4="bannir";

      $requete_login    =$bdd->query('SELECT pseudo FROM tp_user WHERE pseudo = "'.$login.'" ');
      $requete_password =$bdd->query('SELECT password FROM tp_user WHERE password = "'.$password.'" ');
      $requete_status   =$bdd->query('SELECT status FROM tp_user WHERE status = "'.$status_row1.'" ');

      $requete_login->execute();
      $requete_password->execute();
      $requete_status->execute();
      		//Requete pour les lecteur
	      if ($requete_login->fetchColumn() == $login && $requete_password->fetchColumn() == $password && $requete_status->fetchColumn() == $status_row1){
	      	$_SESSION['pseudo'] = $login;
	      	$_SESSION['status'] = $status_row1;

	      		$req4 =$bdd->query('SELECT * FROM tp_user WHERE pseudo = "'.$_SESSION['pseudo'].'" ');
  				$req4->execute();
  				while ($dataValue = $req4->fetch()) {
  					$_SESSION['status'] = $dataValue['status'];
  				}
	      	}//Requete pour les membres auteur
	      	elseif ($requete_login->fetchColumn() == $login && $requete_password->fetchColumn() == $password && $requete_status->fetchColumn() == $status_row2){
	      	$_SESSION['pseudo'] = $login;
	      	$_SESSION['status'] = $status_row2;

	      		$req4 =$bdd->query('SELECT * FROM tp_user WHERE pseudo = "'.$_SESSION['pseudo'].'" ');
  				$req4->execute();
  				while ($dataValue = $req4->fetch()) {
  					$_SESSION['status'] = $dataValue['status'];
  				}
	      	}//Requet au cas ou c'est l'administrateur du site
	      	elseif ($requete_login->fetchColumn() == $login && $requete_password->fetchColumn() == $password && $requete_status->fetchColumn() == $status_row3){
	      	$_SESSION['pseudo'] = $login;
	      	$_SESSION['status'] = $status_row3;

	      		$req4 =$bdd->query('SELECT * FROM tp_user WHERE pseudo = "'.$_SESSION['pseudo'].'" ');
  				$req4->execute();
  				while ($dataValue = $req4->fetch()) {
  					$_SESSION['status'] = $dataValue['status'];
  				}
	      	}//Requete pour les utilisateur bannir de groupe
	      	elseif ($requete_login->fetchColumn() == $login && $requete_password->fetchColumn() == $password && $requete_status->fetchColumn() == $status_row4){
	      	$_SESSION['pseudo'] = $login;
	      	$_SESSION['status'] = $status_row4;

	      		$req4 =$bdd->query('SELECT * FROM tp_user WHERE pseudo = "'.$_SESSION['pseudo'].'" ');
  				$req4->execute();
  				while ($dataValue = $req4->fetch()) {
  					$_SESSION['status'] = $dataValue['status'];
  				}
	      	}else{
	      	
	      	echo"<script> alert('Connexion Impossible !'); </script>";
	      }		
	}
}

?>
