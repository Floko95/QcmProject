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
		

<div id="desk-nav">
  <nav>
    <ul>
      <li><a href="Index.php">Home</a></li>
      <li><a href="Profil.php">Profil</a></li>
      <li><a href="ChoixQC.php">QCM</a></li>
      <li><a href="Index.php">Déconnexion</a></li>
    </ul>
  </nav>
</div>

 <div class="material-wrap">
<div class="material clearfix">
	<div class="top-bar">
		<div class="pull-left">
			<a href="#" class="menu-tgl pull-left"><i class="fa fa-bars"></i></a>
		</div>
		<span class="title">Profil</span>
		<div class="pull-right">
			<a href="#" class="search-tgl pull-left"><i class="fa fa-search"></i></a>
			<a href="#" class="option-tgl pull-left"><i class="fa fa-ellipsis-v"></i></a>
		</div>
	</div>
	<div class="profile">
		<div class="cover">
			<span class="vec vec_a"></span>
			<span class="vec vec_b"></span>
			<span class="vec vec_c"></span>
			<span class="vec vec_d"></span>
			<span class="vec vec_e"></span>
		</div>
		<div class="photo">
			<a href="" target="_blank"><img src="http://icons.iconarchive.com/icons/webalys/kameleon.pics/512/Alien-icon.png"></a>
		</div>
		<div class="info">
			<div class="name">Pseudo</div>
			<div class="position">Rang</div>
		</div>
		<input id="toggle" type="checkbox" class="plus"><label for="toggle" class="toggle"></label>
		<div class="links">
			<a href="" data-title="IDK"><i class="fa fa-facebook"></i></a>
			<a href="" data-title="IDK"><i class="fa fa-twitter"></i></a>
			<a href="" data-title="IDK"><i class="fa fa-codepen"></i></a>
			<a href="" data-title="IDK"><i class="fa fa-pinterest"></i></a>
		</div>
	</div>
    
    
    <div class="tabs-content">
		<div class="friend-list">
			<div class="list-ul">
				<div class="list-li title">Récapitulatif</div>
                
                
                

<?php 
session_start();
require_once('Connexionbdd.php');

if(isset($_GET['d']) and trim($_GET['d']!='') and !(isset($_GET['sd'])))//2-domaine sélectionné,affichage des sous domaines de ce domaine dans lesquels le questionneur a créé des qcms
{
	$req=$bdd->prepare("SELECT distinct domaine,sous_domaine  FROM public.qcm WHERE auteur=:a and domaine=:d");
	$req->bindValue(':a',$_SESSION['user']);
	$req->bindValue(':d',$_GET['d']);
	$req->execute();
	while($ligne=$req->fetch(PDO::FETCH_ASSOC))
	{
        echo'    <div class="list-li clearfix">	
					<div class="info pull-left">
						<div class="name">';
		echo '<a href="Profil.php?d='.$ligne['domaine'].'&sd='.$ligne['sous_domaine'].'">'.$ligne['sous_domaine'].'</a>';
        echo'</div>
					</div>
				</div>';
	}
	
	
	$req2=$bdd->prepare("SELECT  distinct id_qcm FROM public.qcm WHERE domaine=:d and auteur=:a and sous_domaine is NULL");
	$req2->bindValue(':a',$_SESSION['user']);
	$req2->bindValue(':d',$_GET['d']);
	$req2->execute();
	while($ligne=$req2->fetch(PDO::FETCH_ASSOC))
	{
        echo'    <div class="list-li clearfix">	
					<div class="info pull-left">
						<div class="name">';
		 echo '<form action="VisualisationQCM.php" method="post"><input type="submit" name="qcmb" value="QCM numéro '.$ligne['id_qcm'].'" /><input type="hidden" name="id" value="'.$ligne['id_qcm'].'" /></form>';
        echo'</div>
					</div>
				</div>';
	}
}	

else if (isset($_GET['sd']) and trim($_GET['sd']!='') and isset($_GET['d']) and trim($_GET['d']!=''))//3-sous domaine sélectionné,affichage des qcms créés par le questionneur dans ce sous domaine
{
	$req=$bdd->prepare("SELECT  distinct id_qcm FROM public.qcm WHERE domaine=:d and sous_domaine=:sd and auteur=:a");
	$req->bindValue(':a',$_SESSION['user']);
	$req->bindValue(':d',$_GET['d']);
	$req->bindValue(':sd',$_GET['sd']);
	$req->execute();
	
	while($ligne=$req->fetch(PDO::FETCH_ASSOC))
	{
        echo'    <div class="list-li clearfix">	
					<div class="info pull-left">
						<div class="name">';
		 echo '<form action="VisualisationQCM.php" method="post"><input type="submit" name="qcmb" value="QCM numéro '.$ligne['id_qcm'].'" /><input type="hidden" name="id" value="'.$ligne['id_qcm'].'" /></form>';
        echo'</div>
					</div>
				</div>';
	}
}

else//1-entrée du profil,affichage des domaines dans lesquels le questionneur a créé des qcms
{
	$req=$bdd->prepare("SELECT distinct domaine FROM public.qcm WHERE auteur=:a");
	$req->bindValue(':a',$_SESSION['user']);
	$req->execute();
	while($ligne=$req->fetch(PDO::FETCH_ASSOC))
	{
         echo'    <div class="list-li clearfix">	
					<div class="info pull-left">
						<div class="name">';
		echo '<a href="Profil.php?d='.$ligne['domaine'].'">'.$ligne['domaine'].'</a>';
        echo'</div>
					</div>
				</div>';
	}
}













?>
                
                
</div>
		</div>
	</div>
</div>
</div>
	
	</body>
	</html>

