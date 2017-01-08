<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
		 <link rel="stylesheet" href="P.css" />
         <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,600' rel='stylesheet' type='text/css'>
         <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
         <link href="https://fonts.googleapis.com/css?family=PT+Sans+Narrow" rel="stylesheet">
        <title></title>
    </head>
    <body>
		
        <!-- NAVIGATION -->

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
        
        <!-- END NAVIGATION -->
        
        
<?php session_start();
require_once('Connexionbdd.php'); ?>
        
        
<div class="fond">
<div class="bloc">
	
    <div class="top-bar"><span class="title">Profil</span></div>
    
	<div class="profil">
		<div class="cover">
			<span class="vec vec_a"></span>
			<span class="vec vec_b"></span>
			<span class="vec vec_c"></span>
			<span class="vec vec_d"></span>
			<span class="vec vec_e"></span>
		</div>
        
    <div class="photo"><img src="http://icons.iconarchive.com/icons/webalys/kameleon.pics/512/Alien-icon.png"></div>
		<div class="info"><?php echo '<div class="name">'.$_SESSION['user'].'</div>';?></div>
		
        <label for="retour" class="retour"><a href="" onClick="javascript:window.history.go(-1)"><img src="http://img15.hostingpics.net/pics/571733arrow8724.png"></a></label>
	</div>
    
    
    <div class="tabs-content">
		<div class="liste">
			
         

<?php 
if(isset($_GET['d']) and trim($_GET['d']!='') and !(isset($_GET['sd'])))//2-domaine sélectionné,affichage des sous domaines de ce domaine dans lesquels le questionneur a créé des qcms
{
	echo '<div class="list title"> '.$_GET['d'].'</div>';
	$req=$bdd->prepare("SELECT distinct domaine,sous_domaine  FROM public.qcm WHERE auteur=:a and domaine=:d");
	$req->bindValue(':a',$_SESSION['user']);
	$req->bindValue(':d',$_GET['d']);
	$req->execute();
	while($ligne=$req->fetch(PDO::FETCH_ASSOC))
	{
        echo'<div class="list">	
        <div class="info pull-left">
        <div class="name">';
        echo '<a href="Profil.php?d='.$ligne['domaine'].'&sd='.$ligne['sous_domaine'].'">'.$ligne['sous_domaine'].'</a>';
        echo'</div></div></div>';
	}
	
	$req2=$bdd->prepare("SELECT  distinct id_qcm FROM public.qcm WHERE domaine=:d and auteur=:a and sous_domaine is NULL");
	$req2->bindValue(':a',$_SESSION['user']);
	$req2->bindValue(':d',$_GET['d']);
	$req2->execute();
	while($ligne=$req2->fetch(PDO::FETCH_ASSOC))
	{
        echo'<div class="list">	
		<div class="info pull-left">
        <div class="name">';
        echo '<form action="VisualisationQCM.php" method="post"><button type="submit" name="qcmb"> QCM Général n° '.$ligne['id_qcm'].' <nutton><input type="hidden" name="id" value="'.$ligne['id_qcm'].'" /></form>';
        echo'</div></div></div>';
	}
}
            
else if (isset($_GET['sd']) and trim($_GET['sd']!='') and isset($_GET['d']) and trim($_GET['d']!=''))//3-sous domaine sélectionné,affichage des qcms créés par le questionneur dans ce sous domaine
{
	echo '<div class="list title">'.$_GET['d'].' / '.$_GET['sd'].'</div>';
	$req=$bdd->prepare("SELECT  distinct id_qcm FROM public.qcm WHERE domaine=:d and sous_domaine=:sd and auteur=:a");
	$req->bindValue(':a',$_SESSION['user']);
	$req->bindValue(':d',$_GET['d']);
	$req->bindValue(':sd',$_GET['sd']);
	$req->execute();
	
	while($ligne=$req->fetch(PDO::FETCH_ASSOC))
	{
        echo'<div class="list">	
        <div class="info pull-left">
        <div class="name">';
        echo '<form action="VisualisationQCM.php" method="post"><button type="submit" name="qcmb"> QCM numéro '.$ligne['id_qcm'].' </button><input type="hidden" name="id" value="'.$ligne['id_qcm'].'" /></form>';
        echo'</div></div></div>';
	}
}
            
else//1-entrée du profil,affichage des domaines dans lesquels le questionneur a créé des qcms
{
	echo '<div class="list title">Récapitulatif</div>';
	$req=$bdd->prepare("SELECT distinct domaine FROM public.qcm WHERE auteur=:a");
	$req->bindValue(':a',$_SESSION['user']);
	$req->execute();
	while($ligne=$req->fetch(PDO::FETCH_ASSOC))
	{
        echo'<div class="list">	
        <div class="info pull-left">
        <div class="name">';
        echo '<a href="Profil.php?d='.$ligne['domaine'].'">'.$ligne['domaine'].'</a>';
        echo'</div></div></div>';
	}
}
?>
                
                
</div>
</div>
</div>
</div>

	
	</body>
	</html>
