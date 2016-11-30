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
      <li><a href="aq.php">Home</a></li>
      <li><a href="Profil.php">Profil</a></li>
      <li><a href="#">QCM</a></li>
      <li><a href="a.php">Déconnexion</a></li>
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
	//$req=$bdd->prepare('INSERT INTO question (question) VALUES ($_POST['q']');
	//$req->execute();
	echo 'Réponses : <br /><br />';

	foreach($_POST['Rep']as $Rep)
	{
		echo '-'.$Rep.'<br />';
	}

	echo '<br />Question à '.$_POST['points'].' points.';
?>
</p>
    <!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quia qui, velit enim? Accusamus quasi, voluptatum minus voluptatem numquam inventore dolore nam odit quisquam! Voluptatum illum possimus, non! Magnam, quo officia.Lorem ipsum dolor sit amet,
      consectetur adipisicing elit. Recusandae quas, deleniti natus fugit quidem dignissimos, laboriosam eaque debitis. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dicta delectus perspiciatis libero officia harum hic enim? Unde magni, libero
      nemo ipsam, culpa saepe eos at officia, voluptatum, velit earum similique.</p> -->

  </div>

</div>

<!-- END ABOUT -->

<!-- FOOTER -->
  
  <footer>
    <p>&copy; DUT Informatique. All Rights Reserved.<span class="year">2016</span></p>
  </footer>

		
		
		
	</body>
</html>




