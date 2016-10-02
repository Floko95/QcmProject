<!DOCTYPE html>

<html>

    <head>

        <meta charset="utf-8" />

        <title>QCM-Connexion</title>

    </head>

    <body>
	 <?php 
		session_start();
	   if (isset($_POST['nom']) and isset($_POST['mdp'])  and trim($_POST['nom']!='') and trim($_POST['mdp']))
	   {
		   if($_POST['nom']=='jean' and $_POST['mdp']=='sel')
		   {
			   
			   $_SESSION['connecte']= 'v';
			   header('Location: Home.php');
			   
		   }
		   else
			   echo "<p>Votre nom d'utilisateur/mot de passe est invalide</p>"; 
	   }
	   if(isset($_GET['dc']) and trim($_GET['dc']!=''))
		   echo "<p>Vous avez été déconnecté.Veuillez ressaisir vos identifiants</p>";
		?>
		<form action="connexion.php" method="post">
		<input type="text" name="nom"/>
		<input type="password" name="mdp"/>
		<input type="submit" />
		</form>
      
    </body>

</html>