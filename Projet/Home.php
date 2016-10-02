<!DOCTYPE html>

<html>

    <head>

        <meta charset="utf-8" />

        <title>QCM-Home</title>

    </head>

    <body>
	<?php 
	
		if (isset($_POST['nom']) and isset($_POST['mdp']) and trim($_POST['nom']!='') and trim($_POST['mdp']))
		{
			if($_POST['nom']=='jean' and $_POST['mdp']=='sel')
			{
				
				echo"<p>connexion reussie</br>Home</p>";
			}
			else
			{
				echo"<p>Votre mot de passe/nom d'utilisateur est incorrect.Veuillez réessayer <a href='connexion.php?conn=f'>Ici</a></p>";
				
				exit();
			}
			
		}
		?>
    </body>

</html>