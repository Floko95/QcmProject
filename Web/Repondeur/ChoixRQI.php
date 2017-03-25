<html>
    <head>
	<meta charset="utf-8" />
    <link rel="stylesheet" href="ChoixRQI.css" />
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,600' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=PT+Sans+Narrow" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300" rel="stylesheet">
    <title>Choix QCM</title>
    </head>
  <body>

	
    <div id="desk-nav">
  <nav>
    <ul>
      <li><a href="AccueilR.php">Home</a></li>
      <li><a href="ProfilR.php">Profil</a></li>
      <li><a href="ChoixRD.php">QCM</a></li>
      <li><a href="../Index.php">Déconnexion</a></li>
    </ul>
  </nav>
</div>
      

      <div class="rela-block top-container">
        <div class="rela-block top-center-container">
            <div class="inner-container top-text-container">
            <h2 class="rela-block top-main-text">Choisir QCM</h2>
            <p><?php 	include('EviteMessageFormulaire.php');				//évite le message d'erreur de remplissage du formulaire 
			if(isset($_POST['nd'])){
                echo 'Domaine : '.$_POST['nd'];                             //affichage du domaine
            }		
            echo '</br>';
			if(isset($_POST['idsd'])){
				echo 'Sous-domaine : '.$_POST['idsd'];						//affichage du sous domaine 
            }
			?></p>
            </div>
        </div>
      </div>
	  
      <div class="rela-block image-grid-container">
    
    
<?php 
	require_once('../Autres/Connexionbdd.php');
	
	try{
		if(isset($_POST['idsd'])and trim($_POST['idsd']!=' ')){		//si le sous domaine est renseigné
			
			$req=$bdd->prepare("SELECT distinct id_qcm,auteur,description FROM qcm natural join qcm_question where qcm.sous_domaine=:idsd and qcm.id_qcm=qcm_question.id_qcm and visible=true");
			$req->bindValue(':idsd',$_POST['idsd']);
			$req->execute();
			$tour=0;										//variable qui sert à determiner si le sous-domaine contient des qcm
			while($l=$req->fetch(PDO::FETCH_ASSOC)){		
				
				echo "<div class=\"box\"><div class=\"floded\">";
				$executer=1;
				$tour+=1;															//si on entre dans la boucle, il y a des qcm, donc $tour s'incrémente
				echo '<p><form action="Executer.php" method="post">
					<input type="hidden" name="iq" value="'.$l['id_qcm'].'"/>
					<input type="hidden" name="nd" value="'.$_POST['nd'].'"/>
					<input type="hidden" name="idsd" value="'.$_POST['idsd'].'"/>
					<input type="hidden" name="val" value="1"/>
					<input type="hidden" name="executer" value="'.$executer.'"/>
					<h4><input type="submit" value="QCM N°'.$l['id_qcm'].' créé par '.$l['auteur'].'"/><h4></form></p>';
				echo "</div>";
				//-----------------------------------------------
				echo"<div>";
				echo '<FONT size="1pt"><p>'.$l['description'].'</p></FONT>';
				echo "</div>";
				//-----------------------------------------
				echo "</div>";
			
			}
  
			if ($tour==0){	//si tour n'a pas été incrémenté, il n'y a pas de qcm dans le sous-domaine
				echo "<h3>Ce sous-domaine ne contient pas de QCM</h3>";
			}
		}
		
	}catch(PDOException $e){
		die('<p>Votre requête est erronée.</p>');
	}
?>
    
      </div>
      <div class="rela-block button black-text load-button"><a href="" onClick="javascript:window.history.go(-1)">Retour</a></div>

</body>
</html>
