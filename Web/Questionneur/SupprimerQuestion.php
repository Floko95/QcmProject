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
        require_once('../Autres/Connexionbdd.php');
        
		
        if (isset($_POST['sup']) and trim($_POST['sup']!='') ){//bouton supprimer pressé
		echo 'here';
		$id_quest=0;
		$req2=$bdd->prepare("select id_question FROM question natural join qcm natural join qcm_question where id_qcm=:idqcm and question=:quest"); //affichage des réponses 
				$req2->bindValue(':idqcm',$_POST['idqcm']);
				$req2->bindValue(':quest',$_POST['qsup']);
				$req2->execute();
			while($l=$req2->fetch(PDO::FETCH_ASSOC)){
				$id_quest=$l['id_question'];
			}
        ?>

<!-- 1ere Partie Option Oui/Non -->
        
<div class="blanket"></div>
    <div class="square">
        <div class="main">
        <span class='fa fa-trash'><img src="http://img11.hostingpics.net/pics/229674delete24.png"></span>
        <strong>SUPPRIMER</strong>
        <?php 
			$solitaire='';
		$req2=$bdd->prepare("select count (id_question) as nbequest from qcm_question WHERE id_question=:id");//on le supprime de la table si on a choisi oui
	       $req2->bindValue(':id',$id_quest);
	       $req2->execute();
		   while($l=$req2->fetch(PDO::FETCH_ASSOC)){
			$nombrequest=$l['nbequest'];
			}
		
		   if($nombrequest==1){	
		  $solitaire='Une fois supprimée, vous ne pourrez plus utiliser votre question.';
		   }
		    
		   
		  // }
		   
		   echo '<p> Suppression de la question numéro '.$id_quest.'? '.$solitaire.'</p>'; //on propose la suppression du qcm
		
		?>
        </div>
    
        <?php echo ' <form action="SupprimerQuestion.php" method="post">
		<input type="hidden" name="idqcm" value="'.$_POST['idqcm'].'" />
				<input type="hidden" name="qsup" value="'.$id_quest.'"/>
				<input type="hidden" name="solitaire" value="'.$solitaire.'"/>';
								?>
            <div class="inner-square left">
                <button type="submit" name="suppc" class ="green"><img src="http://img11.hostingpics.net/pics/124460checkmark24.png"></button></div>
            <div class="inner-square right">
                <button type="submit" name="suppn" class="red"> <img src="http://img11.hostingpics.net/pics/218305xmark24.png"></button></div>
    </div>
        
<!-- END 1ere Partie-->
        
       <?php }
        elseif(isset($_POST['suppc'])){
	
	       $req=$bdd->prepare("DELETE FROM qcm_question WHERE id_qcm=:id and id_question=:idquest");//on le supprime de la table si on a choisi oui
	       $req->bindValue(':id',$_POST['idqcm']);
		   $req->bindValue(':idquest',$_POST['qsup']);
	       $req->execute();
		   
		   if($_POST['solitaire']!=''){
			   
		   $req1=$bdd->prepare("DELETE FROM reponse WHERE id_question=:idquest");//on le supprime de la table si on a choisi oui
		   $req1->bindValue(':idquest',$_POST['qsup']);
	       $req1->execute();
		   
		   $req=$bdd->prepare("DELETE FROM question WHERE id_question=:idquest");//on le supprime de la table si on a choisi oui
		   $req->bindValue(':idquest',$_POST['qsup']);
	       $req->execute();
		   }
		   
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
                        echo '<p>La question '.$_POST['qsup']. ' a été supprimée. </p>';
						echo ' <form action="Questions.php" method="post">
					<input type="hidden" name="id" value="'.$_POST['idqcm'].'" />
				<input type="hidden" name="modif" value=1/>
				<button type="submit"><span>Continuer la gestion des qcm</span></button>';
	
					   ?>
				</div>
        </div>
    </div>
    </div>
        

<!-- END 2eme Partie-->

<?php

        }elseif(isset($_POST['suppn'])){//si on a changé d'avis on retourne au profil
           
?>
		   <div class="background"></div>
    <div class="centre">
    <div class="container">
		<div class="row">
				<div class="modalbox success col-sm-8 col-md-6 col-lg-5 center animate">
						<div class="icon"><span class="glyphicon glyphicon-ok"></span></div>
						<h1>Retour</h1>
                        <?php 
         
						echo ' <form action="Questions.php" method="post">
					<input type="hidden" name="id" value="'.$_POST['idqcm'].'" />
				<input type="hidden" name="modif" value=1/>
								<button type="submit"><span>Continuer la gestion des qcm</span></button>';
					   ?>
				</div>
        </div>
    </div>
    </div>
     <?php   }   

?>

  
    </body>
	</html>
