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
      <li><a href="ar.php">Home</a></li>
      <li><a href="">Profil</a></li>
      <li><a href="choixd.php">QCM</a></li>
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

require_once('Connexionbdd.php');

try{


if(isset($_POST['reponse'])and trim($_POST['reponse']!=' ')){
	print_r($_POST);
	echo 'Vos réponses : </br></br>';
	$maquestion;$plus=0;$moins=0;
	foreach($_POST['reponse'] as $c=>$v){

	
	//////////
	$questio=$bdd->prepare('Select * from public.question natural join public.reponse where id_reponse=:idrep');//pour chaque question
	$questio->bindValue(':idrep',$v);
	$questio->execute();
	while($lo=$questio->fetch(PDO :: FETCH_ASSOC)){
	echo ' '.$lo['id_question'].'</br>';
	//$tb[]=[$lo['id_question']]=>$v;   --> a faire: associer les reponses donnees aux questions pour eviter les doublons de reponses.
	}
	//////////
	$question=$bdd->prepare('Select * from public.question natural join public.reponse where id_reponse=:idrep');//pour chaque id question
	$question->bindValue(':idrep',$v);
	$question->execute();
	while($l=$question->fetch(PDO :: FETCH_ASSOC)){
		echo ' '.$l['question'].'</br>';
		$maquestion=$l['question'];
		echo 'Vous avez répondu : ';//affichage question
		echo ' '.$l['reponse'].'</br>';
		
		if ($l['correct']){
			echo 'Réponse juste</br></br>';
			$plus++;
		}else{
			echo 'Réponse fausse : </br>';
			$moins++;
			echo 'La réponse juste était :' ;
			$rep=$bdd->prepare('Select * from public.question natural join public.reponse where correct=TRUE and question=:mq');
			$rep->bindValue(':mq',$maquestion);
			$rep->execute();
	while($l=$rep->fetch(PDO :: FETCH_ASSOC)){
		echo' '.$l['reponse'];
	}
		} 
	
		echo'</br></br>';
	}
	
}

echo 'plus'.$plus;
echo'moins'.$moins;
$score=($plus-$moins);
echo ' Score : '.$score;


}
}catch(PDOException $e){
	die('<p>Votre requête est erronée.</p>');
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