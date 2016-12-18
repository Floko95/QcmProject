<html>
	<meta charset="utf-8" />
    <link rel="stylesheet" href="ChoixRD.css" />
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,600' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=PT+Sans+Narrow" rel="stylesheet">
    <title> QCM | Choix Domaine</title>
 <head>
  <body>

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

      
      

<input type="checkbox" id="searchCheckbox"/>

<div class="rela-block top-container">
    <div class="rela-block top-center-container">
        <div class="inner-container top-text-container">
            <h2 class="rela-block top-main-text">Choisir Domaine</h2>
            <p>Bienvenue. Installe-toi, choisis un domaine, les QCM t'attendent !</p>
            <div class="rela-inline button white-text">Aléatoire</div>
        </div>
        <div class="inner-container top-search-container">
            <p class="search-text">Search Domain</p>
            <input type="text" placeholder="Type Something" class="top-search"/>
        </div>
    </div>
  
    <label for="searchCheckbox" class="checkbox-label search-label">
        <div class="abs-center magnifying-glass"></div>
    </label>
</div>


	  
	  

<div class="rela-block image-grid-container">
    
    
    <?php require_once('Connexionbdd.php');

    try{

	$req=$bdd->prepare("SELECT * FROM domaine");
	$req->execute();
	while($ligne=$req->fetch(PDO::FETCH_ASSOC))
    {
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
    
</div>

      <div class="rela-block button black-text load-button"><a href="" onClick="javascript:window.history.go(-1)">Retour</a></div>

	 </body>
	</head>
