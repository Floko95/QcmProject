<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
		 
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
	echo'<p>Voulez-vous rendre ce qcm visible maintenant? ( ce paramètre est modifiable plus tard dans le profil)</p>';
	echo'<form action="Finaliser.php" method="post">
	<input type="hidden" name="id" value="'.$_POST['id'].'"/>
	<input type="submit" name="oui" value="Oui"/>
	<input type="submit" name="non" value="Non"/></form>';
	
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