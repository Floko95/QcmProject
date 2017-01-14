<!DOCTYPE html>


<html>
	<head>
    <link rel="stylesheet" href="Visualisation.css" />
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,600' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=PT+Sans+Narrow" rel="stylesheet">
	<title>Visualisation Question</title>
	
	</head>
	
	
<body> 
    
    <div class="container">
    <h1>Visualisation la question</h1>
        
<?php require_once('../Autres/Connexionbdd.php');


if(isset($_POST['q']) and trim($_POST['q']!=''))//on recoit l'id de la question sélectionnée depuis importer.php(ainsi que l'id du qcm)
{
	$req=$bdd->prepare("SELECT * FROM qcm WHERE id_qcm=:id");//on sélectionne ce qcm
	$req->bindValue(':id',$_POST['id']);
	$req->execute();
	$ligne=$req->fetch(PDO::FETCH_ASSOC);
	
    if($ligne['sous_domaine']!=null){
	echo'<h2> Domaine: '.$ligne['domaine'].'</p><p>Sous domaine:'.$ligne['sous_domaine'].'</h2>';
	}else{
	echo'<h2> Domaine: '.$ligne['domaine'].'</p><p>Sous domaine:'.' Général'.'</h2>';	//affichage du domaine et sous domaine(différent si sous domaine nul)
	}
	
	$req=$bdd->prepare("SELECT * FROM question WHERE id_question=:idq");//on selectionne la question g^race à l'id recu
	$req->bindValue(':idq',$_POST['q']);
	$req->execute();
	$question;
	$ligne=$req->fetch(PDO::FETCH_ASSOC);
    
		echo "<div class=\"form-group\"><label class=\"control-label\" for=\"select\">";
		echo 'Question: '.$ligne['question'].'<br/>';//on affiche la question
       
		$question=$ligne['question'];
		$point=$ligne['valeur'];
		$temps=$ligne['temps'];
    
        
		echo 'Point: '.$point.' Temps: '.$temps;
        echo "</label><i class=\"bar\"></i></div></br></br> ";
		
		$req2=$bdd->prepare("SELECT distinct * FROM  reponse where id_question=:idq");//on sélectionne les réponses de la question
		$req2->bindValue(':idq',$ligne['id_question']);
		$req2->execute();
		
		
		while($ligne2=$req2->fetch(PDO::FETCH_ASSOC))//on affiche ces réponses,en distinguant les bonnes des fausses
		{
			if($ligne2['correct']){
            echo'<div class="rep"><div class="green">';
			echo $ligne2['reponse'];
			echo '</div></div> ';
			}else{
            echo'<div class="rep"><div class="red">';
			echo $ligne2['reponse'];
                echo '</div></div> ';
			}
		}//on envoie ensuite la question importée à questions.php
     echo "</br></br>";
	echo '<form action="Questions.php" method="post">
        
		<input type="hidden" name="id" value="'.$_POST['id'].'"/><!--id qcm-->
		<input type="hidden" name="q" value="'.$_POST['q'].'"/><!--id question-->
		<input type="hidden" name="points" value="'.$point.'"/><!--point-->
		<input type="hidden" name="tps" value="'.$temps.'"/><!--temps question-->
        
		<input class="button" type="submit" value="Importer" />
		</form>';
	
    echo '<form action="Questions.php" method="post">
    <input type="hidden" name="id" value="'.$_POST['id'].'"/>
    <input class="button"  type="submit" value="Retour"/></form>';	//sauf si on change d'avis,on envoie rien à questions.php sauf l'id du qcm	
}
?>
 
        
    </div>
</body>
</html>
