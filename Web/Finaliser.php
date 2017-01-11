<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
		 <link rel="stylesheet" href="Finaliser.css" />
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,500;700" rel="stylesheet">
        <title></title>
    </head>
    <body>
<?php
session_start();
require_once('Connexionbdd.php');
if(isset($_POST['id']) and !(isset($_POST['oui'])) and !(isset($_POST['non']))){
 	$req=$bdd->prepare("UPDATE qcm SET fini = true WHERE id_qcm=:id");
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
	<input type="submit" name="non" class="conf-but" value="Non"/></form>';?>
         </div>
</div>
        <?php
	
}
if(isset($_POST['oui']))
{
	$req=$bdd->prepare("UPDATE qcm SET visible = true WHERE id_qcm=:id");
	$req->bindValue(':id',$_POST['id']);
	$req->execute();
	header("Location: AccueilQ.php");
}
if(isset($_POST['non']))
{
	$req=$bdd->prepare("UPDATE qcm SET visible = false WHERE id_qcm=:id");
	$req->bindValue(':id',$_POST['id']);
	$req->execute();
	header("Location: AccueilQ.php");
}

      
        
?>
        
    </body>
</html>