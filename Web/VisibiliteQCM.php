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
      <li><a href="Index.php">Home</a></li>
      <li><a href="Profil.php">Profil</a></li>
      <li><a href="ChoixQC.php">QCM</a></li>
      <li><a href="Index.php">Déconnexion</a></li>
    </ul>
  </nav>
</div>

<!-- END NAVIGATION -->

   

<!-- About  -->

<div id="about-me">

<h2>Profil</h2>
  <p>Profil Questionneur.</p>

<?php 
session_start();
require_once('Connexionbdd.php');
if(isset($_POST['vis']) and trim($_POST['vis']!=''))
{
	$req=$bdd->prepare("SELECT * FROM public.qcm where id_qcm=:id");
	$req->bindValue(':id',$_POST['id']);
	$req->execute();
	$ligne=$req->fetch(PDO::FETCH_ASSOC);
	if($ligne['fini'])
	{
		if($ligne['visible'])
		{echo '<p>le qcm numero'.$ligne['id_qcm'].' est actuellement visible. Le rendre invisible?</p>';
		echo '<form action="VisibiliteQCM.php" method="post"><input type="hidden" name="idqcm" value="'.$ligne['id_qcm'].'"/><input type="submit" name="visf" value="Oui"/></form>';
		echo '<form action="Profil.php"><input type="submit" value="Non"/></form>';
		}
		else{
			echo '<p>le qcm numero'.$ligne['id_qcm'].' est actuellement invisible. Le rendre visible?</p>';
			echo '<form action="VisibiliteQCM.php" method="post"><input type="hidden" name="idqcm" value="'.$ligne['id_qcm'].'"/><input type="submit" name="vist" value="Oui"/></form>';
		echo '<form action="Profil.php"><input type="submit" value="Non"/></form>';
		}
	}	
	else
			echo '<p>Ce QCM n\'est pas terminé,Impossible de le rendre visible</p><a href="Profil.php">Retour au profil</a>';
}
if(isset($_POST['visf']) and trim($_POST['visf']))
{
	$req=$bdd->prepare("UPDATE qcm SET visible = false WHERE id_qcm=:id");
	$req->bindValue(':id',$_POST['idqcm']);
	$req->execute();
	echo '<p>le qcm a été rendu invisible</p><a href="Profil.php">Retour au profil</a>';
}
if(isset($_POST['vist']) and trim($_POST['vist']))
{
	$req=$bdd->prepare("UPDATE qcm SET visible = true WHERE id_qcm=:id");
	$req->bindValue(':id',$_POST['idqcm']);
	$req->execute();
	echo '<p>le qcm a été rendu visible</p><a href="Profil.php">Retour au profil</a>';
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

