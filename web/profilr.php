<!DOCTYPE html>


<html>
	<head>
	<title>QCM-Profil_Repondeur</title>
	
	</head>
	
	
<body> 
<?php 
session_start();
require_once('Connexionbdd.php');

$req2=$bdd->prepare('SELECT * FROM public.recapitulatif');
	//$req2->bindValue(':idq',$ligne['id_question']);
	$req2->execute();
	while($ligne2=$req2->fetch(PDO::FETCH_ASSOC))
	{
		echo '<p>Utilisateur : '.$ligne2['utilisateur'].'</br>Moyenne : '.$ligne2['moyenne'].': </br>Nombre de QCM faits : '.$ligne2['nbe_qcm_fait'].'<br/>Note dernier QCM : '.$ligne2['note_dernier_qcm'].'</br>Temps passé : '.$ligne2['temps_passe'];
	}


?>
