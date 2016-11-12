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

try{

	$req=$bdd->prepare("SELECT * FROM public.domaine");
	$req->execute();
	echo "<p>Choisir un domaine : </p>";
	while($ligne=$req->fetch(PDO::FETCH_ASSOC))
		{
			echo '<p><a href="choixsd.php?idd='.$ligne['id_domaine'].'&amp;nd='.$ligne['nom_domaine'].'">'.$ligne['nom_domaine'].'</a></p>';
			
		}
		
}catch(PDOException $e){
	die('<p>Votre requête est erronée.</p>');
}	
?>