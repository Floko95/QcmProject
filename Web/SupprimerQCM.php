<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
		 <link rel="stylesheet" href="SupprimerQCM.css" />
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" />
        <link href="https://fonts.googleapis.com/css?family=PT+Sans+Narrow" rel="stylesheet">
        <title>Supprimer</title>
    </head>
    <body>
  
        
        <?php session_start();
        require_once('Connexionbdd.php');
        
        if (isset($_POST['supp']) and trim($_POST['supp']!='')){//bouton supprimer pressé
        ?>

<!-- 1ere Partie Option Oui/Non -->
        
<div class="blanket"></div>
    <div class="square">
        <div class="main">
        <span class='fa fa-trash'><img src="http://img11.hostingpics.net/pics/229674delete24.png"></span>
        <strong>SUPPRIMER</strong>
        <?php echo ' <p>Suppression du QCM numéro '.$_POST['id'].'?</p>'; //on propose la suppression du qcm?>
        </div>
    
        <?php echo ' <form action="SupprimerQCM.php" method="post"><input type="hidden" name="id" value="'.$_POST['id'].'" />' ?>
            <div class="inner-square left">
                <button type="submit" name="suppc" class ="green"><img src="http://img11.hostingpics.net/pics/124460checkmark24.png"></button></div>
            <div class="inner-square right">
                <button type="submit" name="suppn" class="red"> <img src="http://img11.hostingpics.net/pics/218305xmark24.png"></button></div>
    </div>
        
<!-- END 1ere Partie-->
        
       <?php }
        elseif(isset($_POST['suppc'])){
	
	       $req=$bdd->prepare("DELETE  FROM public.qcm_question WHERE id_qcm=:id");//on le supprime de la table si on a choisi oui
	       $req->bindValue(':id',$_POST['id']);
	       $req->execute();
	       $req=$bdd->prepare("DELETE  FROM public.qcm WHERE public.qcm.id_qcm=:id");
	       $req->bindValue(':id',$_POST['id']);
	       $req->execute();
        ?>
        
<!-- 2eme Partie Message de confirmation -->
        
<div class="background"></div>
    <div class="centre">
    <div class="container">
		<div class="row">
				<div class="modalbox success col-sm-8 col-md-6 col-lg-5 center animate">
						<div class="icon"><span class="glyphicon glyphicon-ok"></span></div>
						<h1>Success!</h1>
                        <?php 
                        echo '<p>Le questionnaire numéro '.$_POST['id']. ' a été supprimé. </p>';
                        echo '<a href=Profil.php><button type="button" class="redo btn"> Retour au profil</button></a>';//on reoturne au profil s'il a été supprimé
					   ?>
				</div>
        </div>
    </div>
    </div>
        

<!-- END 2eme Partie-->

<?php

        }elseif(isset($_POST['suppn'])){//si on a changé d'avis on retourne au profil
            header('Location: Profil.php');
        }   

?>

  
    </body>
	</html>