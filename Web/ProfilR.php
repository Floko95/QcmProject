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
$req2=$bdd->prepare('SELECT * FROM public.recapitulatif ');/*order by date desc fetch first 5 rows only */
	//$req2->bindValue(':idq',$ligne['id_question']);
	$req2->execute();
	while($ligne2=$req2->fetch(PDO::FETCH_ASSOC))
	{
		echo '<p>Utilisateur : '.$ligne2['utilisateur']./*'</br>Moyenne : '.$ligne2['moyenne'].' </br>Nombre de QCM faits : '.$ligne2['nbe_qcm_fait'].*/'<br/>Note dernier QCM : '.$ligne2['note_dernier_qcm'].'</br>Temps passé : '.$ligne2['temps_passe'].'';
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
