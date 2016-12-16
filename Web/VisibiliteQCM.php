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
		echo '<form action="VisualisationQCM.php"><input type="hidden" name="id" value="'.$ligne['id_qcm'].'"/><input type="submit" value="Non"/></form>';
		}
		else{
			echo '<p>le qcm numero'.$ligne['id_qcm'].' est actuellement invisible. Le rendre visible?</p>';
			echo '<form action="VisibiliteQCM.php" method="post"><input type="hidden" name="idqcm" value="'.$ligne['id_qcm'].'"/><input type="submit" name="vist" value="Oui"/></form>';
		echo '<form action="VisualisationQCM.php"><input type="hidden" name="id" value="'.$ligne['id_qcm'].'"/><input type="submit" value="Non"/></form>';
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
	echo '<p>le qcm a été rendu invisible</p><form action="VisualisationQCM.php" method="post"><input type="hidden" name="id" value="'.$_POST['idqcm'].'"/><input type="submit" value="Retour au qcm"/></form>';
}
if(isset($_POST['vist']) and trim($_POST['vist']))
{
	$req=$bdd->prepare("UPDATE qcm SET visible = true WHERE id_qcm=:id");
	$req->bindValue(':id',$_POST['idqcm']);
	$req->execute();
	echo '<p>le qcm a été rendu visible</p><form action="VisualisationQCM.php" method="post"><input type="hidden" name="id" value="'.$_POST['idqcm'].'"/><input type="submit" value="Retour au qcm"/></form>';
}
?>
</div>

<!-- END ABOUT  -->



<!-- END FOOTER  -->
	
	</body>
	</html>

