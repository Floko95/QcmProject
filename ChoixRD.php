<html>
	<meta charset="utf-8" />
    <link rel="stylesheet" href="ChoixRD.css" />
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,600' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=PT+Sans+Narrow" rel="stylesheet">
    <title> QCM | Choix Domaine</title>
 <head>
  <body>

<!-- NAVIGATION -->
      
<div id="desk-nav">
  <nav>
    <ul>
      <li><a href="AccueilR.php">Home</a></li>
      <li><a href="ProfilR.php">Profil</a></li>
      <li><a href="ChoixRD.php">QCM</a></li>
      <li><a href="Index.php">Déconnexion</a></li>
    </ul>
  </nav>
</div>

<!-- END NAVIGATION -->
      
<!-- MENU -->

<div class="rela-block top-container">
    <div class="rela-block top-center-container">
        <div class="inner-container top-text-container">
            <h2 class="rela-block top-main-text">Choisir Domaine</h2>
            <p>Bienvenue. Installe-toi, choisis un domaine, les QCM t'attendent !</p>
        </div>
    </div>
</div>

<!-- END MENU -->
      
<!-- GRILLE -->

<div class="rela-block image-grid-container">
    
    
<?php require_once('Connexionbdd.php');

    try{
		
		$req=$bdd->prepare("SELECT id_domaine,domaine FROM domaine");
		$req->execute();
		while($ligne=$req->fetch(PDO::FETCH_ASSOC)){						//affichage des domaines existant, avc un formulaire pour passer à la page de choix du sous-domaine
			echo "<div class=\"box\"><div class=\"floded\">";
			echo '<p><form action="ChoixRDS.php" method="post">
				<input type="hidden" name="idd" value="'.$ligne['id_domaine'].'"/>
				<input type="hidden" name="nd" value="'.$ligne['domaine'].'"/>
				<h4><input type="submit" value="'.$ligne['domaine'].'"/><h4></form></p>';
			echo "</div></div>";
		}

	}catch(PDOException $e){
	   die('<p>Votre requête est erronée.</p>');
	}	
?>

<!-- END GRILLE -->
    
</div>
</body>
</head>
