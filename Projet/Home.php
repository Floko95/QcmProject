<!DOCTYPE html>

<html>

    <head>

        <meta charset="utf-8" />

        <title>QCM-Home</title>

    </head>

    <body>
	<?php 
	session_start();
	 
		if ($_SESSION['connecte'] != 'v')
			header('Location: connexion.php?dc=v');
		echo"<p>connexion reussie</br>Home à afficher ici </p>";
		
		?>
		
    </body>

</html>