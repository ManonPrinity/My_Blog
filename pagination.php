
<?php 

    $req = $bdd->query('SELECT id_billet FROM tp_billet');
    $nbr_total_film = $req->rowCount();
    $nbr_film_par_page = 10;
    $nbr_page_film_max_gauche_droit = 4;
    $last_page = ceil($nbr_total_film / $nbr_film_par_page);

    if (isset($_GET['page']) && is_numeric($_GET['page'])) {
      $page_num = $_GET['page'];
    }else{
      $page_num = 1;
    }

    if ($page_num < 1) {
      //verification au cas ou l user entre une valeur inferieur a 1
      $page_num = 1;
    }else if($page_num > $last_page){
      //verification au cas ou l user entre une valeur Supperieur a la valeur totale des pages
      $page_num = $last_page;
    }
  // suite numerique n-1 * 1
  $limit = ' LIMIT '.($page_num - 1) * $nbr_film_par_page.','.$nbr_film_par_page;

  $sql= "SELECT * FROM tp_user 
  LEFT JOIN tp_billet 
  ON tp_user.id_user = tp_billet.id_user 
  WHERE tp_user.id_user = tp_billet.id_user 
  AND tp_billet.date_post <= NOW() 
  ORDER BY tp_billet.date_post DESC $limit";

  $pagination = '';

  if ($last_page != 1) { //je verifie si le nombre de page est deferent de 1
    if ($page_num > 1) {//si le last_page est supperrieur a alors on affiche Precedent 
      $previous = $page_num - 1;
      $pagination .= '<a href="index.php?page='.$previous.'">Precedent</a> &nbsp; &nbsp;'; 

      for ($i=$page_num - $nbr_page_film_max_gauche_droit; $i < $page_num; $i++) { 
        if ($i > 0) {
          $pagination .= '<a href="index.php?page='.$i.'">'.$i.'</a> &nbsp;';
        }
      }
    }

    $pagination .= '&nbsp; <span class="active">'.$page_num.'</span> &nbsp;';

    for ($i=$page_num + 1; $i <=  $last_page; $i++) { 
      $pagination .= '<a href="index.php?page='.$i.'">'.$i.'</a> &nbsp;';

      if ($i >= $page_num + $nbr_page_film_max_gauche_droit) {
        break;
      }
    }

    if ($page_num != $last_page) {
      $next =  $page_num + 1;
      $pagination .= ' <a href="index.php?page='.$next.'">Suivant</a> ';
    }
  }

 ?>
