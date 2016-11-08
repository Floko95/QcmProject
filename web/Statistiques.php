<?php 

try{
$bdd=new PDO('pgsql:host=localhost;dbname=postgres','Lucie','2508028473F');
}
catch(PDOException $e)
{
	die('<p>La connexion a la base à echoué.</p>');
}

try{
$bdd->query('SET NAMES utf8');
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if(isset($_POST['bouton'])and trim($_POST['bouton']!=' ')){
	echo 'beuleubeuleubeuleu';



}

if(isset($_POST['reponse'])and trim($_POST['reponse']!=' ')){
	echo 'beuleubeuleubeuleu';
//////////////////////////////////////////////-> keep working

}
}catch(PDOException $e){
	die('<p>Votre requête est erronée.</p>');
}
	
?>
</body>
</html>
