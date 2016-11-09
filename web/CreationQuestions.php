<?php

echo "
	<form action='CreationQuestions.php' method=post>
	<p>Combien de réponses voulez-vous pour votre question ?</p>
	<input type='text' name='n' size=1/><br/>
	<input type='submit' value='Ajouter les réponses'/>
	</form>
";

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
			echo "
				<input type='text' placeholder='Réponse' name='Rep[]'/><br/>
			";
		}
		echo"<input type='submit' value='Sauvegarder et envoyer les réponses'/>
		</form>";
	}

?>
