<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
		 <link rel="stylesheet" href="VisibiliteQCM.css" />
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,500;700" rel="stylesheet">
        <title></title>
    </head>
    <body>
		


<!-- END NAVIGATION -->

   

<div class="conf-modal center success">
    <div class="title-icon">
    <img src="http://jimy.co/res/icon-success.jpg">
    </div>
    <div class="title-text"><h1>Visibilité</h1></div>

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
		echo '<div class="modal-footer"><form action="VisibiliteQCM.php" method="post"><input type="hidden" name="idqcm" value="'.$ligne['id_qcm'].'"/><input type="submit" name="visf" class="conf-but green" value="Oui"/></form>';
		echo '<form action="VisualisationQCM.php" method="post"><input type="hidden" name="id" value="'.$ligne['id_qcm'].'"/><input type="submit" class="conf-but" value="Non"/></form></div>';
		echo '</div>';
		}
		else{
			echo '<p>le qcm numero'.$ligne['id_qcm'].' est actuellement invisible. Le rendre visible?</p>';
			echo '<div class="modal-footer"><form action="VisibiliteQCM.php" method="post"><input type="hidden" name="idqcm" value="'.$ligne['id_qcm'].'"/><input type="submit" name="vist" class="conf-but green" value="Oui"/></form>';
		echo '<form action="VisualisationQCM.php" method="post"><input type="hidden" name="id" value="'.$ligne['id_qcm'].'"/><input type="submit" class="conf-but" value="Non"/></form></div>';
		echo '</div>';
		}
	}	
	else
			echo '<p>Ce QCM n\'est pas terminé,Impossible de le rendre visible</p><a href="Profil.php">Retour au profil</a>';
		echo '</div>';
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

	
	</body>
	</html>

