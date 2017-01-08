<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
		 <link rel="stylesheet" href="Questions.css" />
        <link href="https://fonts.googleapis.com/css?family=PT+Sans+Narrow" rel="stylesheet">
        <title></title>
    </head>
    <body>


        <div id="desk-nav">
		<nav>
			<ul>
				<li><a href="AccueilQ.php">Home</a></li>
				<li><a href="Profil.php">Profil</a></li>
				<li><a href="ChoixQC.php">QCM</a></li>
				<li><a href="Index.php">Déconnexion</a></li>
			</ul>
		</nav>
	</div>
        
        
        
        
        
    <div class="container">
    <h1>Liste Question</h1>
		

<?php
session_start();
require_once('Connexionbdd.php');

$monidqcm;
if(isset($_POST['modif']))
{
	$req=$bdd->prepare("UPDATE qcm SET fini = false WHERE id_qcm=:id");
	$req->bindValue(':id',$_POST['id']);
	$req->execute();
	echo 'reprise de la création du QCM numéro '.$_POST['id'];
}
	if(isset($_POST['id'])){
		
		if(isset($_POST['dom'])){
			echo 'Domaine du qcm: '.$_POST['dom'].'</br>';
		}
		if (isset($_POST['sdom'])){
			echo 'Sous_domaine du qcm:'.$_POST['sdom'].'</br>';
		}
		
		echo '<h2>id du qcm: '.$_POST['id'].'</h2>';
		$monidqcm=$_POST['id'];
	}
	
	
//$monidqcm->id qcm que l'on cree

if (isset($_POST['q'])){
	

	
	if(isset($_POST['creaquestion'])){//si on arrive de creation question
	
	
	
		
	
	if(isset($_POST['exp']) and trim($_POST['exp'])!=''){
	$req=$bdd->prepare('INSERT INTO question (question,valeur,temps,explication) VALUES (:q,:v,:t,:e)');
	$req->bindValue(':q',$_POST['q']);
	$req->bindValue(':v',$_POST['points']);
	$req->bindValue(':t',$_POST['tps']);
	$req->bindValue(':e',$_POST['exp']);
	$req->execute();
	}else{
	$req=$bdd->prepare('INSERT INTO question (question,valeur,temps) VALUES (:q,:v,:t)');
	$req->bindValue(':q',$_POST['q']);
	$req->bindValue(':v',$_POST['points']);
	$req->bindValue(':t',$_POST['tps']);
	$req->execute();
	}
	
///////////////07012017
		$i=0;
		$note_tota=$bdd->prepare("SELECT id_question FROM question where question=:q");
$note_tota->bindValue(':q',$_POST['q']);
$note_tota->execute();
while($ligne=$note_tota->fetch(PDO::FETCH_ASSOC)){
	$i=$ligne['id_question'];
}

$note_total=$bdd->prepare("SELECT valeur FROM question where id_question=:q");
$note_total->bindValue(':q',$i);
$note_total->execute();
while($ligne=$note_total->fetch(PDO::FETCH_ASSOC)){
	$note=$ligne['valeur'];
}
$up=$bdd->prepare("update qcm set note_total=note_total+:n where id_qcm=:mq");
$up->bindValue(':n',$note);
$up->bindValue(':mq',$monidqcm);
$up->execute();


///////////////
	$tab = array_combine($_POST['Rep'], $_POST['select']);
	
	//recuperer id question pour l'inserer dans reponse
	$idq=0;
	$idquestion=$bdd->prepare('select id_question from question where question=:q');
	$idquestion->bindValue(':q',$_POST['q']);
	$idquestion->execute();
	while($ligne=$idquestion->fetch(PDO::FETCH_ASSOC))
    {
		$idq=$ligne['id_question'];
	}
	
	$select;
	foreach($_POST['select'] as $clee => $vall){
		$select[]=$vall;
	}
	
	//inserer les reponses suivant faux/vrai
	foreach($_POST['Rep'] as $cle => $val){
	if($select[$cle]=='Vrai'){
	$req2 = $bdd->prepare('INSERT INTO Reponse(id_question,reponse,correct) VALUES(:q,:rep,true)');
	$req2->bindValue(':q',$idq);
	$req2->bindValue(':rep',$val);
	$req2->execute();
	
	}elseif($select[$cle]=='Faux'){
	$req3 = $bdd->prepare('INSERT INTO reponse(id_question,reponse,correct) VALUES(:q,:rep,false)');
	$req3->bindValue(':q',$idq);
	$req3->bindValue(':rep',$val);
	$req3->execute();
	}
	}
	
	
	$req4 = $bdd->prepare('INSERT INTO qcm_question(id_qcm,id_question) VALUES(:idqcm,:idquestion)');//dans les deux cas on relie la question au qcm et on affiche le contenu du qcm en cours de creation
	$req4->bindValue(':idqcm',$monidqcm);
	$req4->bindValue(':idquestion',$idq);
	$req4->execute();
	
	}else{

		
				///////////////07012017
	$note;
$note_total=$bdd->prepare("SELECT valeur FROM question where id_question=:q");
$note_total->bindValue(':q',$_POST['q']);
$note_total->execute();
while($ligne=$note_total->fetch(PDO::FETCH_ASSOC)){
	$note=$ligne['valeur'];
}
	
	 
$up=$bdd->prepare("update qcm set note_total=note_total+:n where id_qcm=:q");
$up->bindValue(':n',$note);
$up->bindValue(':q',$monidqcm);
$up->execute();
///////////////
		
		
		//$idq=$_POST['q'];
	$req4 = $bdd->prepare('INSERT INTO qcm_question(id_qcm,id_question) VALUES(:idqcm,:idquestion)');//dans les deux cas on relie la question au qcm et on affiche le contenu du qcm en cours de creation
	$req4->bindValue(':idqcm',$monidqcm);
	$req4->bindValue(':idquestion',$_POST['q']);
	$req4->execute();
		
	}
	
	echo ' </br>';
	if(isset($monidqcm)){
 	$req=$bdd->prepare("SELECT * FROM qcm natural join qcm_question natural join question where id_qcm=:idqcm");
	$req->bindValue(':idqcm',$monidqcm);
	$req->execute();
	while($ligne=$req->fetch(PDO::FETCH_ASSOC)){
        echo "<div class=\"form-group\"><label class=\"control-label\" for=\"select\">";
	echo 'Q : '.htmlspecialchars($ligne['question'],ENT_QUOTES).'</br>';
	echo "</label><i class=\"bar\"></i></div> ";
	
	
	$req2=$bdd->prepare("SELECT * FROM reponse natural join question natural join qcm_question natural join qcm where id_qcm=:idqcm and id_question=:numeroquest"); // 
	$req2->bindValue(':idqcm',$monidqcm);
	$req2->bindValue(':numeroquest',$ligne['id_question']);
	$req2->execute();
	echo'</br>';
	while($l=$req2->fetch(PDO::FETCH_ASSOC)){
        if($l['correct']){
             echo '<i class="helper"><div class="green"> '.$l['reponse'].' </i></div>';
        }else{
                  echo '<i class="helper"><div class="red">'.$l['reponse'].' </i></div>';
	   }  
    }

	echo'</br>';
	}	

}
		
}

?>


        
         <?php
        
		
		
        
            echo '<form action="Finaliser.php" method="post">
            <input type="hidden" name="id" value="'.$_POST['id'].'"/>
            <div class="button-container"><button type="submit" class="button"><span>Valider QCM</span></button></form>';
        
		
            echo' <form action="CreationQuestions.php" method="post">
			<input type="hidden" name="idd" value="'.$_POST['id'].'"/>
			<input type="hidden" name="idqcm" value="'.$monidqcm.'"/>
			<button type="submit" class="button"><span>Créer Question</span></button></form>';
			
			
			echo' <form action="Importer.php" method="post">
			<input type="hidden" name="idd" value="'.$_POST['id'].'"/>
			<input type="hidden" name="idqcm" value="'.$monidqcm.'"/>
			<button type="submit" class="button"><span>Importer Question</span></button></div></form>';
			 
        ?>
        
        </div>

</body>
</html>



