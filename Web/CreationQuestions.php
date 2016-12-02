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


<h2>Creation de questions</h2>
  


<?php

require_once("Connexionbdd.php");

echo "
	<form action='CreationQuestions.php' method=post>
	<p>Combien de réponses voulez-vous pour votre question ?</p>
	<input type='text' name='n' size=1/><br/>
	<input type='submit' value='Ajouter les réponses'/>
	</form>
";

	if (isset($_POST['n']))
	{
		if ($_POST['n'] < 2)
		{
			echo "Il doit y avoir deux réponses minimum à votre question<br />";
		}
		else
		{
			echo"<form action='Questions.php' method=post>
				<input type='text' placeholder='Question' name='q'/><br/><br/>";
			for ($i=1;$i<=$_POST['n'];$i++)
			{
			echo "<input type='text' placeholder='Réponse' name='Rep[]'/><input type='checkbox' name='Vrai'/><br/>";
		}
		
		echo "<br/><input type='text' placeholder='Points' name='points' style='width:50px;'/><br /><br />";
		echo"<input type='submit' value='Sauvegarder et envoyer les réponses'/>";
		//$req=$bdd->prepare('INSERT INTO public.question (question) VALUES ($_POST['q']');
		//$req->execute();

		echo "</form>";
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