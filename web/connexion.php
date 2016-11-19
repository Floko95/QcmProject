<!DOCTYPE html>
	<meta charset="utf-8" />
    <link rel="stylesheet" href="c.css" />
    <title> QCM | Connexion</title>
 <head>
  <body>
	  

<div class="container">
  <div id="login-form">
    <h3>Login</h3>
    <fieldset>
		
		
<?php
session_start();
	if (isset($_POST['nom']) and isset($_POST['mdp']) and trim($_POST['nom']!='') and trim($_POST['mdp']!=''))
		{
		require_once('Connexionbdd.php');
		try {
			$req = $bdd->prepare("SELECT * FROM public.repondeur WHERE nom_repondeur = :nom AND mdp_repondeur = :mdp");
			$req->bindValue(':nom', $_POST['nom']);
			$req->bindValue(':mdp', $_POST['mdp']);
			$req->execute();
			$countRep = $req->rowCount();
			switch ($countRep){
				case 1 :	
					$_SESSION['user'] = $_POST['nom'];
					$_SESSION['role'] = 'repondeur';
					$_SESSION['connecte']= true;	
					header('Location: ar.php');
					break;
				case 0 : 	
					echo('<p> Nom de repondeur ou mot de passe incorrect </p>');
					break;
				default :
					die('<p> Erreur : Le nom et le mdp correspondent à plus d\'un repondeur </p>');
					break;
			}
		}
		catch (PDOException $e) {
			die('<p> Probleme avec authentification repondeur ['.$e->getCode().'] '.$e->getMessage().'</p>');
		}
		
		try {
			$req = $bdd->prepare("SELECT * FROM public.questionneur WHERE nom_questionneur = :nom AND mdp_questionneur = :mdp");
			$req->bindValue(':nom', $_POST['nom']);
			$req->bindValue(':mdp', $_POST['mdp']);
			$req->execute();
			$countRep = $req->rowCount();
			switch ($countRep){
				case 1 :
					$_SESSION['user'] = $_POST['nom'];
					$_SESSION['role'] = 'questionneur';
					$_SESSION['connecte']= true;
					header('Location: aq.php');
					break;
				case 0 : 	
					echo('<p> Nom de questionneur ou mot de passe incorrect </p>');
					break;
				default :
					die('<p> Erreur : Le nom et le mdp correspondent à plus d\'un questionneur </p>');
					break;
			}
		}
		catch (PDOException $e) {
			die('<p> Probleme avec authentification questionneur ['.$e->getCode().'] '.$e->getMessage().'</p>');
		}
}

?>

<form action="connexion.php" method="post">
<input type="text" name="nom" placeholder="pseudo"/>
<input type="password" name="mdp" placeholder="mot de passe"/>
<input type="submit"/>
</form>

</body>
</html>
