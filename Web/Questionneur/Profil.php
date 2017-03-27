
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
		 <link rel="stylesheet" href="ProfilQ.css" />
        <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="Profil.js"></script>
         <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,600' rel='stylesheet' type='text/css'>
         <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
         <link href="https://fonts.googleapis.com/css?family=PT+Sans+Narrow" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Lato:100,300" rel="stylesheet">
        <title>Profil</title>
    </head>
    <body>
		
        <!-- NAVIGATION -->

<div id="desk-nav">
  <nav>
    <ul>
      <li><a href="AccueilQ.php">Home</a></li>
      <li><a href="Profil.php">Profil</a></li>
      <li><a href="ChoixQC.php">QCM</a></li>
      <li><a href="../Index.php">Déconnexion</a></li>
    </ul>
  </nav>
</div>
        
        <!-- END NAVIGATION -->
        
        
<?php session_start();
require_once('../Autres/Connexionbdd.php'); ?>
        
        
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
        
    <div class="photo"><img src="https://thumbs.dreamstime.com/t/age-brain-collection_flat-cartoon-vector-illustration-old-wearing-round-glasses-long-white-beard-holding-stick-part-72812212.jpg"></div>
		<div class="info"><?php echo '<div class="name">'.$_SESSION['user'].'</div>';?></div>
		
        <label for="retour" class="retour"><a href="" onClick="javascript:window.history.go(-1)"><img src="http://img15.hostingpics.net/pics/571733arrow8724.png"></a></label>
	</div>
    
    
    <div class="tabs-content">
		<div class="liste">
			
         

<?php 
if(isset($_GET['d']) and trim($_GET['d']!='') and !(isset($_GET['sd'])))//2-domaine sélectionné,affichage des sous domaines de ce domaine dans lesquels le questionneur a créé des qcms sous forme de boutons
{
	echo '<div class="list title"> '.$_GET['d'].'</div>';
	$req=$bdd->prepare("SELECT distinct domaine,sous_domaine  FROM qcm WHERE auteur=:a and domaine=:d");
	$req->bindValue(':a',$_SESSION['user']);
	$req->bindValue(':d',$_GET['d']);
	$req->execute();
	while($ligne=$req->fetch(PDO::FETCH_ASSOC))
	{
        echo'<div class="list">	
        <div class="info pull-left">
        <div class="name">';
		if(!(empty($ligne['sous_domaine'])))
        echo '<a href="Profil.php?d='.$ligne['domaine'].'&sd='.$ligne['sous_domaine'].'">'.$ligne['sous_domaine'].'</a>';
        echo'</div></div></div>';
	}
	
	$req2=$bdd->prepare("SELECT  distinct id_qcm FROM qcm WHERE domaine=:d and auteur=:a and sous_domaine is NULL");// on affiche aussi les boutons des qcms de ce domaine mais sans sous domaine
	$req2->bindValue(':a',$_SESSION['user']);
	$req2->bindValue(':d',$_GET['d']);
	$req2->execute();
	while($ligne=$req2->fetch(PDO::FETCH_ASSOC))
	{
        echo'<div class="list">	
		<div class="info pull-left">
        <div class="name">';
        echo '<form action="VisualisationQCM.php" method="post"><button type="submit" name="qcmb" id="'.$ligne['id_qcm'].'"> QCM Général n° '.$ligne['id_qcm'].' </button>
		 <i class="reg">(plus d\'informations)</i>
		<input type="hidden" name="id" value="'.$ligne['id_qcm'].'" /></form>';
        echo'</div></div></div>';//et en propose la visualisation
	}
}
            
else if (isset($_GET['sd']) and trim($_GET['sd']!='') and isset($_GET['d']) and trim($_GET['d']!=''))//3-sous domaine sélectionné,affichage des qcms créés par le questionneur dans ce sous domaine sous forme de boutons vers leur visualisation
{
	echo '<div class="list title">'.$_GET['d'].' / '.$_GET['sd'].'</div>';
	$req=$bdd->prepare("SELECT  distinct id_qcm FROM qcm WHERE domaine=:d and sous_domaine=:sd and auteur=:a");
	$req->bindValue(':a',$_SESSION['user']);
	$req->bindValue(':d',$_GET['d']);
	$req->bindValue(':sd',$_GET['sd']);
	$req->execute();
	
	while($ligne=$req->fetch(PDO::FETCH_ASSOC))
	{
        echo'<div class="list">	
        <div class="info pull-left">
        <div class="name">';
        echo '<form action="VisualisationQCM.php" method="post"><button type="submit" name="qcmb" id="'.$ligne['id_qcm'].'"> QCM numéro '.$ligne['id_qcm'].' </button>
        
        <i class="reg">(plus d\'informations)</i>
        
        
<input type="hidden" name="id" value="'.$ligne['id_qcm'].'" /></form>';
        echo'</div></div></div>';
	}
}
            
else//1-entrée du profil,affichage des domaines dans lesquels le questionneur a créé des qcms sous forme de boutons
{
	echo '<div class="list title">Récapitulatif</div>';
	$req=$bdd->prepare("SELECT distinct domaine FROM qcm WHERE auteur=:a");
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
        
        <div class="pop"><span>✖</span>
        <p id="stats">Statistiques</p>
		<p id="qcm">Note moyenne du Qcm numero</p>
		<div class="jauge"></div>
		<div class="jaugeverte"></div>
		<p id="note"></p>
        </div>
	 
	</body>
	</html>
