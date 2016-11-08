<!DOCTYPE html>


<html>
	<head>
	<title>QCM-Profil</title>
	
	</head>
	
	
<body> 
<?php 
session_start();
try{
$bdd=new PDO('pgsql:host=localhost;dbname=postgres','postgres','password');
$bdd->query('SET NAMES utf8');
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
	die('<p>La connexion a la base à echoué.</p>');
}

if (isset($_POST['qcmb']) and trim($_POST['qcmb']!=''))
{
	$req=$bdd->prepare("SELECT * FROM public.qcm_question natural join public.question where public.qcm_question.id_qcm=:id");
	$req->bindValue(':id',$_POST['id']);
	$req->execute();
	while($ligne=$req->fetch(PDO::FETCH_ASSOC))
{
	echo "Question: $ligne['question']<br/>";
	
}
echo ' <form action="Profil.php" method="post"><input type="hidden" name="id" value="'.$_POST['id']'" /><input type="submit" name="supp" value="Supprimer le QCM" /></form>';
}

elseif (isset($_POST['supp']) and trim($_POST['supp']!=''))
{
	echo ' <p>Voulez vous vraiment supprimer le QCM numéro '.$_POST['id'].'?</p>';
	echo ' <form action="Profil.php" method="post"><input type="hidden" name="id" value="'.$_POST['id']'" /><input type="submit" name="suppc" value="Oui"/> <input type="submit" name="suppn" value="Non"/></form>'
	
}
elseif(isset($_POST['suppc']))
{
	$req=$bdd->prepare("DELETE * FROM public.qcm_question WHERE public.qcm_question.id_qcm=:id");
	$req->bindValue(':id',$_POST['id']);
	$req->execute();
	$req=$bdd->prepare("DELETE * FROM public.qcm WHERE public.qcm.id_qcm=:id");
	$req->bindValue(':id',$_POST['id']);
	$req->execute();
	echo ' <p> Le questionnaire numéro '.$_POST['id']. ' a été supprimé.</p><br/><a href=Profil.php>retour</a>';
}
elseif(isset($_POST['suppn']))
{
	header('Location:Profil.php');
}
else
{
$req=$bdd->prepare("SELECT * FROM public.Qcm where auteur=:aut");
$req->bindValue(':aut',$_SESSION['user']);
$req->execute();
while($ligne=$req->fetch(PDO::FETCH_ASSOC))
{
	echo '<form action="Profil.php" method="post"><input type="submit" name="qcmb" value="QCM numéro '.$ligne['id_qcm'].'" /><input type="hidden" name="id" value="'</form>.$ligne['id_qcm'].'" /></form>';
	
}
}
?>
