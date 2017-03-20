<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
		 <link rel="stylesheet" href="E.css" />
         <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,600' rel='stylesheet' type='text/css'>
         <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
         <link href="https://fonts.googleapis.com/css?family=PT+Sans+Narrow" rel="stylesheet">
         <link href="https://fonts.googleapis.com/css?family=Lato:100,300" rel="stylesheet">
		 <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<script src="Executer.js"></script>
        <title>Executer QCM</title>
    </head>
    <body>
		
<div class="container">

<?php 
require_once('../Autres/Connexionbdd.php');
include('EviteMessageFormulaire.php'); 
 
    //if (isset($_POST['executer']) and $_POST['executer']==1){		//si on arrive de la page CHoixRQI et pas de la page Statistique
    try{
        echo'<h1>Bonne chance</h1><p>';
  
        if(isset($_POST['nd'])){
			$_SESSION['cpt']=1;
			if(isset($_SESSION['reponse'])){
			unset($_SESSION['reponse']);
			}
            echo 'Domaine : '.$_POST['nd'];
        }
		
        echo '</br>';	
        if(isset($_POST['idsd'])){
            echo 'Sous-domaine : '.$_POST['idsd'];
        }
		
        echo '</br>'; 
        if(isset($_POST['iq'])){
            echo 'QCM n° '.$_POST['iq'];
        }
		
        echo '</p>'; 
        echo' <p>Attention: Il peut y avoir plusieurs réponses possibles.</p>';

		$date=time();		//enregistre la date de début du qcm pour le calcul ultérieur du temps
		if(isset($_POST['iq'])and trim($_POST['iq']!=' ')){	
           $temps=$bdd->prepare("SELECT temps FROM qcm_question natural join question where id_qcm=:idqcm");	
           //calcule le temps total du qcm
	       $temps->bindValue(':idqcm',$_POST['iq']);
	       $temps->execute();
	       $t=0;
	       while($ligne=$temps->fetch(PDO::FETCH_ASSOC)){
		      $t+=$ligne['temps'];
	       }
	       echo'<h2>Temps total : <div id="temps_total">'.$t.'</div> secondes.</h2>';
//////////////?>
<script>
        var settimmer=0;
        $(function(){
                window.setInterval(function() {
                    var timeCounter = $('#temps_total').html();
					console.log(timeCounter);
                    var updateTime = eval(timeCounter)- eval(1);
                    $("#temps_total").html(updateTime);

                    if(updateTime == 0){
						$("#formS").submit(function (e){//form désigne l'ensemble des formulaires
						console.log("entrer dans la fonction");
						//var cible=e.target;
						console.log("here");
					$.ajax({
					url: 'Statistique.php', // Le nom du fichier indiqué dans le formulaire
                datatype: 'POST', // La méthode indiquée dans le formulaire (get ou post)
                data: $("#formS").serialize(), // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
				success: function(result){
                //console.log("ajax !");
             }
		});
			console.log("here2");
	});
                    }
                }, 1000);

        });
    </script>

<?php

			if(isset($_POST['reponse'])){
				$_SESSION['cpt']++;
				foreach($_POST['reponse'] as $c=>$v){
					if(isset($_SESSION['reponse'])){
						array_push($_SESSION['reponse'],$v);
					}else{
						$_SESSION['reponse'][]=$v;
					}
				}
			}
			
			$req=$bdd->prepare("SELECT * FROM qcm_question natural join question where id_qcm=:idqcm");//affichage de la question et de l'explication qui va avec
			$req->bindValue(':idqcm',$_POST['iq']);
			$req->execute();
			$compteur=0;
			while($ligne=$req->fetch(PDO::FETCH_ASSOC)){
				$compteur++;
				if($compteur==$_SESSION['cpt']){
					echo "<div class=\"form-group\"><label class=\"control-label\" for=\"select\">";
					echo ''.htmlspecialchars($ligne['question'],ENT_QUOTES).'</br>';
					if($ligne['explication']!=null){                 //si il y a une explication, elle s'affiche
						echo ''.htmlspecialchars($ligne['explication'],ENT_QUOTES).'</br>';
					}
					echo "</label><i class=\"bar\"></i></div> ";
			
					$req2=$bdd->prepare("SELECT * FROM reponse natural join question natural join qcm_question where id_qcm=:idqcm and id_question=:numeroquest");     //affichage des réponses pour chaque question
					$req2->bindValue(':idqcm',$_POST['iq']);
					$req2->bindValue(':numeroquest',$ligne['id_question']);
					$req2->execute();
					echo'</br>';
	
					echo '<form id="formulaire" action="Executer.php" method="post">';              //enregistre les données du qcm pour Statisiques 
					echo '<input type="hidden" name="iq" value="'.$ligne['id_qcm'].'"/>';
					echo '<input type="hidden" name="temps" value="'.$date.'"/>';
					while($l=$req2->fetch(PDO::FETCH_ASSOC)){      //les réponses sont sous forme de cases pouvant être cochées
						echo'<div class="checkbox"><label>';
						echo'<input type="checkbox" name="reponse[]" value="'.$l['id_reponse'].'"/><i class="helper"></i>'.htmlspecialchars($l['reponse'],ENT_QUOTES);
						echo '</div></label>';
					}
				
					echo '<div class="button-container">
						<button class="button" type="submit" name="checkboxes"><span>Valider question</span></button>
						</div>';
					echo'</form>';
				}
		   }
		   if($_SESSION['cpt']>$compteur){//enregistre les données du qcm pour Statisiques
				echo'<form action="Statistique.php" id="formS" method="post">              
				<div class="button-container">
				<input type="hidden" name="qcm" id="formSqcm" value="'.$_POST['iq'].'"/>
				<input type="hidden" name="temps" id="formStemps" value="'.$date.'"/>
				<button class="button" type="submit" name="checkboxes"><span>Submit</span></button>
				</div>
				</form>';
			}
			$compteur=0;
		
		
        }		
    }catch(PDOException $e){
	   echo'Exception reçue : ',$e->getMessage(),'\n';
	}
    $_POST['executer']=0;
   /* }else{

	   echo '<p>Vous ne pouvez pas revenir sur un QCM.</p>';
	   echo '<div class="button-container">
        <a href="AccueilR.php"><button class="button" type="submit"><span>Accueil</span></button></a></div>';
    }*/
?>

</div>	
</body>
</html>
