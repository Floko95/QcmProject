<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
		 <link rel="stylesheet" href="test.css" />
        <title></title>
    </head>
    <body>
		

<div id="desk-nav">
  <nav>
    <ul>
      <li><a href="AccueilR.php">Home</a></li>
      <li><a href="ProfilR.php">Profil</a></li>
      <li><a href="ChoixRD.php">QCM</a></li>
      <li><a href="Index.php">Déconnexion</a></li>
    </ul>
  </nav>
</div>

<!-- END NAVIGATION -->

   

<!-- About  -->

<div id="about-me">

<h2>Profil</h2>
  <p>Pour voir les QCM effectués et leur statistiques.</p>

<?php 
session_start();
require_once('Connexionbdd.php');
///////////////////////////

$tim=0;
$ins=$bdd->prepare('select * from repondeur where nom_repondeur=:n');
$ins->bindValue(':n',$_SESSION['user']);
$ins->execute();
while($lu=$ins->fetch(PDO::FETCH_ASSOC)){
		$tim=$lu['id_repondeur'];
		}

$d=$bdd->prepare('SELECT * FROM recap_repondeur WHERE id_repondeur = :id_rep');
$d->bindValue(':id_rep',$tim);
$d->execute();
	while($l=$d->fetch(PDO::FETCH_ASSOC)){
		echo 'QCM n° '.$l['id_qcm'].'</br> Domaine : '.$l['domaine'].'</br> Sous-domaine : '.$l['sous_domaine'].'</br> Date : '.$l['date_qcm_fait'].'</br> Note : '.$l['note_qcm'].'</br> Temps : '.$l['temps_qcm'].'</br></br>';
	}
	
?>
</div>

<!-- END ABOUT  -->


<!-- Footer -->


<div id="footer-media">

  <a target="_blank" href="https://www.instagram.com/"><img src="https://raw.githubusercontent.com/atloomer/personal-site-revamp/gh-pages/img/insta-icon.png" alt="instagram icon" /></a>
  
  <a target="_blank" href="https://www.facebook.com/"><img src="https://raw.githubusercontent.com/atloomer/personal-site-revamp/gh-pages/img/facebook-icon.png" alt="facebook icon" /></a>

</div>

<footer>

  <p>&copy;  DUT Informatique  <span class="year">2016</span>. All Rights Reserved. </p>
  
</footer>

<!-- END FOOTER  -->
	
	</body>
	</html>
