

<?php 

		if (isset($_POST['send_billet'])) {
			$titre = $_POST['titre'];
			$chapo = $_POST['chapo'];
			$corps = $_POST['corps'];
      $id_cat = $_POST['id_categorie'];
			$varIduser=$_SESSION['id_user'];
      $tag = $_POST['tags'];
      $dater = $_POST['date_poster'];
      $tableau_tags = explode("#", $tag);

      $image_billet     =  $_FILES["image"]["name"];
      $image_type     =  $_FILES["image"]["type"];
      $image_size     =  $_FILES["image"]["size"];
      $image_tmp_name =  $_FILES["image"]["tmp_name"];

           move_uploaded_file($image_tmp_name, "uploader_poster/$image_billet");

          //Requete insertion dans la tables tp_billet
            $req     = 'INSERT INTO tp_billet (id_user, id_categorie, titre, chapo, corps, image, date_post) VALUES (:idUser, :idCat, :titre, :chapo, :corps, :image, :dater)';
            $reponse = $bdd->prepare($req);
          //Execution de la requete preparer

            $requete = $reponse->execute(array(
              ":idUser" => $varIduser,
              ":idCat"  => $id_cat,
              ":titre"  => $titre,
              ":chapo"  => $chapo,
              ":corps"  => $corps,
              ":image"  => $image_billet,
              ":dater"  => $dater
              ));
             $idCats  =  intval($bdd->lastInsertId());

            //requete insertion pour la tables tags
            foreach ($tableau_tags as $value) {
              $sql = 'INSERT INTO tags (nom_tags) VALUES (:tager)';
              $rep = $bdd->prepare($sql);
              $rep->bindParam(':tager', $value, PDO::PARAM_INT);
              $ret = $rep->execute();
              $idTager =  intval($bdd->lastInsertId('id_tags'));

              //requete insertion pour la tables des relation entre tags et billets
              $sqls    = 'INSERT INTO rel_tags_billet (id_tags, id_billet) VALUES (:id_tager, :id_billet)';
              $reps    = $bdd->prepare($sqls);
              $reps->bindParam(':id_tager', $idTager, PDO::PARAM_INT);
              $reps->bindParam(':id_billet', $idCats, PDO::PARAM_INT);
              $requete = $reps->execute();
            }



            echo "<script> alert('POSTE ENVEOYER'); </script>";
        }
        else
        {
          echo"<script> alert('Initialisation du Formulaire A jour !'); </script>";
        }

?>
