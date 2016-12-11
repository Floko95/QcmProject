<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
		 <link rel="stylesheet" href="test.css" />
        <title></title>
    </head>
    <body>
		

<div id="desk-nav">
  <nav>
    <ul>
      <li><a href="AccueilR.php">Home</a></li>
      <li><a href="ProfilR.php">Profil</a></li>
      <li><a href="ChoixRD.php">QCM</a></li>
      <li><a href="a.php">Déconnexion</a></li>
    </ul>
  </nav>
</div>

<!-- END NAVIGATION -->
<!-- About  -->

<div id="about-me">

<h2>Statistiques</h2>
  <p>Tu as fini...quel est ton score ?</p>

<?php 
session_start();
try{

require_once('Connexionbdd.php');
$date=time().'</br>';
$tempspasse=$date-$_POST['temps'];
$score=0;$faux=0;$vrai=0;
if(isset($_POST['reponse'])and trim($_POST['reponse']!=' ')){
	if(isset($_POST['checkboxes'])and trim($_POST['checkboxes']!=' ')){
		echo 'Vos réponses au QCM n° '.$_POST['qcm'].' : </br>';

		$question=$bdd->prepare('Select * from public.qcm natural join public.qcm_question natural join question where id_qcm=:idqcm');//pour chaque question
		$question->bindValue(':idqcm',$_POST['qcm']);
		$question->execute();
		while($quest=$question->fetch(PDO :: FETCH_ASSOC)){
			echo '</br></br></br>Question : '.$quest['question'].'</br>';		//affichage question
			$idquestionn=$quest['id_question'];
			$reponse=$bdd->prepare('Select * from public.reponse natural join public.qcm_question where id_question=:idquestion');//pour chaque réponse de la question
			$reponse->bindValue(':idquestion',$idquestionn);
			$reponse->execute();
			while($rep=$reponse->fetch(PDO::FETCH_ASSOC)){
				foreach($_POST['reponse'] as $c=>$v){
					if($rep['id_reponse']==$v){
						echo '</br>Vous avez répondu : ';		//affichage réponse donnée
						echo ' '.htmlspecialchars($rep['reponse'],ENT_QUOTES).'</br>';
							if ($rep['correct']){
								echo 'Réponse juste</br>';		//si la réponse est juste
								$vrai+=1;
							}else{
								echo 'Réponse fausse : </br>';	//si la réponse est fausse
								echo 'La réponse juste était :' ;
								$repjuste=$bdd->prepare('Select * from public.question natural join public.reponse where correct=TRUE and id_question=:mq');//trouve la réponse juste
								$repjuste->bindValue(':mq',$idquestionn);
								$repjuste->execute();
								while($l=$repjuste->fetch(PDO :: FETCH_ASSOC)){
									echo' '.htmlspecialchars($l['reponse'],ENT_QUOTES);//affichage réponse juste
								}
								$faux=1;
							}
					}
				}
			}
			if($faux==0 && $vrai==1){
				$point=$bdd->prepare('Select * from question where id_question=:mq');
								$point->bindValue(':mq',$idquestionn);
								$point->execute();
								while($ligne=$point->fetch(PDO::FETCH_ASSOC)){
										$score+=$ligne['valeur'];
										echo 'Score : + '.$ligne['valeur'].'</br>';
								}
			}
			$faux=0;
			$vrai=0;
		}
	echo'</br></br></br>';
	
	$time=0;
	$tempsdepasse=$bdd->prepare('Select * FROM public.qcm_question natural join public.question where id_qcm=:idqcm');
	$tempsdepasse->bindValue(':idqcm',$_POST['qcm']);
	$tempsdepasse->execute();
	$t=0;
	while($l=$tempsdepasse->fetch(PDO::FETCH_ASSOC)){
		$t+=$l['temps'];
	}
	if($tempspasse>$t){
		$score-=1;
		echo 'Vous avez dépassé le temps (score - 1) : '.$tempspasse.' secondes. </br>';
	}
	if($score<0){
		$score=0;
	}if ($tempspasse<=$t){
	echo 'Temps passé : '.$tempspasse.' secondes.</br>';
	}
	echo ' Score : '.$score.'</br></br>';
	}
}

$tim=0;
$ins=$bdd->prepare('select * from repondeur where nom_repondeur=:n');
$ins->bindValue(':n',$_SESSION['user']);
$ins->execute();
while($lu=$ins->fetch(PDO::FETCH_ASSOC)){
		$tim=$lu['id_repondeur'];
		}


$dom=0;$s_dom=0;
$d_sd=$bdd->prepare('SELECT distinct domaine,sous_domaine FROM qcm_question natural join qcm WHERE id_qcm = :id_qcm');
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
	
?>
</div>

<!-- END ABOUT  -->


<!-- Footer -->


<div id="footer-media">

  <a target="_blank" href="https://www.instagram.com/"><img src="https://raw.githubusercontent.com/atloomer/personal-site-revamp/gh-pages/img/insta-icon.png" alt="instagram icon" /></a>
  
  <a target="_blank" href="https://www.facebook.com/"><img src="https://raw.githubusercontent.com/atloomer/personal-site-revamp/gh-pages/img/facebook-icon.png" alt="facebook icon" /></a>

</div>

<footer>

  <p>&copy;  DUT Informatique  <span class="year">2016</span>. All Rights Reserved. </p>
  
</footer>

<!-- END FOOTER  -->
	
	</body>
	</html>