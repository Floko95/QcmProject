<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
		 <link rel="stylesheet" href="ProfilR.css" />
        <link href="https://fonts.googleapis.com/css?family=PT+Sans+Narrow" rel="stylesheet">
        <title></title>
    </head>
    <body>
    
        
        <div id="desk-nav">
  <nav>
    <ul>
      <li><a href="AccueilR.php">Home</a></li>
      <li><a href="ProfilR.php">Profil</a></li>
      <li><a href="ChoixRD.php">QCM</a></li>
      <li><a href="../Autres/Index.php">Déconnexion</a></li>
    </ul>
  </nav>
</div>
        
        
        <?php 
session_start();
require_once('../Autres/Connexionbdd.php');
?>
        
        
    <div class="fond">
<div class="bloc">
    
	<div class="top-bar">
		<div class="pull-left">
			<a href="#" class="menu-tgl pull-left"><i class="fa fa-bars"></i></a>
		</div>
		<span class="title">Profil</span>
		<div class="pull-right">
			<a href="#" class="search-tgl pull-left"><i class="fa fa-search"></i></a>
			<a href="#" class="option-tgl pull-left"><i class="fa fa-ellipsis-v"></i></a>
		</div>
	</div>
	<div class="profil">
		<div class="cover">
			<span class="vec vec_a"></span>
			<span class="vec vec_b"></span>
			<span class="vec vec_c"></span>
			<span class="vec vec_d"></span>
			<span class="vec vec_e"></span>
		</div>
		
        <div class="photo"><img src="http://icons.iconarchive.com/icons/webalys/kameleon.pics/512/Alien-icon.png"></div>
        <div class="info"><?php echo '<div class="name">'.$_SESSION['user'].'</div>';?></div>
        <label for="retour" class="retour"><a href="" onClick="javascript:window.history.go(-1)"><img src="http://img15.hostingpics.net/pics/571733arrow8724.png"></a></label>

	</div>
 
   
    
 <?php 

		$repondeur=0;															//contiendra l'id du repondeur
		$trouveid=$bdd->prepare('select id_repondeur from repondeur where nom_repondeur=:n');	//trouve  l'id du repondeur avec son nom
		$trouveid->bindValue(':n',$_SESSION['user']);								
		$trouveid->execute();
		while($l=$trouveid->fetch(PDO::FETCH_ASSOC)){								
			$repondeur=$l['id_repondeur'];										//$repondeur contient maintenant l'id rep
		}
		

		$nbqcm=$bdd->prepare("SELECT count(id_qcm) as somme FROM recap_repondeur WHERE id_repondeur = :repondeur");  //compte le nombre de qcm faits
		$nbqcm->bindValue(':repondeur', $repondeur);
		$nbqcm->execute();
			while($ligne=$nbqcm->fetch(PDO::FETCH_ASSOC)){
				$nombreqcm=$ligne['somme'];																
			}
		

		$tpsqcm=$bdd->prepare("SELECT sum(temps_qcm) as sum FROM recap_repondeur WHERE id_repondeur = :repondeur");  //compte le temps total des qcm faits
		$tpsqcm->bindValue(':repondeur', $repondeur);
		$tpsqcm->execute();
			while($ligne=$tpsqcm->fetch(PDO::FETCH_ASSOC)){
				$tempsqcm=$ligne['sum'];																
			}
			
		
	
		
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
    
            echo '<div class="tabs clearfix"> <a href="#">';
            echo 'Temps Total: '.$l['temps_total'];    
            echo '</a><a href="#">';
            echo 'Nombre QCM:'.$l['nb_qcm_fait'];
            echo '</a></div>';
        }
?>
        
	   <div class="tabs-content">
		<div class="liste">
<?php
	
    if(isset($_GET['d'])and trim ($_GET['d']!='') and isset($_GET['sd']) and trim ($_GET['sd']!='') ){	//après avoir cliqué sur un sous-domaine, on est sur la page où les qcm sont affichés 
	       
            echo '<div class="list title"> '.$_GET['d'].'</br>'.$_GET['sd'].'</div>';
            $statqcm=$bdd->prepare('SELECT * FROM recap_repondeur WHERE id_repondeur = :id_rep and sous_domaine=:sd');	//affiche les differents qcm et leurs statistiques
			$statqcm->bindValue(':id_rep',$repondeur);
			$statqcm->bindValue(':sd',$_GET['sd']);
			$statqcm->execute();
			while($l=$statqcm->fetch(PDO::FETCH_ASSOC)){ 											//affichage des stats des qcm du domaine/sdomaine courants 
	
				echo'<div class="list">	
                <div class="info pull-left">
                <div class="time">';		
              
                echo 'QCM n° '.$l['id_qcm'].' ';
                echo'</div>
                
				<div class="name">';
                echo $l['date_qcm_fait'];
                echo' </div>
                
                    
				    <div class="name">';

				echo 'Note '.$l['note_qcm'].'/20';
                echo'</div><div class="name">';
                echo 'Temps '.$l['temps_qcm'].' sec.';
        
                echo'</div></div>';
            }

                      
    }else if(isset($_GET['d'])and trim ($_GET['d']!='') and !isset($_GET['sd'])){	 //après avoir cliqué sur un domaine, on est sur la page où les sous-domaines sont affichés 
	

			
			$nomdom=$bdd->prepare('SELECT domaine FROM domaine WHERE id_domaine= :d');				//récupère le nom du domaine courant 
			$nomdom->bindValue(':d',$_GET['d']);													
			$nomdom->execute();
			while($l=$nomdom->fetch(PDO::FETCH_ASSOC)){
				echo '<div class="list title">'.$l['domaine'].': ';									//affichage du domaine dans lequel on est
			}
            
            $moy=$bdd->prepare("SELECT round(avg(note_qcm)::numeric,2) as round FROM recap_repondeur natural join domaine WHERE id_repondeur = :repondeur and id_domaine=:d");
			$moy->bindValue(':d',$_GET['d']);
			$moy->bindValue(':repondeur', $repondeur);
			$moy->execute();
			while($ligne=$moy->fetch(PDO::FETCH_ASSOC)){
				$moyenne = $ligne['round'];																//contient la moyenne du domaine dans lequel on est
			}
			
			$moyenne=round($moyenne,2);
			
			$insertm =$bdd->prepare ('UPDATE repondeur SET moyenne = :m WHERE id_repondeur = :id');		//enregistre la moyenne dans la table du repondeur
			$insertm->bindValue(':id',$repondeur);
			$insertm->bindValue(':m',$moyenne);
			$insertm->execute();
            
            
			echo 'Moyenne - '.$moyenne; 																				//affiche la moyenne 
			echo'</div>';
            
            
        $ssdom=$bdd->prepare("SELECT distinct domaine,sous_domaine FROM recap_repondeur natural join sous_domaine natural join domaine where id_domaine=:d and id_repondeur=:id_rep"); //affichage des sous-doamines du domaine courant
		$ssdom->bindValue(':d',$_GET['d']);
		$ssdom->bindValue(':id_rep',$repondeur);
		$ssdom->execute();
		while($ligne=$ssdom->fetch(PDO::FETCH_ASSOC)){
            
            echo'<div class="list">	
            <div class="info pull-left">
            <div class="name">';
		    echo '<a href="ProfilR.php?d='.$ligne['domaine'].'&sd='.$ligne['sous_domaine'].'"class="nostyle">'.$ligne['sous_domaine'].'</a>';
            echo'</div></div></div>';
        }
	
        
    $qcmnull=$bdd->prepare("SELECT * FROM recap_repondeur natural join domaine WHERE id_repondeur=:id_rep and id_domaine=:d and sous_domaine is null");		//affichage des qcm sans sous-domaine et de leurs stats
		$qcmnull->bindValue(':d',$_GET['d']);
		$qcmnull->bindValue(':id_rep',$repondeur);
		$qcmnull->execute();
		while($l=$qcmnull->fetch(PDO::FETCH_ASSOC)){
            
            echo'<div class="list">	
            <div class="info pull-left">
            <div class="name">';		
              
                echo 'QCM n° '.$l['id_qcm'].' ';
                echo'</div>
                
				<div class="time">';
                echo $l['date_qcm_fait'];
                echo' </div></div>
                
                    <div class="action pull-right">
				    <div class="name">';

				echo 'Note '.$l['note_qcm'].'/20';
                echo'</div><div class="time">';
                echo 'Temps '.$l['temps_qcm'].' sec.';
        
                echo'</div></div></div>';
            
            
        }
            
            }else{	//première page
															 
		echo '<div class="list title">Récapitulatif</div>';            //si on est sur la premiere page, affichage de 'domaines'
	
	
		$dom=$bdd->prepare('SELECT distinct id_domaine,domaine FROM domaine natural join recap_repondeur where id_repondeur = :id_rep ');   //si on n'a pas encore cliqué sur un domaine, affichage des domaines où le répondeur a effectué des qcm
		$dom->bindValue(':id_rep',$repondeur);
		$dom->execute();
		while($li=$dom->fetch(PDO::FETCH_ASSOC)){
           
                 
		echo'<div class="list">	
        <div class="info pull-left">
        <div class="name">';
              echo '<a href="ProfilR.php?d=' .$li['id_domaine'].'" class="nostyle"> '.$li['domaine'].'</a>';
                
                echo'</div></div></div>';
	
}
    }
                                
        ?>        
	
			</div>
		</div>
	</div>
</div>

    
    
    </body>
	</html>
