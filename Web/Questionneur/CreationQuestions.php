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
      <li><a href="../Autres/Index.php">Déconnexion</a></li>
    </ul>
  </nav>
</div>

<!-- END NAVIGATION -->

   

<!-- About  -->

<div id="about-me">


<h2>Creation de questions</h2>
  


<?php
require_once("../Autres/Connexionbdd.php");

	if (!isset($_POST['n'])) //si le nombre de réponses n'est pas spécifié on affiche ce formulaire
	{
		echo '
			<form action="CreationQuestions.php" method=post>
			<input type="hidden" name="idqcm" value="'.$_POST['idqcm'].'"/>
			Combien de réponses voulez-vous pour votre question ?
			<input type="text" name="n" size=1/><br/> 
			<input type="submit" value="Ajouter les réponses"/>
			</form>
		';
	}

	elseif (isset($_POST['n'])) // si le nombre de réponses est spécifié
	{
		if ($_POST['n'] < 2)// si le nombre de réponses est inférieur à 2 on affiche à nouveau le formulaire précédent
		{
			echo '
				<form action="CreationQuestions.php" method=post>
				<input type="hidden" name="idqcm" value="'.$_POST['idqcm'].'"/>
				Il doit y avoir au moins deux réponses à votre question
				<input type="text" name="n" size=1/><br/>
				<input type="submit" value="Ajouter les réponses"/>
				</form>
			';
		}
		else // sinon on affiche le nouveau formulaire pour entrer les informations de la question
		{
			echo "<form action='Questions.php' method=post>";
			if(isset($_POST['id']))
                        {
                                if(isset($_POST['dom'])) // si le domaine est spécifié
                                {
                                        echo 'Domaine du qcm : '.$_POST['dom']; // on affiche le domaine
                                }
                                if (isset($_POST['sdom'])) // si le sous domaine est spécifié
                                {
                                        echo ' Sous_domaine du qcm : '.$_POST['sdom']; // on affiche le sous domaine
				}
                                echo ' id du qcm : '.$_POST['id']; // on affiche l'Id du QCM
                        }

			echo "Intitulé de la question : <input type='text' name='q'/><br/><br/>";
			for ($i=1;$i<=$_POST['n'];$i++) // boucle qui permet d'afficher les champs de réponses avec leur liste en fonction du nombre entré dans le tout premier formulaire
			{
				echo "Réponse $i <input type='text' name='Rep[]'/><select name='select[]'>
										<option value='Vrai'>Réponse Correcte</option>
										<option value='Faux' selected>Réponse incorrecte</option>
									</select><br/>";
			}
						
			echo'<input type="hidden" name="id" value="'.$_POST['idqcm'].'"/>';
			echo "Temps de Réponse <input type='text' name='tps'/><br/>";
			echo "Informations sur la question<br/>";
			echo "<textarea name='exp' rows='10' cols='50' name='infos'></textarea><br/>";
			echo "Points <input type='text' name='points'/><br /><br />";
			echo  "<input type='hidden' name='creaquestion' value='creaquestion'/>";
			echo"<input type='submit' value='Sauvegarder et envoyer les réponses'/>";

			echo "</form>";
		}
	}


?>
</div>

<!-- END ABOUT  -->




<!-- END FOOTER  -->
	
	</body>
	</html>
