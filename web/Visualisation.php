<!DOCTYPE html>


<html>
	<head>
	<title>QCM-Visualisation</title>
	
	</head>
	
	
<body> 
<?php 
try{
$bdd=new PDO('pgsql:host=localhost;dbname=postgres','postgres','password');

}
catch(PDOException $e)
{
	die('<p>La connexion a la base à echoué.</p>');
}
$bdd->query('SET NAMES utf8');
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
if(isset($_GET['q']) and trim($_GET['q']!=''))
{
	$req=$bdd->prepare("SELECT * FROM public.question NATURAL JOIN public.qcm_question WHERE id_question=:id");
	$req->bindValue(':id',$_GET['q']);
	$req->execute();
	while($ligne=$req->fetch(PDO::FETCH_ASSOC))
		{
			echo '<p>Question:'.$ligne['question'].'</p> <p>Domaine:'.$ligne['domaine'].'</p><p>Sous-domaine: '.$ligne['sous_domaine'].'</p>';
			
		}
		if(isset($_GET['domaine']) and trim($_GET['domaine']!='') and isset($_GET['sdomaine']) and trim($_GET['sdomaine']!=''))
			echo '<form action="Importer.php?domaine='.$_GET['domaine'].'&sdomaine='.$_GET['sdomaine'].'" method="post"><input type="hidden" name="idquest" value="'.$_GET['q'].'"/><input type="submit" value="Importer la question"/></form>';
	
	
	
}
?>
</body>
</html>
