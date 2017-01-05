<?php 
try{
$bdd=new PDO('pgsql:host=localhost;dbname=postgres','qcm_default','vX3Hg8i65Z');
$bdd->query('SET NAMES utf8');
			$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
	die('<p>La connexion a la base à echoué.</p>');
}
?>
