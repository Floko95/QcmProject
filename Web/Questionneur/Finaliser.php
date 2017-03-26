	<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
		 <link rel="stylesheet" href="Finaliser.css" />
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,500;700" rel="stylesheet">
        <title>Finaliser QCM</title>
    </head>
    <body>
<?php
session_start();
require_once('../Autres/Connexionbdd.php');
if (isset($_POST['id']) and trim($_POST['id']!='') and isset($_POST['desc']) and trim($_POST['desc'])!='')
{
	$req=$bdd->prepare("UPDATE qcm set description=:d where id_qcm = :id");
	$req->bindValue(':id',$_POST['id']);
	$req->bindValue(':d',$_POST['desc']);
	$req->execute();
}
if(isset($_POST['id']) and !(isset($_POST['oui'])) and !(isset($_POST['non']))){//si on vient de questions.php,avec l'id du qcm recu
 	$req=$bdd->prepare("UPDATE qcm SET fini = true WHERE id_qcm=:id");//on considere ce qcm fini
	$req->bindValue(':id',$_POST['id']);
	$req->execute();
    ?>
    <div class="conf-modal center success">
    <div class="title-icon">
    <img src="http://jimy.co/res/icon-success.jpg">
    </div>
    <div class="title-text"><h1>Success!</h1></div>
    <p>Vous venez de créer un QCM ! Souhaitez-vous le rendre public dès maintenant. (Vous aurez toujours la possibilité de la faire plus tard à partir de votre profil)</p>
  
    <div class="modal-footer">

    <?php
    
	echo'<form action="Finaliser.php" method="post">
	<input type="hidden" name="id" value="'.$_POST['id'].'"/>
	<input type="submit" name="oui" class="conf-but green" value="Oui"/>
	<input type="submit" name="non" class="conf-but" value="Non"/></form>';//on laisse le choix de le rendre visible ou non?>
         </div>
</div>
        <?php
	
}
if(isset($_POST['oui']))//si oui,on change la bdd pour le rendre visible
{
	$req=$bdd->prepare("UPDATE qcm SET visible = true WHERE id_qcm=:id");
	$req->bindValue(':id',$_POST['id']);
	$req->execute();
	header("Location: AccueilQ.php");
}
if(isset($_POST['non']))//si non, inversement 
{
	$req=$bdd->prepare("UPDATE qcm SET visible = false WHERE id_qcm=:id");
	$req->bindValue(':id',$_POST['id']);
	$req->execute();
	header("Location: AccueilQ.php");
}
//dans les deux cas on renvoie à l'acceuil
      
        
?>
        
    </body>
</html>
