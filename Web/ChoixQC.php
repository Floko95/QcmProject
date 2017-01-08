<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
		 <link rel="stylesheet" href="ChoixQC.css" />
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,600' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
        <link href="https://fonts.googleapis.com/css?family=PT+Sans+Narrow" rel="stylesheet">
        <title></title>
    </head>
    <body>

        
        	  <div id="desk-nav">
  <nav>
    <ul>
      <li><a href="AccueilQ.php">Home</a></li>
      <li><a href="Profil.php">Profil</a></li>
      <li><a href="ChoixQC.php">QCM</a></li>
      <li><a href="Index.php">Déconnexion</a></li>
    </ul>
  </nav>
</div>




<div class="rela-block top-container">
    <div class="rela-block top-center-container">
        <div class="inner-container top-text-container">
            <h2 class="rela-block top-main-text">Choisir Domaine</h2>
            <p>Bienvenue. Installe-toi, choisis un domaine, les QCM t'attendent !</p>
        </div>
    </div>
</div>

        
        
        <div class="rela-block image-grid-container">
        
        
<?php
session_start();
require_once('Connexionbdd.php');
if(isset($_GET['d']) and trim($_GET['d']!='')and !(isset($_GET['sd'])))//domaine sélectionné,affichage des sous domaines de ce domaine
{
	$req=$bdd->prepare("SELECT * from sous_domaine natural join domaine where domaine=:d");
	$req->bindValue(':d',$_GET['d']);
	$req->execute();
    
    echo "<div class=\"box\"><div class=\"floded\">"; 
				echo '<p><form action="ChoixQC.php?d='.$_GET['d'].'&sd=general" " method="post">
					<h4><input type="submit" value="Général"/><h4></form></p>';
				echo "</div></div>";
    
	while($ligne=$req->fetch(PDO::FETCH_ASSOC))
	{
           
        echo "<div class=\"box\"><div class=\"floded\">"; 
				echo '<p><form action="ChoixQC.php?d='.$ligne['domaine'].'&sd='.$ligne['sous_domaine'].'" method="post">
					<input type="hidden" name="idsd" value="'.$ligne['sous_domaine'].'"/>
					<input type="hidden" name="nd" value="'.$_POST['nd'].'"/>
					<h4><input type="submit" value="'.$ligne['sous_domaine'].'"	/><h4></form></p>';
				echo "</div></div>";
	}
}
else if (isset($_GET['sd']) and trim($_GET['sd']!='') and isset($_GET['d']) and trim($_GET['d']!=''))//sous domaine sélectionné,création du qcm avec valeurs par defaut et id attribué.
{
	
	
	if($_GET['sd']=='general'){
	$req=$bdd->prepare("INSERT into qcm(auteur,domaine,note_total) values(:quest,:d,0)");
	$req->bindValue(':quest',$_SESSION['user']);
	$req->bindValue(':d',$_GET['d']);
	$req->execute();
	}else{
	
	$req=$bdd->prepare("INSERT into qcm(auteur,domaine,sous_domaine,note_total) values(:quest,:d,:sd,0)");
	$req->bindValue(':quest',$_SESSION['user']);
	$req->bindValue(':d',$_GET['d']);
	$req->bindValue(':sd',$_GET['sd']);
	$req->execute();	
	}
	
	
	$req=$bdd->prepare("SELECT * from qcm");
	$req->execute();
	while($ligne=$req->fetch(PDO::FETCH_ASSOC)){
		$id=$ligne['id_qcm'];
		}
		
	
	echo '<p>Vous allez maintenant pouvoir créer votre qcm</p>';
	if($_GET['sd']=='general')
	{
         
		echo '<form action="Questions.php" method="post"><input type="hidden" name="id" value="'.$id.'"/><input type="hidden" name="dom" value="'.$_GET['d'].'"/><button type="submit"class="start"/>Commencer le QCM</button></form>';
        
	}
	else
	{
		echo '<form action="Questions.php" method="post"><input type="hidden" name="id" value="'.$id.'"/><input type="hidden" name="dom" value="'.$_GET['d'].'"/><input type="hidden" name="sdom" value="'.$_GET['sd'].'"/><<button type="submit"class="start"/>Commencer le QCM</button></form>';
		
	}
}//redirection vers Questions.php avec le domaine,l'id du qcm  et le sous domaione du qcm en $_post.si domaine général le sous domaine n'est pas transmis
else//1-entrée de la création du qcm,affichage des domaines de la bdd
{
	$req=$bdd->prepare("SELECT * from domaine");
	$req->execute();
	while($ligne=$req->fetch(PDO::FETCH_ASSOC))
	{
       
        echo "<div class=\"box\"><div class=\"floded\">";
        echo '<p><form action="ChoixQC.php?d='.$ligne['domaine'].'" method="post">
				<input type="hidden" name="idd" value="'.$ligne['id_domaine'].'"/>
				<input type="hidden" name="nd" value="'.$ligne['domaine'].'"/>
				<h4><input type="submit" value="'.$ligne['domaine'].'"/><h4></form></p>';
        echo "</div></div>";
	}
}
?>            
      </div>
      <div class="rela-block button black-text load-button"><a href="" onClick="javascript:window.history.go(-1)">Retour</a></div>
       
</body>
</html>
