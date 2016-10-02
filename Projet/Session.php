
<!DOCTYPE html>

<html>

    <head>

        <meta charset="utf-8" />

        <title>QCM-Home</title>

    </head>

    <body>
	<!--a rajouter sur chaque page du site-->
	<?php session_start();
	 
		if ($_SESSION['connecte'] != 'v')
			header('Location: connexion.php?dc=v');
		?>
    </body>

</html>