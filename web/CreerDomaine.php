<!DOCTYPE html>


<html>
	<head>
	<title>QCM-Importer</title>
	
	</head>
	
	
<body> 


<?php if(isset($_POST['bouton']) and $_POST['bouton']=='Creer Domaine')
	echo"<p>domaine a créer </p>";
elseif(isset($_POST['sbouton']) and $_POST['sbouton']=='Creer Sous-domaine')
echo"<p>sous domaine a creer</p>";
?>
</body>
</html>