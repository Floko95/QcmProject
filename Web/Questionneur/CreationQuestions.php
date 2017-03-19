<!DOCTYPE html>
<html>
	<head>
        	<meta charset="utf-8" />
		<link rel="stylesheet" href="CreationQuestions.css" />
        	<link rel="stylesheet" href="CreerDomaine.css" />
        	<link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,600' rel='stylesheet' type='text/css'>
        	<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
        	<link href="https://fonts.googleapis.com/css?family=PT+Sans+Narrow" rel="stylesheet">
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        	<title>Créer Question</title>
	</head>
	<body>

<!-- END NAVIGATION -->

<?php require_once("../Autres/Connexionbdd.php"); ?>
	<form action="Questions.php" method=post>
		<div class="contain">
			<header>
				<h1>Créez votre question !</h1>
<?php
				if(isset($_POST['id']))
				{
					if(isset($_POST['dom'])) // si domaine spécifié
					{
						echo'<h2>Domaine du qcm : '.$_POST['dom'].'</h2>'; //affichage domaine
					}
					if (isset($_POST['sdom'])) // si sous domaine spécifié
					{
						echo'</br><h2>Sous_domaine du qcm : '.$_POST['sdom'].'</h2></br>';//affichage sous domaine
					}
					echo'<h2>id du qcm : '.$_POST['id'].'</h2>'; // on affichage Id QCM
				}
?>
			</header>
			<div class="infos">
				<input class="ques" placeholder="Intitulé de la question" type="text" name="q"/>
				<input class="last" placeholder="Temps" type="text" name="tps"/>
				<input class="last" placeholder="Point(s)" type="text" name="points"/>
			</div>
			<div class="réponse">
				<ul id="liste">
					<li id="ligne">
						<input value="Réponse" onClick="$(this).val('')" class="first" type="text" name="Rep[]" />
						<select name="select[]">
							<option class="green" value="Vrai">
								Correct
							</option>
							<option class="red" value="Faux" selected>
								Incorrect
							</option>
						</select>	
					</li>
				</ul>
			</div>
			<div class="ajouter">
				<input type="button" id="ajouterChamp" value="Ajouter une réponse"/>
			</div>
			<script>					
				$(document).ready(function()
				{	
					$('#ajouterChamp').click(function()
					{
						console.log("Clic sur le bouton");
						$('#liste').append($("#ligne").clone());
						console.log("Ajout de l'élement");
					});
					$('.first').click(function()
					{
						$(this).val('');
					});					
				});
			</script>
			
<?php
			echo '<input type="hidden" name="id" value="'.$_POST['idqcm'].'"/>';
?>
			<div class="message">
				<textarea placeholder="Rajouter un petit commentaire ici. Cela sera affiché sous votre question. ">
				</textarea>
			</div>
			<input type="hidden" name="creaquestion" value="creaquestion"/>
			<footer>
				<button>
					<input type="submit" value="Sauvegarder"/>
				</button>
			</footer>
		</div>
	</form>

</body>
</html>
