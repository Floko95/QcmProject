<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
		 <link rel="stylesheet" href="ChoixQC.css" />
        <title></title>
    </head>
    <body>

		<a name="home"></a>
<div id="desk-nav">
  <nav>
    <ul>
      <li><a href="AccueilQ.php">Home</a></li>
      <li><a href="Profil.php">Profil</a></li>
      <li><a href="#">QCM</a></li>
      <li><a href="Index.php">Déconnexion</a></li>
    </ul>
  </nav>
</div>


<header class="parallax-window" data-parallax="scroll">

  <div id="content-container">
	 
    <h2 id="desk-hero"> Commencer à créer votre QCM</h2>
     <div id="menu-front">
		 <ul>
			 <li><a href="CreationQuestions.php">Créer une question</a></li>
			 <li><a href="Importer.php">Importer une question</a></li>
		 </ul>
    </div>	  
  </div>

</header>
<?php
session_start();
require_once('Connexionbdd.php');
if(isset($_GET['d']) and trim($_GET['d']!='')and !(isset($_GET['sd'])))//domaine sélectionné,affichage des sous domaines de ce domaine
{
	$req=$bdd->prepare("SELECT * from sous_domaine natural join domaine where domaine=:d");
	$req->bindValue(':d',$_GET['d']);
	$req->execute();
	echo '<a href="ChoixQC.php?d='.$_GET['d'].'&sd=general">General</a>';
	while($ligne=$req->fetch(PDO::FETCH_ASSOC))
	{
		echo '<a href="ChoixQC.php?d='.$ligne['domaine'].'&sd='.$ligne['sous_domaine'].'">'.$ligne['sous_domaine'].'</a>';
	}
}
else if (isset($_GET['sd']) and trim($_GET['sd']!='') and isset($_GET['d']) and trim($_GET['d']!=''))//sous domaine sélectionné,création du qcm avec valeurs par defaut et id attribué.
{
	
	$req=$bdd->prepare("INSERT into qcm(auteur) values(:quest)");
	$req->bindValue(':quest',$_SESSION['user']);
	$req->execute();
	$req=$bdd->prepare("SELECT * from qcm");
	$req->execute();
	while($ligne=$req->fetch(PDO::FETCH_ASSOC)){
		$id=$ligne['id_qcm'];
		}
	
	echo '<p>Vous allez maintenant pouvoir créer votre qcm</p>';
	if($_GET['sd']=='general')
	{
		echo '<form action="Questions.php" method="post"><input type="hidden" name="id" value="'.$id.'"/><input type="hidden" name="dom" value="'.$_GET['d'].'"/><input type="submit" value="Commencer le QCM"/></form>';
	}
	else
	{
		echo '<form action="Questions.php" method="post"><input type="hidden" name="id" value="'.$id.'"/><input type="hidden" name="dom" value="'.$_GET['d'].'"/><input type="hidden" name="sdom" value="'.$_GET['sd'].'"/><input type="submit" value="Commencer le QCM"/></form>';
	}
}//redirection vers Questions.php avec le domaine,l'id du qcm  et le sous domaione du qcm en $_post.si domaine général le sous domaine n'est pas transmis
else//1-entrée de la création du qcm,affichage des domaines de la bdd
{
	$req=$bdd->prepare("SELECT * from domaine");
	$req->execute();
	while($ligne=$req->fetch(PDO::FETCH_ASSOC))
	{
		echo '<a href="ChoixQC.php?d='.$ligne['domaine'].'">'.$ligne['domaine'].'</a>';
	}
}



?>
<!-- END LANDING PAGE -->



<!-- About -->





<!-- END ABOUT -->

<!-- FOOTER -->
  
  <footer>
    <p>&copy; DUT Informatique. All Rights Reserved.<span class="year">2016</span></p>
  </footer>

		
		
		
	</body>
</html>