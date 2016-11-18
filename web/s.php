<?php 

require_once('Connexionbdd.php');

try{


if(isset($_POST['bouton'])and trim($_POST['bouton']!=' ')){
	echo "beuleubeuleubeuleu c'est en travaux...";
echo '<p><img src="http://asvhgbasket.kalisport.com/public/412/upload/images/articles/1-travaux-2-2015-10-19-16-23-58.jpg"/></p>';


}

if(isset($_POST['reponse'])and trim($_POST['reponse']!=' ')){
	echo 'beuleubeuleubeuleu';
//////////////////////////////////////////////-> keep working

}
}catch(PDOException $e){
	die('<p>Votre requête est erronée.</p>');
}
	
?>
