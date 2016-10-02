<!DOCTYPE html>

<html>

    <head>

        <meta charset="utf-8" />

        <title>QCM-Connexion</title>

    </head>

    <body>
		<form action="Home.php" method="post">
		<input type="text" name="nom"/>
		<input type="password" name="mdp"/>
		<input type="submit" />
		</form>
       <?php 
	   if (isset($_GET['conn']) and (trim($_GET['conn'])!=''))
	   {
		   if ($_GET['conn']=="f")
			echo "<p>Connexion refusée</p>";   
		   
		   
	   }
		?>
    </body>

</html>