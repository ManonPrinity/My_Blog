<?php 

if (isset($_POST['inscription'])) {
          //On verifie que les champs son bien remplir
            if (isset($_POST['nom']) AND !empty($_POST['nom']) AND isset($_POST['prenom']) AND !empty($_POST['prenom']) AND isset($_POST['email']) AND !empty($_POST['email']) AND isset($_POST['password']) AND !empty($_POST['password']) AND isset($_POST['password_2']) AND !empty($_POST['password_2'])) {
              //Recuperation des valeurs envoyées
                    $nom       = htmlspecialchars($_POST['nom']);
                    $prenom    = htmlspecialchars($_POST['prenom']);
                    $sexe      = htmlspecialchars($_POST['sexe']);
                    $status    = "lecteur";
                    $email     = htmlspecialchars($_POST['email']);
                    $password  = sha1($_POST['mdp']);
                    $password2 = sha1($_POST['mdp_2']);

                    $image_name     =  $_FILES["avatar"]["name"];
                    $image_type     =  $_FILES["avatar"]["type"];
                    $image_size     =  $_FILES["avatar"]["size"];
                    $image_tmp_name =  $_FILES["avatar"]["tmp_name"];

              $req2 =$bdd->query('SELECT pseudo FROM tp_user WHERE pseudo = "'.$nom.'" ');
              if ($req2->fetchColumn() == $login){
                   echo"<script> alert('Login deja Utiliser!'); </script>";
              }else{
                
                if ($mdp == $mdp2) {
                       move_uploaded_file($image_tmp_name, "uploader/$image_name");
                      //Requete insertion dans la tables tp_fiche_personne
                        $req     = 'INSERT INTO tp_user (nom, prenom, sexe, avatar, email, password) VALUES (:nom, :prenom, :sexe, :avatar, :email, :mdp, NOW())';
                        $reponse = $bdd->prepare($req);
                      //Executetion de la requete preparer
                        $requete = $reponse->execute(array(
                          ":nom"      => $nom,
                          ":prenom"   => $prenom,
                          ":sexe"     => $sexe,
                          ":status"   => $status,
                          ":avatar"   => $image_name,
                          ":email"    => $email,
                          ":login"    => $login,
                          ":mdp" => $mdp
                          ));
                        echo "<script> alert('VOUS ETRE BIEN INSCRIS'); </script>";
                    }
                    else
                    {
                      echo"<script> alert('Mot de passe Incorrect !'); </script>";
                    } 
              }
            }
          }

 ?>
