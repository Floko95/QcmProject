<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
		 <link rel="stylesheet" href="SupprimerQCM.css" />
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
        
        
        
        <?php 
session_start();
require_once('Connexionbdd.php');
if (isset($_POST['supp']) and trim($_POST['supp']!=''))//bouton supprimer pressé
{?>

<div class="blanket"></div>
<div class="square">
  <div class="main">
    <span class='fa fa-trash'><img src="http://img11.hostingpics.net/pics/229674delete24.png"></span>
    <strong>SUPPRIMER</strong>
    
    <?php echo ' <p>Suppression du QCM numéro '.$_POST['id'].'?</p>'; ?>
    
  </div>
    
   <?php echo ' <form action="SupprimerQCM.php" method="post"><input type="hidden" name="id" value="'.$_POST['id'].'" />' ?>
    
  <div class="inner-square left">
    <span class='fa fa-check'><img src="http://img11.hostingpics.net/pics/124460checkmark24.png"></span>
      <input type="submit" name="suppc"/>
  </div>
  <div class="inner-square right">
    <span class='fa fa-remove'><input type="submit" name="suppn"/><img src="http://img11.hostingpics.net/pics/218305xmark24.png"></span>
      
  </div>
</div>
        
        
       <?php }
elseif(isset($_POST['suppc']))
{
	
	$req=$bdd->prepare("DELETE  FROM public.qcm_question WHERE id_qcm=:id");
	$req->bindValue(':id',$_POST['id']);
	$req->execute();
	$req=$bdd->prepare("DELETE  FROM public.qcm WHERE public.qcm.id_qcm=:id");
	$req->bindValue(':id',$_POST['id']);
	$req->execute();
	echo ' <p> Le questionnaire numéro '.$_POST['id']. ' a été supprimé.</p><br/><a href=Profil.php>Retour au profil</a>';
}
elseif(isset($_POST['suppn']))
{
	header('Location: Profil.php');
}

?>

  
    </body>
	</html>