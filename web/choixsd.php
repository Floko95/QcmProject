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

<h2>Sous-Domaine ou QCM</h2>
  <p>Choisis sagement ou au hasard...</p>

<?php 
require_once('Connexionbdd.php');


if(isset($_GET['idd'])and trim($_GET['idd']!=' ')){
	if(isset($_GET['nd'])and trim($_GET['nd']!=' ')){

	
try{
	$req=$bdd->prepare("SELECT * FROM public.sous_domaine natural join public.domaine where id_domaine=:id");
	$req->bindValue(':id',$_GET['idd']);
	$req->execute();
	echo "<p>Choisir un sous-domaine ou un QCM sans sous-domaine:</p>";
	while($ligne=$req->fetch(PDO::FETCH_ASSOC))
		{
			echo '<p><a href="choixqcm.php?idsd='.$ligne['nom_sous_domaine'].'">'.$ligne['nom_sous_domaine'].'</a></p>';
			
		}
	
	$req=$bdd->prepare("SELECT distinct id_qcm,auteur FROM public.qcm natural join public.qcm_question where qcm_question.domaine=:nd and qcm_question.sous_domaine is null and qcm.id_qcm=qcm_question.id_qcm");
	$req->bindValue(':nd',$_GET['nd']);
	$req->execute();
	while($l=$req->fetch(PDO::FETCH_ASSOC))
		{
			echo '<p><a href="e.php?id_qcm='.$l['id_qcm'].'">'.$l['id_qcm'].' '.$l['auteur'].'</a></p>';
		}
		
		
		
}catch(PDOException $e){
	die('<p>Votre requête est erronée.</p>');
}	
}	
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