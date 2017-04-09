<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
		 <link rel="stylesheet" href="CreationQuestions.css" />
        <link rel="stylesheet" href="CreerDomaine.css" />
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,600' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
        <link href="https://fonts.googleapis.com/css?family=PT+Sans+Narrow" rel="stylesheet">
        <title>Créer Question</title>
    </head>
    <body>
		

<!-- END NAVIGATION -->

 
<?php
require_once("../Autres/Connexionbdd.php");

	if (!isset($_POST['n'])) //si le nombre de réponses n'est pas spécifié on affiche ce formulaire
	{
			?>
		
  <div class="container">
    <div class="wrap">
      
			<form class="form-wrapper" action="CreationQuestions.php" method="post">
			<fieldset class="section is-active">
		<?php	
		echo'	<input type="hidden" name="idqcm" value="'.$_POST['idqcm'].'"/>';
		 ?>
		
			<p>Nombre de réponses : </p>
			<input type="text" name="n"/> 
			<input type="submit" class="button" value="Ajouter les réponses"/>
			</fieldset>
		</form>
    </div>
  </div>
		<?php
	}

	elseif (isset($_POST['n'])) // si le nombre de réponses est spécifié
	{
		if ($_POST['n'] < 2)// si le nombre de réponses est inférieur à 2 on affiche à nouveau le formulaire précédent
		{
				?>
		
  <div class="container">
    <div class="wrap">
		
			<form class="form-wrapper" action="CreationQuestions.php" method=post>
			<?php echo '<input type="hidden" name="idqcm" value="'.$_POST['idqcm'].'"/>';?>
			<fieldset class="section is-active">
			<p>Minimum 2 !  </p>
			<input type="text" name="n"/> 
			<input type="submit" class="button" value="Ajouter les réponses"/>
			</fieldset>
		</form>
    </div>
  </div>
		<?php
			
		}
		else // sinon on affiche le nouveau formulaire pour entrer les informations de la question
		{
			echo '<form action="Questions.php" method=post>
			
			<div class="contain">
  			<header>
    		<h1>Créez votre question !</h1>';
			
			if(isset($_POST['id']))
                        {
                                if(isset($_POST['dom'])) // si le domaine est spécifié
                                {
                                        echo '<h2>Domaine du qcm : '.$_POST['dom'].'</h2>'; // on affiche le domaine
                                }
                                if (isset($_POST['sdom'])) // si le sous domaine est spécifié
                                {
                                        echo ' </br><h2>Sous_domaine du qcm : '.$_POST['sdom'].'</h2></br>'; 
										// on affiche le sous domaine
				}
                                echo ' <h2>id du qcm : '.$_POST['id'].'</h2>'; // on affiche l'Id du QCM
                        }

			echo '</header><div class="contact">
			<input class="ques" placeholder="Intitulé de la question" type="text" name="q"/>
			<input class="last" placeholder="Temps" type="text" name="tps"/>
			<input class="last" placeholder="Point(s)" type="text" name="points"/></div>';
				
			for ($i=1;$i<=$_POST['n'];$i++) // boucle qui permet d'afficher les champs de réponses avec leur liste en fonction du nombre entré dans le tout premier formulaire
			{
				
				
			?>
				<div class='name'>
					<?php
				
				echo '<input placeholder="Réponse" class="first" type="text" name="Rep[]"/>
					<select name="select[]">
										<option class="green" value="Vrai">Correct</option>
										<option class="red" value="Faux" selected>Incorrect</option>
									</select><br/></div>';
				
			}
						
			echo'<input type="hidden" name="id" value="'.$_POST['idqcm'].'"/>';
			echo "<div class='message'>
    		<textarea placeholder='Rajouter un petit commentaire ici. Cela sera affiché sous votre question. '></textarea>
  			</div>";
			echo  '<input type="hidden" name="creaquestion" value="creaquestion"/>';
			
			echo '<footer><button><input type="submit" value="Sauvegarder"/></button></footer>';

			echo '</div></form>';
		}   
	}
?>
        </div>	
</body>
</html>
