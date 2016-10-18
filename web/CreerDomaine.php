<!DOCTYPE html>


<html>
	<head>
	<title>QCM-Importer</title>
	
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

if(isset($_POST['bouton']) and $_POST['bouton']=='Creer Domaine')
	{
		echo "<form action='CreerDomaine.php' method='post'><p>Nom du domaine à créer:</p><input type='text' name='domainec'/><input type='submit' value='Creer domaine'/> </form>";
		echo"<form action='Importer.php'><input type=submit value='Retour'/></form>";
	}
	
elseif(isset($_POST['sbouton']) and $_POST['sbouton']=='Creer Sous-domaine' and isset($_POST['domaine']) and trim($_POST['domaine']!=''))
{
	echo "<form action='CreerDomaine.php' method='post'><p>Nom du sous-domaine à créer dans le domaine:".$_POST['domaine']."</p><input type='text' name='sdomainec'/><input type='hidden' name='do' value='".$_POST['domaine']."'/><input type='submit' value='Creer sous-domaine'/> </form>";
echo"<form action='Importer.php'><input type=submit value='Retour'/></form>";
}

if(isset($_POST['domainec']) and trim($_POST['domainec']))
{
	$req=$bdd->prepare("INSERT INTO public.domaine values (nextval('domaine_id_domaine_seq'::regclass),:dom)");
	$req->bindValue(':dom',$_POST['domainec']);
	$req->execute();
	echo'<p>Le domaine '. $_POST['domainec'].' a bien été créé.</p>'; 
	echo"<form action='Importer.php'><input type=submit value='Retour'/></form>";
}
if(isset($_POST['sdomainec']) and trim($_POST['sdomainec']))
{
	$req1=$bdd->prepare("SELECT * FROM public.domaine WHERE nom_domaine=:dom");
	$req1->bindValue(':dom',$_POST['do']);
	$req1->execute();
	$ligne=$req1->fetch(PDO::FETCH_ASSOC);
	$req=$bdd->prepare("INSERT INTO public.sous_domaine values (nextval('sous_domaine_id_sous_domaine_seq'::regclass),:do,:sdom)");
	$req->bindValue(':do',$ligne['id_domaine']);
	$req->bindValue(':sdom',$_POST['sdomainec']);
	$req->execute();
	echo'<p>Le domaine '. $_POST['sdomainec'].' a bien été créé dans le domaine '.$_POST['do'].'.</p>';
echo"<form action='Importer.php'><input type=submit value='Retour'/></form>";	
}
?>
</body>
</html>
