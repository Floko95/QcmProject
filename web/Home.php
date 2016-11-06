<!DOCTYPE html>

<html>

    <head>

        <meta charset="utf-8" />

        <title>QCM-Home</title>

    </head>

    <body>
	<?php 
	session_start();
		if ($_SESSION['connecte']){
			switch ($_SESSION['role']) {
				case 'repondeur' :
					echo('<p> Connexion répondeur réussie </p>');
					break;
				case 'questionneur' :
					echo('<p> Connexion questionneur réussie </p>');
					break;
				default : die('<p> Vous n\'avez techniquement pas à voir ça O_o </p>');
			} 
		echo"<p> Home à afficher ici </p>";
		}
		?>
		
    </body>

</html>