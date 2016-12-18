<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
		 <link rel="stylesheet" href="E.css" />
        <title></title>
		 <p><?php if(isset($_POST['nd'])){echo 'Domaine : '.$_POST['nd'];}?></p> 
		 <p><?php if(isset($_POST['idsd'])){echo 'Sous-domaine : '.$_POST['idsd'];}?></p>
		  <p><?php if(isset($_POST['iq'])){echo 'QCM n° '.$_POST['iq'];}?></p> 
    </head>
    <body>
		
<div class="container">
    <h1>Bonne chance</h1>
    <p>Attention: Il peut y avoir plusieurs réponses possibles.</p>
    
  

 <?php 
require_once('Connexionbdd.php');


try{

$date=time();
if(isset($_POST['iq'])and trim($_POST['iq']!=' ')){

///////////////////Calcul temps total
$temps=$bdd->prepare("SELECT * FROM public.qcm_question natural join public.question where id_qcm=:idqcm");
	$temps->bindValue(':idqcm',$_POST['iq']);
	$temps->execute();
	$t=0;
	while($ligne=$temps->fetch(PDO::FETCH_ASSOC))
		{
			$t+=$ligne['temps'];
		}
		echo'<h2>Temps total : '.$t.' secondes.</h2>';
////////////////


	$req=$bdd->prepare("SELECT * FROM public.qcm_question natural join public.question where id_qcm=:idqcm");
	$req->bindValue(':idqcm',$_POST['iq']);
	$req->execute();
	
	while($ligne=$req->fetch(PDO::FETCH_ASSOC))
		{
			echo "<div class=\"form-group\"><label class=\"control-label\" for=\"select\">";
			echo ''.$ligne['id_question'].'. '.htmlspecialchars($ligne['question'],ENT_QUOTES).'</br>';
			echo "</label><i class=\"bar\"></i></div> ";
			
	$req2=$bdd->prepare("SELECT * FROM public.reponse natural join public.question natural join qcm_question where id_qcm=:idqcm and id_question=:numeroquest"); 
	$req2->bindValue(':idqcm',$_POST['iq']);
	$req2->bindValue(':numeroquest',$ligne['id_question']);
	$req2->execute();
	echo'</br>';
	echo '<form action="Statistique.php" method="post">';
		echo '<input type="hidden" name="qcm" value="'.$ligne['id_qcm'].'"/>';
		echo '<input type="hidden" name="temps" value="'.$date.'"/>';
	while($l=$req2->fetch(PDO::FETCH_ASSOC))
		{
			echo'<div class="checkbox"><label>';
			echo'<input type="checkbox" name="reponse[]" value="'.$l['id_reponse'].'"/><i class="helper"></i>'.htmlspecialchars($l['reponse'],ENT_QUOTES).'</br>';
			echo '</div></label>';
			
		}
		
		echo'</br>';
		}
		
		
		echo '<div class="button-container">
    <button class="button" type="submit" name="checkboxes"><span>Submit</span></button>
  </div>';
		echo'</form>';
		

		
}		
}catch(PDOException $e){
	echo'Exception reçue : ',$e->getMessage(),'\n';
}	
?>
</div>


	
	</body>
	</html>
