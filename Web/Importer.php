<!DOCTYPE html>


<html>
	<head>
	<title>QCM-Importer</title>
	
	</head>
	
	
<body> 




<form action="Importer.php">
<p>Domaine:</p>
<input type="text" name="domaine" />
<p>Sous-Domaine:</p>
<input type="text" name="sdomaine" />
<input type="submit"/>
</form>
<?php


require_once('Connexionbdd.php');


 /*if(isset($_GET['domaine']) and isset($_GET['sdomaine']) and trim($_GET['domaine']!='') and trim($_GET['sdomaine']!=''))
{
	echo "resultats pour ". $_GET['domaine'] . "/" . $_GET['sdomaine'] . " :<br/>";
	if($_GET['sdomaine']=='general')
	{
		$req=$bdd->prepare("SELECT * FROM public.question NATURAL JOIN public.qcm_question WHERE public.qcm_question.domaine=:domaine");
		$req->bindValue(':domaine',$_GET['domaine']);
		$req->execute();
		echo '<form action="Creation.php" method="post">';
		
		while($ligne=$req->fetch(PDO::FETCH_ASSOC))
		{

			if(isset($_POST['idquest'])and trim($_POST['idquest']!='') and $ligne['id_question']==$_POST['idquest'])
			echo '<input type="checkbox" name="questions[]" value="'.$ligne['id_question'].'" checked/>';
			else	
			echo '<input type="checkbox" name="questions[]" value="'.$ligne['id_question'].'"/>';
			echo '<a href="Visualisation.php?q='.$ligne['id_question'].' & domaine='.$_GET['domaine'].'& sdomaine=general"> Question: '.$ligne['question'].'</a><br/>';
			
		}
		echo '<input type="hidden" name="domaine" value="'.$_GET['domaine'].'"/>';
		echo '<input type="submit"/></form>';
	}
	else
	{
		$req=$bdd->prepare("SELECT * FROM public.question NATURAL JOIN public.qcm_question WHERE public.qcm_question.sous_domaine=:sdomaine");
		$req->bindValue(':sdomaine',$_GET['sdomaine']);
		$req->execute();
		echo '<form action="Creation.php" method="post">';
		while($ligne=$req->fetch(PDO::FETCH_ASSOC))
		{
			if(isset($_POST['idquest'])and trim($_POST['idquest']!='') and $ligne['id_question']==$_POST['idquest'])
			echo '<input type="checkbox" name="questions[]" value="'.$ligne['id_question'].'" checked/>';
			else	
			echo '<input type="checkbox" name="questions[]" value="'.$ligne['id_question'].'"/>';
			echo '<a href="Visualisation.php?q='.$ligne['id_question'].' & domaine='.$_GET['domaine'].'& sdomaine='.$_GET['sdomaine'].'"> Question: '.$ligne['question'].'</a><br/>';
			
		}
		echo '<input type="hidden" name="domaine" value="'.$_GET['domaine'].'"/>';
		echo '<input type="hidden" name="sdomaine" value="'.$_GET['sdomaine'].'"/>';
		echo '<input type="submit"/></form>';
	}
}

elseif (isset($_GET['domaine']) and trim($_GET['domaine']!=''))
{
	echo "resultats pour ". $_GET['domaine']." : <br/>";
	echo '<a href="Importer.php?domaine='.$_GET['domaine'].'&sdomaine=general">General</a><br/>';
	$req=$bdd->prepare("SELECT * FROM public.sous_domaine NATURAL JOIN public.domaine WHERE public.domaine.domaine=:ndom");
	$req->bindValue(':ndom',$_GET['domaine']);
	$req->execute();
	while($ligne=$req->fetch(PDO::FETCH_ASSOC))
		{
			echo '<a href="Importer.php?domaine='.$_GET['domaine'].'&sdomaine='.$ligne['sous_domaine'].'">'.$ligne['sous_domaine'].'</a><br/>';
		}
	
	echo'<form action="CreerDomaine.php" method="post"><input type="hidden" value="'.$_GET['domaine'].'" name="domaine"/><input type="submit" name="sbouton" value="Creer Sous-domaine"/></form>';
}

else
{
	echo "Domaines:<br/>";
	$req=$bdd->prepare("SELECT * FROM public.domaine");
	$req->execute();
	while($ligne=$req->fetch(PDO::FETCH_ASSOC))
		{
			echo '<a href="Importer.php?domaine='.$ligne['domaine'].'">'.$ligne['domaine'].'</a><br/>';
		}
	echo'<form action="CreerDomaine.php" method="post"><input type="submit" name="bouton" value="Creer Domaine"/></form>';
}*/
if (isset($_POST['idd']) and trim($_POST['idd']!=''))
{
	$req=$bdd->prepare("SELECT distinct sous_domaine,domaine from qcm where id_qcm=:id");
	$req->bindValue(':id',$_POST['idd']);
	$req->execute();
	$ligne=$req->fetch(PDO::FETCH_ASSOC);
	if ($ligne['sous_domaine']=='')
	{
		$req=$bdd->prepare("SELECT * FROM question INNER JOIN qcm_question ON question.id_question = qcm_question.id_question INNER JOIN qcm ON qcm.id_qcm = qcm_question.id_qcm WHERE qcm.domaine = :domaine");
		$req->bindValue(':domaine',$ligne['domaine']);
		$req->execute();
		echo '<form action="Questions.php" method="post">';
		
		while($ligne=$req->fetch(PDO::FETCH_ASSOC))
		{

			if(isset($_POST['idquest'])and trim($_POST['idquest']!='') and $ligne['id_question']==$_POST['idquest'])
			echo '<input type="checkbox" name="questions[]" value="'.$ligne['id_question'].'" checked/>';
			else	
			echo '<input type="checkbox" name="questions[]" value="'.$ligne['id_question'].'"/>';
			echo '<a href="Visualisation.php?q='.$ligne['id_question'].'</a>';
			
		}
		
		echo '<input type="submit" value="Importer"/></form>';
	}
	else
	{
		$req=$bdd->prepare("SELECT * FROM public.question NATURAL JOIN public.qcm WHERE qcm.sous_domaine=:sdomaine and qcm.domaine=:domaine");
		$req->bindValue(':sdomaine',$ligne['sous_domaine']);
		$req->bindValue(':domaine',$ligne['domaine']);
		$req->execute();
		echo '<form action="Questions.php" method="post">';
		while($ligne=$req->fetch(PDO::FETCH_ASSOC))
		{
			if(isset($_POST['idquest'])and trim($_POST['idquest']!='') and $ligne['id_question']==$_POST['idquest'])
			echo '<input type="checkbox" name="questions[]" value="'.$ligne['id_question'].'" checked/>';
			else	
			echo '<input type="checkbox" name="questions[]" value="'.$ligne['id_question'].'"/>';
			echo '<a href="Visualisation.php?q='.$ligne['id_question'].'"> Question: '.$ligne['question'].'</a>';
			
		}

		echo '<input type="submit" value="Importer/></form>';
	}
}
?>

</body>
</html>
