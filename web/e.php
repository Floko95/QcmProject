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

if(isset($_GET['iq'])and trim($_GET['iq']!=' ')){

	$req=$bdd->prepare("SELECT * FROM public.qcm_question natural join public.qcm natural join question where id_qcm=:idqcm");
	$req->bindValue(':idqcm',$_GET['iq']);
	$req->execute();
	while($ligne=$req->fetch(PDO::FETCH_ASSOC))
		{
			echo '<p>'.$ligne['id_question'].'. '.$ligne['question'].'</p>';	
	$req=$bdd->prepare("SELECT * FROM public.reponse natural join public.question where id_question=(SELECT id_question FROM public.qcm_question natural join public.qcm natural join public.question where id_qcm=:idqcm limit 1)");
	$req->bindValue(':idqcm',$_GET['iq']);
	$req->execute();
	while($l=$req->fetch(PDO::FETCH_ASSOC))
		{
			echo '<form action="e.php" method="post"><input type="checkbox" name="reponse" value="'.$l['id_reponse'].'"/>'.$l['reponse'].'</form>';
		
		}
		}
	echo'</br><form action="s.php" method="post"><input type="submit" name="bouton" value="Valider"/></form></br>';
	

		
}		
}catch(PDOException $e){
	echo'Exception reçue : ',$e->getMessage(),'\n';
}	
?>