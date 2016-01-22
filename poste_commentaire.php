

<?php 

		if (isset($_POST['send_commentaire'])) {
			$titre_commentaire  = $_POST['titre_commentaire'];
			$commentaire        = $_POST['corps_commentaire'];
			$varIduser          = $_SESSION['id_user'];
      $id_billet          = $_POST['newid'];
          //Requete insertion dans la tables commentaire
            $req     = 'INSERT INTO commentaire (id_user, id_billet, titre_commentaire, commentaire, date_com) VALUES (:idUser, :idBillet, :titre_commentaire, :commentaire, NOW())';
            $reponse = $bdd->prepare($req);
          //Execution de la requete preparer
            $requete = $reponse->execute(array(
              ":idUser"             => $varIduser,
              ":idBillet"           => $id_billet,
              ":titre_commentaire"  => $titre_commentaire,
              ":commentaire"        => $commentaire
              ));
            echo "<script> alert('COMMENTAIRE VALIDER'); </script>";
        }
        else
        {
          echo"<script> alert('Initialisation du Formulaire A jour !'); </script>";
        }

?>
