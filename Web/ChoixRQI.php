<html>
	<meta charset="utf-8" />
    <link rel="stylesheet" href="ChoixRQI.css" />
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,600' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
    <title> QCM | Choix QCM</title>
 <head>
  <body>

	  

<input type="checkbox" id="menuCheckbox"/>
<input type="checkbox" id="searchCheckbox"/>


<div class="side-menu">
    <label for="menuCheckbox" class="checkbox-label side-menu-label">
        <div class="abs-center white-x"></div>
    </label>
    <div class="rela-block menu-content">
        <h3 class="rela-block list-header">Navigation</h3>
        <ul class="rela-block options-list">
			<a href="AccueilR.php"><li>Accueil</li></a>
			<a href="ProfilR.php"><li>Profil</li></a>
            <li>IDK</li>
            <li>IDK</li>
        </ul>
        <h3 class="rela-block list-header">Explore</h3>
        <ul class="rela-block options-list">
            <li>IDK</li>
            <li>IDK</li>
          
        </ul>
    </div>
    
    
    
    <div class="social-buttons-container">
        <div class="rela-inline social-button twitter"></div>
        <div class="rela-inline social-button facebook"></div>
        <div class="rela-inline social-button pinterest"></div>
        <div class="rela-inline social-button instagram"></div>
    </div>
</div>


<div class="rela-block top-container">
    <div class="rela-block top-center-container">
        <div class="inner-container top-text-container">
            <h2 class="rela-block top-main-text">Choisir QCM</h2>
            <p>Les choses sérieuses débutent: choisis un QCM !</p>
            <div class="rela-inline button white-text">Aléatoire</div>
        </div>
        <div class="inner-container top-search-container">
            <p class="search-text">Search Domain</p>
            <input type="text" placeholder="Type Something" class="top-search"/>
        </div>
    </div>
    <label for="menuCheckbox" class="checkbox-label menu-label">
        <div class="abs-center black-lines"></div>
    </label>
    <label for="searchCheckbox" class="checkbox-label search-label">
        <div class="abs-center magnifying-glass"></div>
    </label>
</div>


	  
	  

<div class="rela-block image-grid-container">
    
    
    <?php 

require_once('Connexionbdd.php');
try{
	
if(isset($_POST['idsd'])and trim($_POST['idsd']!=' ')){
	echo'sous-domaine : '.$_POST['idsd'];
	$req=$bdd->prepare("SELECT distinct id_qcm,auteur FROM qcm natural join qcm_question where qcm_question.sous_domaine=:idsd and qcm.id_qcm=qcm_question.id_qcm and visible=true");
	$req->bindValue(':idsd',$_POST['idsd']);
	$req->execute();
	while($l=$req->fetch(PDO::FETCH_ASSOC))
		{
        echo "<div class=\"box\"><div class=\"floded\">";
	
	echo '<p><form action="Executer.php" method="post">
	<input type="hidden" name="iq" value="'.$l['id_qcm'].'"/>
	<h4><input type="submit" value="QCM N°'.$l['id_qcm'].' créé par '.$l['auteur'].'"/><h4></form></p>';
	
        echo "</div></div>";
			
	}
}
}catch(PDOException $e){
	die('<p>Votre requête est erronée.</p>');
}
	
?>
    
</div>

      <div class="rela-block button black-text load-button"><a href="" onClick="javascript:window.history.go(-1)">Retour</a></div>

	 </body>
	</head>
