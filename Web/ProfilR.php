<!DOCTYPE html>

<html>
  <head>
		
      	 <link rel="stylesheet" href="ProfilR.css" />
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
      <link href="https://fonts.googleapis.com/css?family=PT+Sans+Narrow" rel="stylesheet">
	</head>
	<body>
        
            <?php 
session_start();
require_once('Connexionbdd.php');
?>
        
             <div id="desk-nav">
  <nav>
    <ul>
      <li><a href="AccueilR.php">Home</a></li>
      <li><a href="ProfilR.php">Profil</a></li>
      <li><a href="ChoixRD.php">QCM</a></li>
      <li><a href="Index.php">Déconnexion</a></li>
    </ul>
  </nav>
</div>
        
        
        
        
		<div class="portfoliocard">
		<div class="coverphoto"></div>
		<div class="profile_picture"></div>
		<div class="left_col">
            
            
            
                <div class="following">
				<div class="follow_count"> <?php  echo '<div class="name">'.$_SESSION['user'].'</div>';?></div></div>
            
	<?php 

		$repondeur=0;															//contiendra l'id du repondeur
		$trouveid=$bdd->prepare('select * from repondeur where nom_repondeur=:n');	//trouve  l'id du repondeur avec son nom
		$trouveid->bindValue(':n',$_SESSION['user']);								
		$trouveid->execute();
		while($l=$trouveid->fetch(PDO::FETCH_ASSOC)){								
			$repondeur=$l['id_repondeur'];										//$repondeur contient maintenant l'id rep
		}
		
		if(isset($_GET['d']) and trim($_GET['d']!='') and !isset($_GET['sd'])){	//après avoir cliqué sur un domaine, on est sur la page où les sous-domaines sont affichés 
			
			$d=$_GET['d'];														//variable pour utilisation de l'id du domaine dans la requete pour calculer le moyenne
			$moy=$bdd->query("SELECT round(avg(note_qcm)::numeric,2) as round FROM recap_repondeur natural join domaine WHERE id_repondeur = $repondeur and id_domaine=$d");
			$t=$moy->fetch();
			$moy->closeCursor();
			$moyenne=$t['round'];													//contient la moyenne du domaine dans lequel on est
            
			$insertm =$bdd->prepare ('UPDATE repondeur SET moyenne = :m WHERE id_repondeur = :id');		//enregistre la moyenne dans la table du repondeur
			$insertm->bindValue(':id',$repondeur);
			$insertm->bindValue(':m',$moyenne);
			$insertm->execute();
            
            echo '<div class="followers">
				<div class="follow_count">'; 
			echo $moyenne; 																				//affiche la moyenne 
			echo ' </div>
				Moyenne Domaine
			</div>';
            
		}																						


		$nbqcm=$bdd->query("SELECT count(id_qcm) as somme FROM recap_repondeur WHERE id_repondeur = $repondeur");  //compte le nombre de qcm faits
		$n=$nbqcm->fetch();
		$nbqcm->closeCursor();
		$nombreqcm=$n['somme'];

		$tpsqcm=$bdd->query("SELECT sum(temps_qcm) as sum FROM recap_repondeur WHERE id_repondeur = $repondeur");  //compte le temps total des qcm faits
		$t=$tpsqcm->fetch();
		$tpsqcm->closeCursor();
		$tempsqcm=$t['sum'];

		$up1 =$bdd->prepare ('UPDATE repondeur SET nb_qcm_fait = :o WHERE id_repondeur = :id');						//enregistre le nouveau nbe de qcm faits dans la base 
		$up1->bindValue(':id',$repondeur);
		$up1->bindValue(':o',$nombreqcm);
		$up1->execute();

		$up3 =$bdd->prepare ('UPDATE repondeur SET temps_total = :th WHERE id_repondeur = :id');				 	//enregistre le nouveau  temps total dans la base
		$up3->bindValue(':id',$repondeur);
		$up3->bindValue(':th',$tempsqcm);
		$up3->execute();

		
		$statrep =$bdd->prepare ('Select nb_qcm_fait,temps_total from repondeur WHERE id_repondeur = :id');			//affichage des temps total et nbe de qcm faits
		$statrep->bindValue(':id',$repondeur);
		$statrep->execute();
		while($l=$statrep->fetch(PDO::FETCH_ASSOC)){
            
	?>
			<div class="following">
				<div class="follow_count"><?php echo $l['nb_qcm_fait'] ;?></div>
			Nombre Total</br>de QCM</div>
			
			<div class="following">
				<div class="follow_count"><?php echo $l['temps_total']; ?></div>
             Temps Total</div></div>
            
    <?php        
    
		} 
		
		echo '<div class="right_col"><h2 class="name">';

		if(isset($_GET['d'])and trim ($_GET['d']!='') and !isset($_GET['sd']) ){				//après avoir cliqué sur un domaine, on est sur la page où les sous-domaines sont affichés 
			
			$nomdom=$bdd->prepare('SELECT domaine FROM domaine WHERE id_domaine= :d');				//récupère le nom du domaine courant 
			$nomdom->bindValue(':d',$_GET['d']);													
			$nomdom->execute();
			while($l=$nomdom->fetch(PDO::FETCH_ASSOC)){
				echo $l['domaine'];																//affichage du domaine dans lequel on est
			}
		}


		if(!isset($_GET['d']) ){																//si on est sur la premiere page, affichage de 'domaines' 
			echo 'Domaines : ';
		}
		
		echo'</h2>';
		
		if(isset($_GET['d'])and trim ($_GET['d']!='') and isset($_GET['sd']) and trim ($_GET['sd']!='') ){	//après avoir cliqué sur un sous-domaine, on est sur la page où les qcm sont affichés 
			
			echo '<h2 class="name">'.$_GET['d'].'</br>'.$_GET['sd'].'</h2>';								//affichage des domaine et sous-domaine courants
		
			$statqcm=$bdd->prepare('SELECT * FROM recap_repondeur WHERE id_repondeur = :id_rep and sous_domaine=:sd');	//affiche les differents qcm et leurs statistiques
			$statqcm->bindValue(':id_rep',$repondeur);
			$statqcm->bindValue(':sd',$_GET['sd']);
			$statqcm->execute();
			while($l=$statqcm->fetch(PDO::FETCH_ASSOC)){															//affichage des stats des qcm du domaine/sdomaine courants
        
        ?>
				<ul class="contact_information">															
					<li class="website"><a class="nostyle" href="#"> 
					<?php 
						echo $l['domaine'].' '.$l['sous_domaine']; 
						echo $l['date_qcm_fait'];
						echo 'Note '.$l['note_qcm'].'/20';
						echo 'Temps '.$l['temps_qcm'].' sec.';
					?>
					</a></li>
				</ul>
            </div>
            
            
        <?php
			}
    
    
    }else if(isset($_GET['d'])and trim ($_GET['d']!='') and !isset($_GET['sd'])){	 //après avoir cliqué sur un domaine, on est sur la page où les sous-domaines sont affichés 
	
		$ssdom=$bdd->prepare("SELECT distinct domaine,sous_domaine FROM recap_repondeur natural join sous_domaine natural join domaine where id_domaine=:d and id_repondeur=:id_rep"); //affichage des sous-doamines du domaine courant
		$ssdom->bindValue(':d',$_GET['d']);
		$ssdom->bindValue(':id_rep',$repondeur);
		$ssdom->execute();
		while($ligne=$ssdom->fetch(PDO::FETCH_ASSOC)){
        
        ?>      
			<ul class="contact_information">
				<li class="website"> <?php echo '<a href="ProfilR.php?d='.$ligne['domaine'].'&sd='.$ligne['sous_domaine'].'"class="nostyle">'.$ligne['sous_domaine'].'</a>'; ?></li>
               
             
			</ul>
	  
            <?php
		}
    
		$qcmnull=$bdd->prepare("SELECT * FROM recap_repondeur natural join domaine WHERE id_repondeur=:id_rep and id_domaine=:d and sous_domaine is null");		//affichage des qcm sans sous-domaine et de leurs stats
		$qcmnull->bindValue(':d',$_GET['d']);
		$qcmnull->bindValue(':id_rep',$repondeur);
		$qcmnull->execute();
		while($l=$qcmnull->fetch(PDO::FETCH_ASSOC)){
            
               ?>
           
			<ul class="contact_information">
				<li class="website"><a class="nostyle" href="#">  <?php echo $l['domaine'].' '.$l['sous_domaine'];
				  echo $l['date_qcm_fait'];
					echo 'Note '.$l['note_qcm'].'/20';
					echo 'Temps '.$l['temps_qcm'].' sec.';
				
				?> </a></li>
             
			</ul>
		 
            <?php
		}
    
	}else{	 
	
		$dom=$bdd->prepare('SELECT distinct id_domaine,domaine FROM domaine natural join recap_repondeur where id_repondeur = :id_rep ');   //si on n'a pas encore cliqué sur un domaine, affichage des domaines où le répondeur a effectué des qcm
		$dom->bindValue(':id_rep',$repondeur);
		$dom->execute();
		while($li=$dom->fetch(PDO::FETCH_ASSOC)){
           ?>
          
			<ul class="contact_information">
				<li class="website"> <?php   echo '<a href="ProfilR.php?d=' .$li['id_domaine'].'" class="nostyle">'.$li['domaine'].'</a>'; ?> </li>
			</ul>
		
                 
            <?php
			}
		}

            
    ?>
        
        
         
		</div>
	</body>
</html>
