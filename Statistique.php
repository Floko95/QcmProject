
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
		 <link rel="stylesheet" href="Resultat.css" />
        <link href="https://fonts.googleapis.com/css?family=PT+Sans+Narrow" rel="stylesheet">
           <link href="https://fonts.googleapis.com/css?family=Fjalla+One" rel="stylesheet">
         <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
        
        <title></title>
    </head>
    <body> 


        
	<div id="desk-nav">
		<nav>
			<ul>
				<li><a href="AccueilR.php">Home</a></li>
				<li><a href="ProfilR.php">Profil</a></li>
				<li><a href="ChoixRD.php">QCM</a></li>
				<li><a href="Index.php">Déconnexion</a></li>
			</ul>
		</nav>
	</div>
        
        
        
        
        
<?php require_once('Connexionbdd.php'); ?>

<div class="container">
    <h1>Résultat</h1>
    
<?php 
include('EviteMessageFormulaire.php');

if(isset($_POST['qcm'])and trim($_POST['qcm'])){ //si on arrive de la page executer
	try{										 

		require_once('Connexionbdd.php');		
		$date=time().'</br>';					//date actuelle (correspond a la fin du QCM)
		$tempspasse=$date-$_POST['temps'];		//calcul du temps passe sur le QCM
		$score=0;$faux=0;$vrai=0;				//initialise score, +variables utiles par la suite
		
		if(isset($_POST['reponse'])and trim($_POST['reponse']!=' ')){				//si des réponses ont été cochées lors du QCM
			if(isset($_POST['checkboxes'])and trim($_POST['checkboxes']!=' ')){		
				echo '<h2>Vos réponses au QCM n° '.$_POST['qcm'].' : </h2> ';		//récupère l'id QCM
				
				$question=$bdd->prepare('Select * from qcm natural join qcm_question natural join question where id_qcm=:idqcm');  //pour chaque question du QCM effectué
				$question->bindValue(':idqcm',$_POST['qcm']);						//indique l'id du QCM dans la requete
				$question->execute();												//pour executer une requete
				while($quest=$question->fetch(PDO :: FETCH_ASSOC)){					//pour chaque question du qcm 
					
					echo "<div class=\"form-group\"><label class=\"control-label\" for=\"select\">";
					echo 'Question : '.$quest['question'];							//affichage question
					echo "</label><i class=\"bar\"></i></div> ";
					$idquestionn=$quest['id_question'];								//recupère l'id de la question pour les requetes à venir
					$reponsetrue=0;													//pour connaitre le nombre de réponses vraies de la question
					
					$reponse=$bdd->prepare('Select * from reponse INNER JOIN qcm_question ON reponse.id_question = qcm_question.id_question 
					WHERE qcm_question.id_question=:idquestion and qcm_question.id_qcm=:idqcm;');//pour chaque réponse de la question
					$reponse->bindValue(':idquestion',$idquestionn);				//pour chaque réponse à la question		
					$reponse->bindValue(':idqcm',$_POST['qcm']);
					$reponse->execute();
					while($rep=$reponse->fetch(PDO::FETCH_ASSOC)){
						
						if($rep['correct']){										//si la réponse est correcte, on incrémente reponsetrue.
							$reponsetrue+=1;
						}
						
						foreach($_POST['reponse'] as $c=>$v){ 						//pour chaque reponse cochee par le répondeur
							
							if($rep['id_reponse']==$v){ 							//si l'id de la reponse cochée correspond a l'id de la reponse de la requete
								echo'<i class="helper"></i><i class="helper"></i></br> Votre réponse: '.htmlspecialchars($rep['reponse'],ENT_QUOTES); //affichage de la réponse 
								
								if ($rep['correct']){ 								//si la reponse est correcte
									echo'<i class="helper"><div class="green">Réponse juste</i></div> ';    //affiche 'reponse juste'
									$vrai+=1; 										                        //on incrémente le compteur de bonnes réponses cochées
								}else{												                        //sinon, si la reponse est fausse
									echo'<i class="helper"><div class="red">Réponse fausse</i></div> </br>';//affichage 'réponse fausse'
									echo 'La réponse juste était :' ;				
									
									$repjuste=$bdd->prepare('Select reponse from reponse INNER JOIN question ON reponse.id_question = question.id_question 
									INNER JOIN public.qcm_question ON question.id_question = qcm_question.id_question 
									WHERE qcm_question.id_question = :mq and qcm_question.id_qcm = :idqcm and reponse.correct=TRUE');//trouve la réponse juste
									$repjuste->bindValue(':mq',$idquestionn);
									$repjuste->bindValue(':idqcm',$_POST['qcm']);
									$repjuste->execute();
									while($l=$repjuste->fetch(PDO :: FETCH_ASSOC)){
										echo' '.htmlspecialchars($l['reponse'],ENT_QUOTES);                    //affichage de la bonne réponse en correction
									}
									$faux=1; 																   //on incrémente le compteur de réponses fausses données
								}
							}
						}
					
					}
					
					if($faux==0 && $vrai==$reponsetrue){	                                    //si pas de reponses fausses et toutes les reponses vraies
						
						$point=$bdd->prepare('Select valeur from question where id_question=:mq');
						$point->bindValue(':mq',$idquestionn);
						$point->execute();
						while($ligne=$point->fetch(PDO::FETCH_ASSOC)){
							$score+=$ligne['valeur'];											//score incrémenté de la valeur attribuée à la question
							echo '</br>Score : + '.$ligne['valeur'].'</br>';					//affichage de l'incrémentation du score
						}
					
					}else if($faux==0 && $vrai!=$reponsetrue && $vrai!=0){                     //si pas de reponses fausses mais pas toutes les reponses vraies
						echo'<i class="helper"><div class="red">...mais incomplète</i></div> </br>'; //affichage de l'état incomplet de la réponse
						echo 'La réponse juste était :' ;											 //correction
						
						$repjuste=$bdd->prepare('Select reponse from reponse INNER JOIN question ON reponse.id_question = question.id_question INNER JOIN public.qcm_question ON question.id_question = qcm_question.id_question WHERE qcm_question.id_question = :mq and qcm_question.id_qcm = :idqcm and reponse.correct=TRUE');//trouve la réponse juste
						$repjuste->bindValue(':mq',$idquestionn);
                        $repjuste->bindValue(':idqcm',$_POST['qcm']);
						$repjuste->execute();
						while($l=$repjuste->fetch(PDO :: FETCH_ASSOC)){
							echo' '.htmlspecialchars($l['reponse'],ENT_QUOTES);						//affichage réponse juste
						}
					
					}else if($vrai==0 && $faux==0){
						echo'</br><i class="helper"><div class="red">Vous n\'avez pas répondu à cette question.</i></div> </br>';	//si aucune réponse à la question

					}
					
					$faux=0;				//remise a false des variables pour la prochaine question
					$vrai=0;
					$reponsetrue=0;
				}
				echo'</br></br></br>';
				$time=0;					
				
				$tempsdepasse=$bdd->prepare('Select temps FROM public.qcm_question natural join public.question where id_qcm=:idqcm');
				$tempsdepasse->bindValue(':idqcm',$_POST['qcm']);
				$tempsdepasse->execute();
				$t=0;
				while($l=$tempsdepasse->fetch(PDO::FETCH_ASSOC)){
					$t+=$l['temps'];
				}
				
				if($tempspasse>$t){
					$score-=5;
					echo 'Vous avez dépassé le temps (score - 5) : '.$tempspasse.' secondes. </br>';
				}else{
					echo 'Temps passé : '.$tempspasse.' secondes.</br>';
				}
				
				if($score<0){
					$score=0;
				}
				
				$tems=$bdd->prepare('select note_total from qcm where id_qcm=:s');
				$tems->bindValue(':s',$_POST['qcm']);
				$tems->execute();
				while($lu=$tems->fetch(PDO::FETCH_ASSOC)){
					$score=($score*20)/$lu['note_total'];
				}

				echo ' Score : '.$score.'</br></br>';
			}
		
		}else{
			echo "Votre refus de répondre au QCM entraine l'ajout d'un 0 à votre moyenne et le mépris du correcteur.";
		}
		$tim=0;
		
		$ins=$bdd->prepare('select id_repondeur from repondeur where nom_repondeur=:n');
		$ins->bindValue(':n',$_SESSION['user']);
		$ins->execute();
		while($lu=$ins->fetch(PDO::FETCH_ASSOC)){
			$tim=$lu['id_repondeur'];
		}
		
		$dom=0;$s_dom=0;
		
		$d_sd=$bdd->prepare('SELECT distinct domaine,sous_domaine FROM qcm WHERE id_qcm = :id_qcm');
		$d_sd->bindValue(':id_qcm',$_POST['qcm']);
		$d_sd->execute();
		while($l=$d_sd->fetch(PDO::FETCH_ASSOC)){
			$dom=$l['domaine'];
			$s_dom=$l['sous_domaine'];
		}

		$d='seconds';
		
		$inserer=$bdd->prepare('insert into public.recap_repondeur (id_repondeur,id_qcm,domaine,sous_domaine,date_qcm_fait,note_qcm,temps_qcm) values(:id_rep,:id_qcm,:dom,:s_dom,date_trunc(:mot,now()),:note,:tempspasse)');
		$inserer->bindValue(':id_rep',$tim);
		$inserer->bindValue(':id_qcm',$_POST['qcm']);
		$inserer->bindValue(':dom',$dom);
		$inserer->bindValue(':s_dom',$s_dom);
		$inserer->bindValue(':mot',$d);
		$inserer->bindValue(':note',$score);
		$inserer->bindValue(':tempspasse',$tempspasse);
		$inserer->execute();
	
	
	}catch(PDOException $e){
		die('<p>Votre requête est erronée.</p>'.$e);
	}
	
	echo '<div class="button-container">
		<a href="ProfilR.php"><button class="button" type="submit"><span>Profil</span></button></a>
		<a href="ChoixRD.php"><button class="button" type="submit"><span>Refaire un QCM</span></button></a></div>';
    echo "</form>";

}else{
	echo '<h3>Tous vos résultats se trouvent sur votre profil.</h3>';
	echo '<div class="button-container">
		<a href="ProfilR.php"><button class="button" type="submit"><span>Profil</span></button></a></div>';
}


?>
  
</div>
</body>
</html>
            
            
            