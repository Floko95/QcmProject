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
 
    try{
		if(isset($_POST['iq'])){
        echo'<h1>Bonne chance</h1><p>';
		}
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
        
		
        echo '</p>'; 
        echo' <p>Attention: Il peut y avoir plusieurs réponses possibles.</p>';}
		if(isset($_POST['val'])){
			$date=time();		//enregistre la date de début du qcm pour le calcul ultérieur du temps
		}if(isset($_POST['temps'])){	//si on a deja récupéré la date, on la transmet par post pour la question suivante
			$date=$_POST['temps'];
		}
		
		
		if(isset($_POST['iq'])and trim($_POST['iq']!=' ')){	//si l'id du qcm est renseigné

			$n=0;
		    $nb_quest =$bdd->prepare("SELECT id_question FROM qcm_question where id_qcm=:idqcm");//nombre de questions dans le qcm
			$nb_quest->bindValue(':idqcm',$_POST['iq']);
			$nb_quest->execute();
			while($li=$nb_quest->fetch(PDO::FETCH_ASSOC)){
		      $n+=1;
	       }
		   
		   if(isset($_POST['tq'])){	//si on a deja repondu a une question
			   $tq=$_POST['tq']+1;	//numero de question + 1 
			}else{
				$tq=1;				//sinon, on est a la premiere question
			}
		   
			if($tq<=$n){
			 echo'<h2 div="n">Question <div id="nb_questions">'.$tq.'</div>/'.$n.'</h2>';//affichage du numéro de la question courante
			}
			
			
			if(isset($_POST['reponse'])){
				$_SESSION['cpt']++;
			if (is_array($_POST['reponse'])){
				foreach($_POST['reponse'] as $c=>$v){	
					if(isset($_SESSION['reponse'])){
						array_push($_SESSION['reponse'],$v);
					}else{
						$_SESSION['reponse'][]=$v;
					}
				}
			}
			}
			
			$req=$bdd->prepare("SELECT * FROM qcm_question natural join question where id_qcm=:idqcm");//affichage de la question et de l'explication qui va avec
			$req->bindValue(':idqcm',$_POST['iq']);
			$req->execute();
			$compteur=0;
			while($ligne=$req->fetch(PDO::FETCH_ASSOC)){	//tant qu'il y a des questions 
				$time=$ligne['temps'];
				echo '<div id="seconde" style="display:none">'.$time.'</div>';
				$compteur++;	//compte le nombre de questions
				if($compteur==$_SESSION['cpt']){										//si on a répondu a la question précédente 
					echo'<h2 id="t">Temps : <div id="temps_total">'.$time.'</div> secondes.</h2>';
					
					echo'<div id="bar"><div id="bar_inside"></div></div>';
					
					echo "<div class=\"form-group\"><label class=\"control-label\" for=\"select\">";
					echo ''.htmlspecialchars($ligne['question'],ENT_QUOTES).'</br>';	//affichage question
					if($ligne['explication']!=null){             						//si il y a une explication, elle s'affiche
						echo ''.htmlspecialchars($ligne['explication'],ENT_QUOTES).'</br>';
					}
					echo "</label><i class=\"bar\"></i></div> ";//ligne de démarquation avant la question
			
					$req2=$bdd->prepare("SELECT * FROM reponse natural join question natural join qcm_question where id_qcm=:idqcm and id_question=:numeroquest");     //affichage des réponses pour chaque question
					$req2->bindValue(':idqcm',$_POST['iq']);
					$req2->bindValue(':numeroquest',$ligne['id_question']);
					$req2->execute();
					echo'</br>';
	
					echo '<form id="formulaire" action="Executer.php" method="post">';    //passer d'une question a une autre
					echo '<input type="hidden" name="iq" value="'.$_POST['iq'].'"/>';
					echo '<input type="hidden" name="temps" value="'.$date.'"/>';
					echo '<input type="hidden" name="tq" value="'.$tq.'"/>';
					
					while($l=$req2->fetch(PDO::FETCH_ASSOC)){      //les réponses sont sous forme de cases pouvant être cochées
						echo'<div class="checkbox"><label>';
						echo'<input type="checkbox" name="reponse[]" value="'.$l['id_reponse'].'"/><i class="helper"></i>'.htmlspecialchars($l['reponse'],ENT_QUOTES);
						echo '</div></label>';
					}
					echo '<div class="button-container">
						<button class="button" id="bute" type="submit" name="checkboxes"><span>Valider question</span></button>
						</div>';
					echo'</form>';
				}
			}
				if($_SESSION['cpt']>$compteur){		//si on a répondu a toutes les questions, affichage du formulaire vers Statistique
					echo'<form action="Statistique.php" id="formS" method="post">            
						<div class="button-container">
						<input type="hidden" name="qcm" id="formSqcm" value="'.$_POST['iq'].'"/>
						<input type="hidden" name="temps" id="formStemps" value="'.$date.'"/>
						<button class="button" id="buts" type="submit" name="checkboxes"><span>Submit</span></button>
						</div>
						</form>';
				}
				
				$resp=array(0=>array(0=>0));
				echo'<div id="monpost" style="display: none">'.$_POST['iq'].'</div>';//obligatoire pour la redirection 
				echo'<div id="madate" style="display: none">'.$date.'</div>';//obligatoire pour la redirection
				echo'<div id="mareponse" style="display: none">'.$resp[0][0].'</div>';//obligatoire pour la redirection

		   ?>
		  
	<script>
        $(function(){	//se lance a chaque question
			$('#bar').css('width',$('#seconde').text()*10);
			wi=0;
			window.setInterval(function(){ 
				var timeCounter = $('#temps_total').html();	//récupère le temps de la question
                var updateTime = eval(timeCounter)- eval(1);	//temps-1
                $("#temps_total").text(updateTime);	//change le temps dans le html
				if(updateTime === 0){		//si le temps est à 0
					var monform=$('#monpost').text();	//on récupère l'id du qcm
					var madate=$('#madate').text();		//on récupère le temps total du qcm
					var montq=$('#nb_questions').text();		//on récupère le nombre de questions du qcm
					var mareponse=$('#mareponse').text();
					var redirect = function(redirectUrl) {	//puis on redirige automatiquement vers Statistique (fonction)
						var form = $('<form action="' + redirectUrl + '" method="post">' +	
									"<input type='hidden' name='iq' value="+monform+" />" +
									"<input type='hidden' name='temps' value="+madate+" />" +
									"<input type='hidden' name='tq' value="+montq+" />" +
									"<input type='hidden' name='reponse' value="+mareponse+"/>" +
									'</form>');
						$('body').append(form);// on ajoute le formulaire créé à la page
						$(form).submit();	//puis on le soumet directement
					};	
					redirect('Executer.php');//appel de fonction de redirection
				}
		
				jQuery(function($){
					var timeCounter = parseInt($('#temps_total').text());	//récupère le temps de la question
					console.log($('#bar').width());
					var wi=$('#bar').width()
					$('#bar_inside').animate({
						width: wi
					},$('#bar').width()*100-1000, 'linear');
				});
			}, 1000);
		});
	</script>

	<?php
		
        }else{//si on revient de statistique ou si on rencontre un bug etrange
			
			echo "<div class='button-container'>Vous ne devriez pas vous trouver ici.\n</div>";
			echo '<div class="button-container"><a href="ChoixRD.php"><button class="button" type="submit"><span>QCM</span></button></a></div></div>';

		}		
    }catch(PDOException $e){
	   echo'Exception reçue : ',$e->getMessage(),'\n';
	}
?>

</div>	
</body>
</html>
