<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
		 <link rel="stylesheet" href="ChoixQC.css" />
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,600' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
        <link href="https://fonts.googleapis.com/css?family=PT+Sans+Narrow" rel="stylesheet">
        <title>Choix QCM</title>
    </head>
    <body>

        
        	  <div id="desk-nav">
  <nav>
    <ul>
      <li><a href="AccueilQ.php">Home</a></li>
      <li><a href="Profil.php">Profil</a></li>
      <li><a href="ChoixQC.php">QCM</a></li>
      <li><a href="../Autres/Index.php">Déconnexion</a></li>
    </ul>
  </nav>
</div>

    
<?php
session_start();
require_once('../Autres/Connexionbdd.php');
if(isset($_GET['d']) and trim($_GET['d']!='')and !(isset($_GET['sd'])))//2-domaine sélectionné,affichage des sous domaines de ce domaine
{
	$req=$bdd->prepare("SELECT * from sous_domaine natural join domaine where domaine=:d");
	$req->bindValue(':d',$_GET['d']);
	$req->execute();
    
                echo '<div class="rela-block top-container">
                <div class="rela-block top-center-container">
                <div class="inner-container top-text-container">
                <h2 class="rela-block top-main-text">Choisir Sous Domaine</h2>';
               // echo '<p>Bienvenue. Installe-toi, choisis un domaine, les QCM t\'attendent !</p>';
    		echo '<p>Domaine : '.$_GET['d'].'</p>';
                //créer un nouveau sous-domaine
				echo '<form action="CreerDomaine.php"  method="post">
				<input type="hidden" name="domaine" value="'.$_GET['d'].'"/>
				<input class="creer" type="submit" name="sbouton" value="Créer Sous-domaine"/></form>';
				echo '</div></div></div>';
			
                echo '<div class="rela-block image-grid-container">';
			
				
	while($ligne=$req->fetch(PDO::FETCH_ASSOC))
	{   
        echo "<div class=\"box\"><div class=\"floded\">"; 
        echo '<p><form action="ChoixQC.php?d='.$ligne['domaine'].'&sd='.$ligne['sous_domaine'].'" method="post">
        <h4><input type="submit" value="'.$ligne['sous_domaine'].'"	/><h4></form></p>';
        echo "</div></div>";		
	}
        echo "<div class=\"box\"><div class=\"floded\">"; 
        echo '<p><form action="ChoixQC.php?d='.$_GET['d'].'&sd=general" " method="post">
        <h4><input type="submit" value="Général"/><h4></form></p>';
        echo "</div></div></div>";
    
    
    
}
else if (isset($_GET['sd']) and trim($_GET['sd']!='') and isset($_GET['d']) and trim($_GET['d']!=''))//3-sous domaine sélectionné,création du qcm avec valeurs par defaut et id attribué.
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
    
     echo '<div class="rela-block top-container">
                <div class="rela-block top-center-container">
                <div class="inner-container top-text-container">
                <h2 class="rela-block top-main-text">Vous avez choisi:</h2>';
                
		echo '<p>Domaine : '.$_GET['d'].'</p>';
		echo '<p>Sous-Domaine : '.$_GET['sd'].'</p>';
                echo '</div></div></div>';
                echo '<div class="rela-block image-grid-container">';
	while($ligne=$req->fetch(PDO::FETCH_ASSOC)){
		$id=$ligne['id_qcm'];
	}	
	
	echo '<p>Vous allez maintenant pouvoir créer votre qcm</p>';
	if($_GET['sd']=='general')
	{     
		echo '<form action="ChoixQQ.php" method="post"><input type="hidden" name="id" value="'.$id.'"/><input type="hidden" name="dom" value="'.$_GET['d'].'"/><button type="submit"class="start1"/>Commencer le QCM</button></form>';   }
	else
	{
		echo '<form action="ChoixQQ.php" method="post"><input type="hidden" name="id" value="'.$id.'"/><input type="hidden" name="dom" value="'.$_GET['d'].'"/><input type="hidden" name="sdom" value="'.$_GET['sd'].'"/><button type="submit"class="start1"/>Commencer le QCM</button></form>';
	}
    
    echo "</div>";
}//redirection vers ChoixQQ.php avec le domaine,l'id du qcm  et le sous domaine du qcm en $_post.si domaine général le sous domaine n'est pas transmis
else//1-entrée de la création du qcm,affichage des domaines de la bdd
{
                echo '<div class="rela-block top-container">
                <div class="rela-block top-center-container">
                <div class="inner-container top-text-container">
                <h2 class="rela-block top-main-text">Choisir Domaine</h2>
                <p>Bienvenue. Installe-toi, choisis un domaine, les QCM t\'attendent !</p>';
    
				//créer un nouveau domaine
				echo '<form action="CreerDomaine.php"  method="post">
				<input class="creer" type="submit" name="bouton" class="rela-inline button white-text" value="Créer Domaine"/></form>';
                echo "</div></div></div>";
    
    echo '<div class="rela-block image-grid-container">';
				
				
	$req=$bdd->prepare("SELECT * from domaine");
	$req->execute();
	while($ligne=$req->fetch(PDO::FETCH_ASSOC))
	{
       
        echo "<div class=\"box\"><div class=\"floded\">";
        echo '<p><form action="ChoixQC.php?d='.$ligne['domaine'].'" method="post">
        <h4><input type="submit" value="'.$ligne['domaine'].'"/><h4></form></p>';
        echo "</div></div>";
	}
    echo "</div>";
}
//?d='.$_GET['d'].'&sd='.$_GET['sd']
        ?>
		
		  <div class="rela-block button black-text load-button">
		<?php  if (isset($_GET['sd'])){
			echo "<div class=\"box\"><div class=\"floded\">";
			echo $_GET['d'];
			echo "</div></div>";
			
			?>
        <a href='ChoixQC.php?d='.$_GET['d'].'>Retour</a>
		 <?php }else{
			  ?><a href='ChoixQC.php'>Retour</a><?php
		 }?>
      </div>
     
        
</body>
</html>
