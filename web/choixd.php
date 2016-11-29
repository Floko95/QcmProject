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
      <li><a href="ar.php">Home</a></li>
      <li><a href="profilr.php">Profil</a></li>
      <li><a href="choixd.php">QCM</a></li>
      <li><a href="a.php">Déconnexion</a></li>
    </ul>
  </nav>
</div>

<!-- END NAVIGATION -->

   

<!-- About  -->

<div id="about-me">

<h2>Domaines</h2>
  <p>Bienvenue. Installe-toi, choisis un thème et arrête de regarder ailleurs, les QCM t'attendent ! </p>

<?php 

require_once('Connexionbdd.php');

try{

	$req=$bdd->prepare("SELECT * FROM public.domaine");
	$req->execute();
	echo "<p>Choisir un domaine : </p>";
	while($ligne=$req->fetch(PDO::FETCH_ASSOC))
		{
			echo '<p><a href="choixsd.php?idd='.$ligne['id_domaine'].'&amp;nd='.$ligne['nom_domaine'].'">'.$ligne['nom_domaine'].'</a></p>';
			
		}
		
}catch(PDOException $e){
	die('<p>Votre requête est erronée.</p>');
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