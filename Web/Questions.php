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
	echo 'Question : '.$_POST['q'].'<br /><br />';
	//////////////////////
	$req=$bdd->prepare('INSERT INTO public.question (question,valeur) VALUES (:q,:v)');
	$req->bindValue(':q',$_POST['q']);
	$req->bindValue(':v',$_POST['points']);
	$req->execute();
	/////////////////////
	echo 'Réponses : <br /><br />';

	foreach($_POST['Rep']as $Rep)
	{
		echo '-'.$Rep.'<br />';
	/*//////////////////////
	$req2=$bdd->prepare('INSERT INTO public.reponse(reponse) VALUES (:r)');//:q,,id_question,correct,:c
	//$req2->bindValue(':q',$_POST['q']);
	$req2->bindValue(':r',$Rep);
	//$req2->bindValue(':c',$_POST['q']);
	$req2->execute();
	/////////////////////*/
	}

	echo '<br />Question à '.$_POST['points'].' points.';
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



