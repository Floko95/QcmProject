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
      <li><a href="profilr">Profil</a></li>
      <li><a href="choixd.php">QCM</a></li>
      <li><a href="a.php">Déconnexion</a></li>
    </ul>
  </nav>
</div>

<!-- END NAVIGATION -->

   

<!-- About  -->

<div id="about-me">

<h2>QCM</h2>
  <p>Les choses sérieuses débutent: choisis un QCM !</p>

<?php 

require_once('Connexionbdd.php');
try{
	
if(isset($_GET['idsd'])and trim($_GET['idsd']!=' ')){
	echo'sous-domaine : '.$_GET['idsd'];
	$req=$bdd->prepare("SELECT distinct id_qcm,auteur FROM public.qcm natural join public.qcm_question where qcm_question.sous_domaine=:idsd and qcm.id_qcm=qcm_question.id_qcm");
	$req->bindValue(':idsd',$_GET['idsd']);
	$req->execute();
	while($l=$req->fetch(PDO::FETCH_ASSOC))
		{
			echo '<p><a href="e.php?iq='.$l['id_qcm'].'">'.$l['id_qcm'].' '.$l['auteur'].'</a></p>';
		}
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
