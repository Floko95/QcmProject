<!DOCTYPE html>


<html>
	<head>
	<title>QCM-Importer</title>
	
	</head>
	
	
<body> 





<?php


require_once('Connexionbdd.php');
$mesquestions=array();
//$post idqcm -> id qcm cree

if (isset($_POST['idd']) and trim($_POST['idd']!=''))
{
/*	$req=$bdd->prepare("SELECT * FROM qcm natural join qcm_question natural join question where id_qcm=:idqcm");
	$req->bindValue(':idqcm',$_POST['idqcm']);
	$req->execute();
	while($l=$req->fetch(PDO::FETCH_ASSOC)){
	echo 'Question : '.htmlspecialchars($l['question'],ENT_QUOTES).'</br>';
	$mesquestions[]+=$l['id_question'];
	}*/
	
	$req=$bdd->prepare("SELECT distinct sous_domaine,domaine from qcm where id_qcm=:id");
	$req->bindValue(':id',$_POST['idqcm']);
	$req->execute();
	$ligne=$req->fetch(PDO::FETCH_ASSOC);
	
	/////////
	echo $ligne['sous_domaine'].' '.$ligne['domaine']; 
	/////////
	//if(){
	if($ligne['sous_domaine']==null){
		//SELECT distinct * FROM question INNER JOIN qcm_question ON question.id_question = qcm_question.id_question INNER JOIN qcm ON qcm.id_qcm = qcm_question.id_qcm WHERE qcm.domaine = :domaine
		$req=$bdd->prepare("Select distinct * from question natural join qcm_question natural join qcm where domaine=:domaine EXCEPT Select * from question natural join qcm_question natural join qcm where id_qcm=:id");
		$req->bindValue(':domaine',$ligne['domaine']);
		$req->bindValue(':id',$_POST['idd']);
		$req->execute();	
	
	}else{
		$req=$bdd->prepare("SELECT distinct * FROM question NATURAL JOIN qcm natural join qcm_question WHERE sous_domaine=:sdomaine and domaine=:domaine EXCEPT Select  * from question NATURAL JOIN qcm natural join qcm_question where id_qcm=:id");
		$req->bindValue(':sdomaine',$ligne['sous_domaine']);
		$req->bindValue(':domaine',$ligne['domaine']);
		$req->bindValue(':id',$_POST['idd']);
		$req->execute();
	}
	$dejadansqcm=0;
	while($ligne=$req->fetch(PDO::FETCH_ASSOC))
		{
			//echo var_dump($_POST);
			echo '<form action="Visualisation.php" method="post">
				<input type="hidden" name="id" value="'.$_POST['idd'].'"/>';
				if(isset($ligne['id_question'])){
				
				/*foreach($mesquestions as $cle=>$val){
					if($ligne['id_question']==$val){
					$dejadansqcm+=1;
				
					}
				}*/
				//if($dejadansqcm==0){
				echo '<input type="hidden" name="q" value="'.$ligne['id_question'].'"/>
				<input type="submit" value="'.$ligne['question'].'"/>';
				}
				//}
				echo '</form>';
		}
	//}
		
		
	
}
?>

</body>
</html>
