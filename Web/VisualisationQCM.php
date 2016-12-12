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
      <li><a href="AccueilQ.php">Home</a></li>
      <li><a href="Profil.php">Profil</a></li>
      <li><a href="ChoixQC.php">QCM</a></li>
      <li><a href="Index.php">Déconnexion</a></li>
    </ul>
  </nav>
</div>

<!-- END NAVIGATION -->

   

<!-- About  -->

<div id="about-me">


<h2>Visualisation de votre QCM</h2>
  


<?php
session_start();
require_once("Connexionbdd.php");
 if (isset($_POST['q'])){
/*
$affichageqcm=$bdd->prepare('select * from qcm natural join qcm_question natural join question natural join reponse natural join questionneur where id_qcm=:iq and nom_questionneur=:nr');
$affichageqcm->bindValue(':iq',2);//$_POST['iq']
$affichageqcm->bindValue(':nr',$_SESSION['user']);
$affichageqcm->execute();
while($ligne=$affichageqcm->fetch(PDO::FETCH_ASSOC)){
	if($ligne['correct']){
	echo '<div id=correct>Question : '.$ligne['question'].'</br>Réponse : '.$ligne['reponse'].'</br></div>';
	}else{
	echo '<div id=false>Question : '.$ligne['question'].'</br>Réponse : '.$ligne['reponse'].'</br></div>';
	}
}*/
 
 
 	$req=$bdd->prepare("SELECT * FROM qcm natural join qcm_question natural join question where id_qcm=:idqcm");
	$req->bindValue(':idqcm',3);//$_POST['iq']
	$req->execute();
	while($ligne=$req->fetch(PDO::FETCH_ASSOC)){
	echo 'Question : '.htmlspecialchars($ligne['question'],ENT_QUOTES).'</br>';
	
	//echo "<form action='VisualisationQCM.php' method='GET'><input type='submit' value='Reponses' name='voirreponses'/></form>";
	
	//if(isset($_GET['voirreponses'])){
	
	$req2=$bdd->prepare("SELECT * FROM reponse natural join question natural join qcm_question natural join qcm where id_qcm=:idqcm and id_question=:numeroquest"); 
	$req2->bindValue(':idqcm',3);//$_POST['iq']
	$req2->bindValue(':numeroquest',$ligne['id_question']);
	$req2->execute();
	echo'</br>';
	while($l=$req2->fetch(PDO::FETCH_ASSOC)){
			if($l['correct']){
	echo '<div id=correct>Réponse : '.$l['reponse'].'</br></div>';
	}else{
	echo '<div id=false>Réponse : '.$l['reponse'].'</br></div>';
	}
		}
	//}
		echo'</br>';
		}
 
 
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
