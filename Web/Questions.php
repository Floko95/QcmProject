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
			 <li><a href="CreationQuestions.php">Créer une question</a></li>
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

	require_once('Connexionbdd.php');

if (isset($_POST['q']))
{
	echo 'Question : '.$_POST['q'].'<br /><br />';

	/*$req=$bdd->prepare('INSERT INTO public.question (question,valeur) VALUES (:q,:v)');
	$req->bindValue(':q',$_POST['q']);
	$req->bindValue(':v',$_POST['points']);
	$req->execute();*/

	echo 'Réponses : <br /><br />';
	$tab = array_combine($_POST['Rep'], $_POST['select']);


	//$req2 = $bdd->prepare('INSERT INTO public.reponse(question,correct) VALUES(:r,:c)');
	foreach($tab as $Rep => $VF)
	{
		if ($VF == 'Vrai')
		{
			echo $Rep.' -> Réponse Correcte<br/>';
		}
		elseif($VF == 'Faux')
		{
			echo $Rep.' -> Réponse Incorrecte<br/>';
		}
	}

	echo '<br />Question à '.$_POST['points'].' points.';
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



