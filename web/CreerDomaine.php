<!DOCTYPE html>


<html>
	<head>
	<title>QCM-Importer</title>
	
	</head>
	
	
<body> 


<?php if(isset($_POST['bouton']) and $_POST['bouton']=='Creer Domaine')
	{
		echo "<form action='CreerDomaine.php' method='post'><p>Nom du domaine à créer:</p><input type='text' name='domainec'/><input type='submit' value='Creer domaine'/> </form>";
		echo"<form action='Importer.php'><input type=submit value='Retour'/></form>";
	}
	
elseif(isset($_POST['sbouton']) and $_POST['sbouton']=='Creer Sous-domaine' and isset($_POST['domaine']) and trim($_POST['domaine']!=''))
{
	echo "<form action='CreerDomaine.php' method='post'><p>Nom du sous-domaine à créer dans le domaine:".$_POST['domaine']."</p><input type='text' name='sdomainec'/><input type='submit' value='Creer sous-domaine'/> </form>";
echo"<form action='Importer.php'><input type=submit value='Retour'/></form>";
}
?>
</body>
</html>
