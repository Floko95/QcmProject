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

	$req=$bdd->prepare("SELECT * FROM public.qcm_question natural join public.question where id_qcm=:idqcm");
	$req->bindValue(':idqcm',$_GET['iq']);
	$req->execute();
	
	while($ligne=$req->fetch(PDO::FETCH_ASSOC))
		{
			echo '<p>'.$ligne['id_question'].'. '.$ligne['question'].'</p>';
	$req2=$bdd->prepare("SELECT * FROM public.reponse natural join public.question natural join qcm_question where id_qcm=:idqcm and id_question=:numeroquest"); 
	$req2->bindValue(':idqcm',$_GET['iq']);
	$req2->bindValue(':numeroquest',$ligne['id_question']);
	$req2->execute();
	while($l=$req2->fetch(PDO::FETCH_ASSOC))
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