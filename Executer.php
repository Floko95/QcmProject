<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
		 <link rel="stylesheet" href="E.css" />
        <title></title>
		 
    </head>
    <body>
		
<div class="container">

<?php 
 
require_once('Connexionbdd.php');

if (isset($_POST['executer']) and $_POST['executer']==1){		//si on arrive de la page CHoixRQI et pas de la page Statistique

try{
 echo'<h1>Bonne chance</h1><p>';
    include('EviteMessageFormulaire.php'); 
        
        if(isset($_POST['nd'])){
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

	$temps=$bdd->prepare("SELECT temps FROM qcm_question natural join question where id_qcm=:idqcm");	//calcule le temps total du qcm
	$temps->bindValue(':idqcm',$_POST['iq']);
	$temps->execute();
	$t=0;
	while($ligne=$temps->fetch(PDO::FETCH_ASSOC)){
		$t+=$ligne['temps'];
	}
	echo'<h2>Temps total : '.$t.' secondes.</h2>';



	$req=$bdd->prepare("SELECT * FROM qcm_question natural join question where id_qcm=:idqcm");//affichage de la question et de l'explication qui va avec
	$req->bindValue(':idqcm',$_POST['iq']);
	$req->execute();
	
	while($ligne=$req->fetch(PDO::FETCH_ASSOC)){
        
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
	echo '<form action="Statistique.php" method="post">';              //enregistre les données du qcm pour Statisiques 
		echo '<input type="hidden" name="qcm" value="'.$ligne['id_qcm'].'"/>';
		echo '<input type="hidden" name="temps" value="'.$date.'"/>';
	while($l=$req2->fetch(PDO::FETCH_ASSOC)){      //les réponses sont sont forme de cases pouvant être cochées
			
            echo'<div class="checkbox"><label>';
			echo'<input type="checkbox" name="reponse[]" value="'.$l['id_reponse'].'"/><i class="helper"></i>'.htmlspecialchars($l['reponse'],ENT_QUOTES).'</br>';
			echo '</div></label>';
			
		}
		
		echo'</br>';
		}
		
		
		echo '<div class="button-container">
    <button class="button" type="submit" name="checkboxes"><span>Submit</span></button>
  </div>';
		echo'</form>';
		

		
}		
}catch(PDOException $e){
	echo'Exception reçue : ',$e->getMessage(),'\n';
}	
$_POST['executer']=0;
}else{
	echo '<h3>Vous ne pouvez pas revenir sur un QCM.</h3>';
	 echo '<div class="button-container">
    <a href="AccueilR.php"><button class="button" type="submit"><span>Accueil</span></button></a></div>';
    

}
?>
</div>


	
	</body>
	</html>
