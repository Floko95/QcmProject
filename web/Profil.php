<!DOCTYPE html>


<html>
	<head>
	<title>QCM-Profil</title>
	
	</head>
	
	
<body> 
<?php 
session_start();
require_once('Connexionbdd.php');

if (isset($_POST['qcmb']) and trim($_POST['qcmb']!=''))
{
	$req=$bdd->prepare("SELECT * FROM public.qcm_question natural join public.question where public.qcm_question.id_qcm=:id");
	$req->bindValue(':id',$_POST['id']);
	$req->execute();
	
	while($ligne=$req->fetch(PDO::FETCH_ASSOC))
{
	
	echo 'Question: '.$ligne['question'].'<br/>';
	$req2->prepare("SELECT * FROM public.qcm_question natural join public.reponse where id_question=:idq");
	$req2->bindValue(':idq',$ligne['id_question']);
	$req2->execute();
	$c=0;
	while($ligne2=$req2->fetch(PDO::FETCH_ASSOC))
	{
		if($ligne2['correct'])
		echo '<p>Réponse correcte numéro '.$c.': '.$ligne2['reponse'].'</p><br/>';
		else
		echo '<p>Réponse numéro '.$c.': '.$ligne2['reponse'].'</p><br/>';
		$c++;
	}
	
	
}
echo ' <form action="Profil.php" method="post"><input type="hidden" name="id" value="'.$_POST['id'].'" /><input type="submit" name="supp" value="Supprimer le QCM" /></form>';
}

elseif (isset($_POST['supp']) and trim($_POST['supp']!=''))
{
	echo ' <p>Voulez vous vraiment supprimer le QCM numéro '.$_POST['id'].'?</p>';
	echo ' <form action="Profil.php" method="post"><input type="hidden" name="id" value="'.$_POST['id'].'" /><input type="submit" name="suppc" value="Oui"/> <input type="submit" name="suppn" value="Non"/></form>';
	
}
elseif(isset($_POST['suppc']))
{
	
	$req=$bdd->prepare("DELETE  FROM public.qcm_question WHERE id_qcm=:id");
	$req->bindValue(':id',$_POST['id']);
	$req->execute();
	$req=$bdd->prepare("DELETE  FROM public.qcm WHERE public.qcm.id_qcm=:id");
	$req->bindValue(':id',$_POST['id']);
	$req->execute();
	echo ' <p> Le questionnaire numéro '.$_POST['id']. ' a été supprimé.</p><br/><a href=Profil.php>retour</a>';
}
elseif(isset($_POST['suppn']))
{
	header('Location: Profil.php');
}
else
{
$req=$bdd->prepare("SELECT id_qcm,domaine,sous_domaine FROM public.Qcm join public.Qcm_question on id_qcm where auteur=:aut");
$req->bindValue(':aut',$_SESSION['user']);
$req->execute();
while($ligne=$req->fetch(PDO::FETCH_ASSOC))
{
	echo '<p>Domaine: '.$ligne['domaine'].'  Sous-domaine: '.$ligne['sous_domaine'].' </p>';
	echo '<form action="Profil.php" method="post"><input type="submit" name="qcmb" value="QCM numéro '.$ligne['id_qcm'].'" /><input type="hidden" name="id" value="'.$ligne['id_qcm'].'" /></form>';
	
}
}
?>
