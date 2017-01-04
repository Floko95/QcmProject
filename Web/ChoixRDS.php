<html>
	<meta charset="utf-8" />
    <link rel="stylesheet" href="ChoixRDS.css" />
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,600' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=PT+Sans+Narrow" rel="stylesheet">
    <title> QCM | Choix Sous Domaine</title>
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
            <h2 class="rela-block top-main-text">Choisir Sous-Domaine</h2>
            <p><?php if(isset($_POST['nd'])){echo 'Domaine : '.$_POST['nd'];}?></p>
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
    
    
   <?php 
session_start();
require_once('Connexionbdd.php');


if(isset($_POST['idd'])and trim($_POST['idd']!=' ')){
	if(isset($_POST['nd'])and trim($_POST['nd']!=' ')){

	
try{
	$req=$bdd->prepare("SELECT * FROM sous_domaine natural join domaine where id_domaine=:id");
	$req->bindValue(':id',$_POST['idd']);
	$req->execute();
	$tour=-1;
	while($ligne=$req->fetch(PDO::FETCH_ASSOC))
		{
        $tour+=1;
        echo "<div class=\"box\"><div class=\"floded\">"; 
	   echo '<p><form action="ChoixRQI.php" method="post">
	<input type="hidden" name="idsd" value="'.$ligne['sous_domaine'].'"/>
	<input type="hidden" name="nd" value="'.$_POST['nd'].'"/>
	<h4><input type="submit" value="'.$ligne['sous_domaine'].'"	/><h4></form></p>';
        echo "</div></div>";	
	}if ($tour==-1){
    echo "</br>Ce domaine ne contient pas de sous-domaine</br>";
	}
    
    $req=$bdd->prepare("SELECT distinct id_qcm,auteur FROM qcm natural join qcm_question where qcm.domaine=:nd and qcm.sous_domaine is null and qcm.id_qcm=qcm_question.id_qcm and visible=true");
	$req->bindValue(':nd',$_POST['nd']);
	$req->execute();
	while($l=$req->fetch(PDO::FETCH_ASSOC))
		{
        echo "<div class=\"box\"><div class=\"floded\">";
	   echo '<p><form action="Executer.php" method="post">
	<input type="hidden" name="iq" value="'.$l['id_qcm'].'"/>
	<input type="hidden" name="nd" value="'.$_POST['nd'].'"/>
	<input type="hidden" name="idsd" value="Aucun"/>
	<h4><input type="submit" value="QCM N°'.$l['id_qcm'].' créé par '.$l['auteur'].'"/><h4></form></p>';
	$_SESSION['executer']=1;
        echo "</div></div>";
	 }
   

	
	
   }catch(PDOException $e){
	die('<p>Votre requête est erronée.</p>');
}	
}	
}
	
?>
    
</div>

      <div class="rela-block button black-text load-button"><a href="" onClick="javascript:window.history.go(-1)">Retour</a></div>

	 </body>
	</head>
