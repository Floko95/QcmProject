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
				<li><a href="../Index.php">Déconnexion</a></li>
			</ul>
		</nav>
	</div>
        
        
        
        
        
    <div class="container">
    <h1>Liste Question</h1>
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="Questions.js"></script>
<?php
	session_start();					//pour utiliser les $_session
	require_once('../Autres/Connexionbdd.php');

	
	if(isset($_POST['modif'])){				//si le questionneur a choisi de modifier un qcm déjà créé
	
		$req=$bdd->prepare("UPDATE qcm SET fini = false WHERE id_qcm=:id");
		$req->bindValue(':id',$_POST['id']);
		$req->execute();
		echo '<h2>Reprise de la création du QCM numéro '.$_POST['id'].'</h2>';
		$_SESSION['sup']=1;
	}
	
	if(isset($_POST['id'])){				//si le questionneur vient de choixQC, donc du choix domaine/sous domaine
		
		if(isset($_POST['dom'])){			//si le domaine est renseigné
			echo '<h2>Domaine du qcm: '.$_POST['dom'].'</h2></br>'; //affichage du domaine
		}
		if (isset($_POST['sdom'])){			//si le sous domaine est renseigné
			echo '<h2>Sous_domaine du qcm:'.$_POST['sdom'].'</h2></br>'; //affichage du domaine
		}
		
	}
		echo '<h2>QCM n° '.$_POST['id'].'</h2>';  //affichage de l'id du qcm
		$monidqcm=$_POST['id'];
		
	
	$req2=$bdd->prepare("SELECT description from qcm where id_qcm = :id"); //affichage des réponses 
	$req2->bindValue(':id',$monidqcm);
	$req2->execute();
	$l=$req2->fetch(PDO::FETCH_ASSOC);
 echo '<h2>Entre une description de votre QCM (facultatif)</h2>
        <textarea rows="5" cols="73" maxlength="150" id="desc"  placeholder=" Ajouter description pour ce qcm.">'.$l['description'].'</textarea>';

	


	if (isset($_POST['q'])){	//si on arrive soit de création question, soit d'importer question
		
		if(isset($_POST['creaquestion'])){		//si on arrive de creation question
	
			if(isset($_POST['exp']) and trim($_POST['exp'])!=''){ 	//si une explication a été donnée à la création de la question
				
				$req=$bdd->prepare('INSERT INTO question (question,valeur,temps,explication) VALUES (:q,:v,:t,:e)');	//insertion de la question dans la base
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

			
			$idquestion=$bdd->prepare('select id_question from question where question=:q');	//récupération de l'id de la question créée dans $idq
			$idquestion->bindValue(':q',$_POST['q']);
			$idquestion->execute();
			while($ligne=$idquestion->fetch(PDO::FETCH_ASSOC)){
				$idq=$ligne['id_question'];
			}

			$note_total=$bdd->prepare("SELECT valeur FROM question where id_question=:q");		//récupération du nombre de points de la question
			$note_total->bindValue(':q',$idq);
			$note_total->execute();
			while($ligne=$note_total->fetch(PDO::FETCH_ASSOC)){
				$note=$ligne['valeur'];
			}
			
			$up=$bdd->prepare("update qcm set note_total=note_total+:n where id_qcm=:mq");		//incrémentation du score total du qcm avec la valeur de $note
			$up->bindValue(':n',$note);
			$up->bindValue(':mq',$monidqcm);
			$up->execute();
			
			
			foreach($_POST['select'] as $c => $v){				//crée un tableau qui contient les valeurs 
				$select[]=$v;
			}
	
	
			foreach($_POST['Rep'] as $cle => $val){		//pour chaque réponse créée
				
				
				if($select[$cle]=='Vrai'){			//si elle est vraie
					
					$req2 = $bdd->prepare('INSERT INTO Reponse(id_question,reponse,correct) VALUES(:q,:rep,true)');  //insertion avec correct=true
					$req2->bindValue(':q',$idq);
					$req2->bindValue(':rep',$val);
					$req2->execute();
					
				}elseif($select[$cle]=='Faux'){		//si elle est fausse
					
					
					$req2 = $bdd->prepare('INSERT INTO Reponse(id_question,reponse,correct) VALUES(:q,:rep,false)');  //insertion avec correct=false
					$req2->bindValue(':q',$idq);
					$req2->bindValue(':rep',$val);
					$req2->execute();
				}
			}
	
	
			$req4 = $bdd->prepare('INSERT INTO qcm_question(id_qcm,id_question) VALUES(:idqcm,:idquestion)'); //on relie la question au qcm 
			$req4->bindValue(':idqcm',$monidqcm);
			$req4->bindValue(':idquestion',$idq);
			$req4->execute();
	
		}else{ //si on arrive d'importer

	
			$note;
			$note_total=$bdd->prepare("SELECT valeur FROM question where id_question=:q");		//récupération du nombre de points de la question
			$note_total->bindValue(':q',$_POST['q']);
			$note_total->execute();
			while($ligne=$note_total->fetch(PDO::FETCH_ASSOC)){
				$note=$ligne['valeur'];
			}
	
	 
			$up=$bdd->prepare("update qcm set note_total=note_total+:n where id_qcm=:q");		//incrémentation du score total du qcm avec la valeur de $note
			$up->bindValue(':n',$note);
			$up->bindValue(':q',$monidqcm);
			$up->execute();

			
			$req4 = $bdd->prepare('INSERT INTO qcm_question(id_qcm,id_question) VALUES(:idqcm,:idquestion)');	//on relie la question au qcm 
			$req4->bindValue(':idqcm',$monidqcm);
			$req4->bindValue(':idquestion',$_POST['q']);
			$req4->execute();
		
		}
	
		echo ' </br>';
		
		
	}	if(isset($monidqcm) and !isset($_SESSION['sup'])){	
		
			$req=$bdd->prepare("SELECT * FROM qcm natural join qcm_question natural join question where id_qcm=:idqcm");	//affichage de la question
			$req->bindValue(':idqcm',$monidqcm);
			$req->execute();
			while($ligne=$req->fetch(PDO::FETCH_ASSOC)){
				
				echo "<div class=\"form-group\"><label class=\"control-label\" for=\"select\">";
				echo  htmlspecialchars($ligne['question'],ENT_QUOTES).'</br>';
				echo  'Points : '.htmlspecialchars($ligne['valeur'],ENT_QUOTES).'  Temps : '.htmlspecialchars($ligne['temps'],ENT_QUOTES).' sec.';
				
				if($ligne['explication']!=null){
					echo  '  Explication : '.htmlspecialchars($ligne['explication'],ENT_QUOTES).'</br></br>';
				}
				
				echo "</label><i class=\"bar\"></i></div> ";
	
	
				$req2=$bdd->prepare("SELECT * FROM reponse natural join question natural join qcm_question natural join qcm where id_qcm=:idqcm and id_question=:numeroquest"); //affichage des réponses 
				$req2->bindValue(':idqcm',$monidqcm);
				$req2->bindValue(':numeroquest',$ligne['id_question']);
				$req2->execute();
				echo'</br></br>';
				while($l=$req2->fetch(PDO::FETCH_ASSOC)){
					if($l['correct']){																//affichage en vert si la réponse est juste
						echo '<i class="helper"><div class="green"> '.htmlspecialchars($l['reponse'],ENT_QUOTES).' </i></div>';
					}else{																			//affichage en rouge si la réponse est fausse
						echo '<i class="helper"><div class="red">'.htmlspecialchars($l['reponse'],ENT_QUOTES).' </i></div>';
					}  
				}

				echo'</br>';
			}	

		}
		if( isset($_SESSION['sup']) and $_SESSION['sup']==1){	
		
			$req=$bdd->prepare("SELECT * FROM qcm natural join qcm_question natural join question where id_qcm=:idqcm");	//affichage de la question
			$req->bindValue(':idqcm',$monidqcm);
			$req->execute();
			while($ligne=$req->fetch(PDO::FETCH_ASSOC)){
				
				
				echo "<div class=\"form-group\"><label class=\"control-label\" for=\"select\">";
				echo  htmlspecialchars($ligne['question'],ENT_QUOTES).'</br>';
				echo  'Points : '.htmlspecialchars($ligne['valeur'],ENT_QUOTES).'  Temps : '.htmlspecialchars($ligne['temps'],ENT_QUOTES).' sec.';
				
				if($ligne['explication']!=null){
					echo  '  Explication : '.htmlspecialchars($ligne['explication'],ENT_QUOTES).'</br></br>';
				}
				
				echo "</label><i class=\"bar\"></i></div> ";
	
	
				$req2=$bdd->prepare("SELECT * FROM reponse natural join question natural join qcm_question natural join qcm where id_qcm=:idqcm and id_question=:numeroquest"); //affichage des réponses 
				$req2->bindValue(':idqcm',$monidqcm);
				$req2->bindValue(':numeroquest',$ligne['id_question']);
				$req2->execute();
				echo'</br></br>';
				while($l=$req2->fetch(PDO::FETCH_ASSOC)){
					if($l['correct']){																//affichage en vert si la réponse est juste
						echo '<i class="helper"><div class="green"> '.htmlspecialchars($l['reponse'],ENT_QUOTES).' </i></div>';
					}else{																			//affichage en rouge si la réponse est fausse
						echo '<i class="helper"><div class="red">'.htmlspecialchars($l['reponse'],ENT_QUOTES).' </i></div>';
					}  
				}

				echo'</br>';
				
				echo '<form action="SupprimerQuestion.php" method="post">
		<input type="hidden" name="idqcm" value="'.$_POST['id'].'"/>
		<input type="hidden" name="qsup" value="'.$ligne['question'].'"/>
        <input type="submit" name="sup" class="supp" value="Supprimer"/></form>';
        
				
			}	

		}
            
	echo '<form action="Finaliser.php" method="post">
		<input type="hidden" name="id" value="'.$_POST['id'].'"/>
        <button type="submit" class="button"><span>Valider QCM</span></button></form>';
        
		
    echo' <form action="CreationQuestions.php" method="post">
		<input type="hidden" name="idd" value="'.$_POST['id'].'"/>
		<input type="hidden" name="idqcm" value="'.$monidqcm.'"/>
		<button type="submit" class="button"><span>Créer Question</span></button></form>';
			
			
	echo' <form action="Importer.php" method="post">
		<input type="hidden" name="idd" value="'.$_POST['id'].'"/>
		<input type="hidden" name="idqcm" value="'.$monidqcm.'"/>
		<button type="submit" class="button"><span>Importer Question</span></button></form>';
		
	
  ?>
 </div>

</body>
</html>
