<!DOCTYPE html>


<html>
	<head>
	<title>QCM-SOUS_DOMAINE</title>
	
	</head>
	
	
<body> 

<?php 
try{
$bdd=new PDO('pgsql:host=localhost;dbname=postgres','Lucie','2508028473F');
}
catch(PDOException $e)
{
	die('<p>La connexion a la base à echoué.</p>');
}


$bdd->query('SET NAMES utf8');
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if(isset($_GET['idd'])and trim($_GET['idd']!=' ')){
	if(isset($_GET['nd'])and trim($_GET['nd']!=' ')){

	
try{
	$req=$bdd->prepare("SELECT * FROM public.sous_domaine natural join public.domaine where id_domaine=:id");
	$req->bindValue(':id',$_GET['idd']);
	$req->execute();
	echo "<p>Choisir un sous-domaine ou un QCM sans sous-domaine:</p>";
	while($ligne=$req->fetch(PDO::FETCH_ASSOC))
		{
			echo '<p><a href="ChoixQCM.php?idsd='.$ligne['nom_sous_domaine'].'">'.$ligne['nom_sous_domaine'].'</a></p>';
			
		}
	
	$req=$bdd->prepare("SELECT distinct id_qcm,auteur FROM public.qcm natural join public.qcm_question where qcm_question.domaine=:nd and qcm_question.sous_domaine is null and qcm.id_qcm=qcm_question.id_qcm");
	$req->bindValue(':nd',$_GET['nd']);
	$req->execute();
	while($l=$req->fetch(PDO::FETCH_ASSOC))
		{
			echo '<p><a href="Execution.php?iq='.$l['id_qcm'].'">'.$l['id_qcm'].' '.$l['auteur'].'</a></p>';
		}
		
		
		
}catch(PDOException $e){
	die('<p>Votre requête est erronée.</p>');
}	
}	
}
	
?>
</body>
</html>