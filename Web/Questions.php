<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
		 <link rel="stylesheet" href="choixc.css" />
        <title></title>
    </head>
    <body>

		<a name="home"></a>
<div id="desk-nav">
  <nav>
    <ul>
      <li><a href="AccueilQ.php">Home</a></li>
      <li><a href="Profil.php">Profil</a></li>
      <li><a href="#">QCM</a></li>
      <li><a href="Index.php">Déconnexion</a></li>
    </ul>
  </nav>
</div>


<header class="parallax-window" data-parallax="scroll">

  <div id="content-container">

    <h2 id="desk-hero"> Commencer à créer votre QCM</h2>
     <div id="menu-front">
		 <ul>
			 <li><a href="CreationQuestions.php?idd=$_GET['id']">Créer une question</a></li>
			 <li><a href="Importer.php">Importer une question</a></li>
		 </ul>
    </div>
  </div>

</header>

<!-- END LANDING PAGE --> 



<!-- About -->



<div id="about-text">

  <h2>Question</h2>

  <div id="aboutLayout">

    <p>
<?php
session_start();
	require_once('Connexionbdd.php');
echo var_dump($_POST);
if (isset($_POST['q']))
{
	echo 'Question : '.$_POST['q'].'<br /><br />';

	//inserer question
	$req=$bdd->prepare('INSERT INTO question (question,valeur) VALUES (:q,:v)');
	$req->bindValue(':q',$_POST['q']);
	$req->bindValue(':v',$_POST['points']);
	$req->execute();

	echo 'Réponses : <br /><br />';
	$tab = array_combine($_POST['Rep'], $_POST['select']);
	
	
	//recuperer id question pour l'inserer dasn reponse
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
	
	echo '<br />Question à '.$_POST['points'].' points.';
	
	/////// C touche pas à ça, c'est la partie pour afficher : si tu veux tu peux essayer de recuperer l' id du qcm courant, vois avec N.
	/*
 	$req=$bdd->prepare("SELECT * FROM qcm natural join qcm_question natural join question where id_qcm=:idqcm");
	$req->bindValue(':idqcm',$_POST['id']);//
	$req->execute();
	while($ligne=$req->fetch(PDO::FETCH_ASSOC)){
	echo 'Question : '.htmlspecialchars($ligne['question'],ENT_QUOTES).'</br>';
	
	
	
	$req2=$bdd->prepare("SELECT * FROM reponse  "); // natural join question natural join qcm_question natural join qcm where id_qcm=:idqcm and where id_question=:numeroquest
	//$req2->bindValue(':idqcm',$_POST['id']);
	//$req2->bindValue(':numeroquest',$ligne['id_question']);
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
		*/
	///////
	
	
	
}

	if(isset($_POST['id']))
	{
		if(isset($_POST['dom']))
		{
			echo 'Domaine du qcm: '.$_POST['dom'];
		}
		if (isset($_POST['sdom']))
		{
			echo 'Sous_domaine du qcm:'.$_POST['sdom'];
		}
		echo 'id du qcm: '.$_POST['id'];
	}
	
	
	

?>
</p>


  </div>

</div>

<!-- END ABOUT -->

<!-- FOOTER -->

  <footer>
    <p>&copy; DUT Informatique. All Rights Reserved.<span class="year">2016</span></p>
  </footer>

</body>
</html>



