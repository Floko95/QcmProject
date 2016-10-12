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
$bdd=[
'Informatique'=>['BDD'=>['Q1bdd','Q2bdd','Q3bdd'],'PHP'=>['Q1php','Q2php','Q3php'],'JAVA'=>['Q1java','Q2java','Q3java'],'C'['Q1c','Q2c','Q3c'],'HTML'=>['Q1html','Q2html','Q3html']],
'Mathematiques'=>['Geométrie'=>['Q1geo','Q2geo','Q3geo'],'Algèbre'=>['Q1algo','Q2algo','Q3algo']],
'Culture  Generale'=>['Histoire'=>['Q1his','Q2hist','Q3hist'],'Cinéma'=>['Q1cin','Q2cin','Q3cin']],
'Medecine'=>['Neurologie'=>['Q1neuro','Q2neuro','Q3neuro'],'Chirurgie'=>['Q1chi','Q2chi','Q3chi']],
'Langues'=>['Anglais'=>['Q1ang','Q2ang','Q3ang'],'Espagnol'=>['Q1esp','Q2esp','Q3esp']],
'Physique-chimie'=>['Physique'=>['Q1phys','Q2phys','Q3phys'],'Chimie'=>['Q1chim','Q2chim','Q3chim']]

];
 if(isset($_GET['domaine']) and isset($_GET['sdomaine']) and trim($_GET['domaine']!='') and trim($_GET['sdomaine']!=''))
{
	echo "resultats pour ". $_GET['domaine'] . "/" . $_GET['sdomaine'] . "\n";
	foreach($bdd as $cle=>$val)
	{
		if ($cle==$_GET['domaine'])
		{
			foreach($val as $c=>$v)
			{
				if ($c==$_GET['sdomaine'])
				{
					foreach($v as $valeur)
				echo "$valeur<br/>";
				}
			}
		}
	}
}

elseif (isset($_GET['domaine']) and trim($_GET['domaine']!=''))
{
	echo "resultats pour". $_GET['domaine']."\n";
	foreach($bdd as $cle=>$val)
	{
		if ($cle==$_GET['domaine'])
		{
			foreach($val as $c=>$v)
			{
				foreach($v as $valeur)
				echo "$valeur<br/>";
			}
		}
	}
}

else
{
	echo "Domaines:<br/>";
	foreach($bdd as $cle=>$val)
	{
		echo"<a href='Importer.php'.$cle>$cle</a><br/>";
		
	}
}
?>

</body>
</html>