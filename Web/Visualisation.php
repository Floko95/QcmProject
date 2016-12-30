<!DOCTYPE html>


<html>
	<head>
	 <link rel="stylesheet" href="VisualisationQCM.css" />
	<title>QCM-Visualisation</title>
	
	</head>
	
	
<body> 
<?php 
require_once('Connexionbdd.php');
if(isset($_POST['q']) and trim($_POST['q']!=''))
{
	$req=$bdd->prepare("SELECT * FROM qcm WHERE id_qcm=:id");
	$req->bindValue(':id',$_POST['id']);
	$req->execute();
	$ligne=$req->fetch(PDO::FETCH_ASSOC);
	echo'<p> Domaine: '.$ligne['domaine'].'</p><p>Sous domaine:'.$ligne['sous_domaine'].'</p>';
	$req=$bdd->prepare("SELECT * FROM public.question  WHERE id_question=:idq");
	$req->bindValue(':idq',$_POST['q']);
	$req->execute();
	$ligne=$req->fetch(PDO::FETCH_ASSOC);
		echo "<div class=\"form-group\"><label class=\"control-label\" for=\"select\">";
		echo 'Question: '.$ligne['question'].'<br/>';
		echo "</label><i class=\"bar\"></i></div> ";
		$req2=$bdd->prepare("SELECT * FROM public.qcm_question natural join public.reponse where id_question=:idq");
		$req2->bindValue(':idq',$ligne['id_question']);
		$req2->execute();
		
		echo'</br></br>';
		while($ligne2=$req2->fetch(PDO::FETCH_ASSOC))
		{
			if($ligne2['correct']){
				echo'<i class="helper"><div class="green">';
			echo $ligne2['reponse'];
			echo '</div> ';
			}else{
				echo'<i class="helper"><div class="red">';
			echo $ligne2['reponse'];
			echo '</div> ';
			}						
		}
	echo '<form action="Questions.php" method="post">
		<input type="hidden" name="id" value="'.$_POST['id'].'"/>
		<input type="hidden" name="q" value="'.$_POST['q'].'"/>
		<input type="submit" value="Importer cette question" />
		</form>';
	
}
?>
</body>
</html>
