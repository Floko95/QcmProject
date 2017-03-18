<html>
    <head>
	<meta charset="utf-8" />
    <link rel="stylesheet" href="ChoixRDS.css" />
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,600' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=PT+Sans+Narrow" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300" rel="stylesheet">
    <title>Choix Sous Domaine</title>
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
            <h2 class="rela-block top-main-text">Choisir Sous-Domaine</h2>
            <p><?php if(isset($_POST['nd'])){echo 'Domaine : '.$_POST['nd'];}?></p>
            </div>
        </div>   
      </div>

      <div class="rela-block image-grid-container">
      
<?php 
	require_once('../Autres/Connexionbdd.php');

	if(isset($_POST['idd'])and trim($_POST['idd']!=' ') and isset($_POST['nd'])and trim($_POST['nd']!=' ')){ 	
        //si on vient de la page ChoixRD
        
        try{
			
			$req=$bdd->prepare("SELECT sous_domaine FROM sous_domaine natural join domaine where id_domaine=:id");		
            //selection des sous-domaines liés au domaine choisi
            $req->bindValue(':id',$_POST['idd']);
			$req->execute();
			$tour=-1;										
            //variable qui sert à determiner si le domaine contient des sous-domaines
			while($ligne=$req->fetch(PDO::FETCH_ASSOC)){	
            //pour chaque sous-domaine, un formulaire permet de passer à la page de choix des QCM, ChoixRQI.
			
				$tour+=1;											
                //si on entre dans la boucle, il y a des sous-domaines, donc $tour s'incrémente
				echo "<div class=\"box\"><div class=\"floded\">"; 
				echo '<p><form action="ChoixRQI.php" method="post">
					<input type="hidden" name="idsd" value="'.$ligne['sous_domaine'].'"/>
					<input type="hidden" name="nd" value="'.$_POST['nd'].'"/>
					<h4><input type="submit" value="'.$ligne['sous_domaine'].'"	/><h4></form></p>';
				    echo "</div></div>";	
			
			}
            
            if ($tour==-1){										//si tour n'a pas été incrémenté, il n'y a pas de sous-domaines
				echo "</br></h3>Ce domaine ne contient pas de sous-domaine</h3></br>";	//affichage d'un message d'information
			}
    
			$req=$bdd->prepare("SELECT distinct id_qcm,auteur,description FROM qcm natural join qcm_question where qcm.domaine=:nd and qcm.sous_domaine is null and qcm.id_qcm=qcm_question.id_qcm and visible=true");
			$req->bindValue(':nd',$_POST['nd']);
			$req->execute();
			while($l=$req->fetch(PDO::FETCH_ASSOC)){		
            //affichage des qcm sans sous domaine, avec un formulaire qui conduit sur la page d'execution du QCM choisi, Executer.php
				
				$executer=1;
				echo "<div class=\"box\"><div class=\"floded\">";
				echo '<p><form action="Executer.php" method="post">
					<input type="hidden" name="iq" value="'.$l['id_qcm'].'"/>
					<input type="hidden" name="nd" value="'.$_POST['nd'].'"/>
					<input type="hidden" name="idsd" value="Aucun"/>
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
   
        }catch(PDOException $e){
			die('<p>Votre requête est erronée.</p>');
		}	
	}	
?>
    
      </div>
      <div class="rela-block button black-text load-button"><a href="" onClick="javascript:window.history.go(-1)">Retour</a></div>
	
</body>
</html>
