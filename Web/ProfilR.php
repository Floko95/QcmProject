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

		$repondeur=0;
		$ins=$bdd->prepare('select * from repondeur where nom_repondeur=:n');
		$ins->bindValue(':n',$_SESSION['user']);
		$ins->execute();
		while($lu=$ins->fetch(PDO::FETCH_ASSOC)){
			$repondeur=$lu['id_repondeur'];
		}
		
		if(isset($_GET['d']) and trim($_GET['d']!='') and !isset($_GET['sd'])){
			$d=$_GET['d'];
			$req2 =$bdd->query("SELECT round(avg(note_qcm)::numeric,2) as round FROM recap_repondeur natural join domaine WHERE id_repondeur = $repondeur and id_domaine=$d");
			$t=$req2->fetch();
			$req2->closeCursor();
			$two=$t['round'];
            
			$up2 =$bdd->prepare ('UPDATE repondeur SET moyenne = :t WHERE id_repondeur = :id');
			$up2->bindValue(':id',$repondeur);
			$up2->bindValue(':t',$two);
			$up2->execute();
            
            echo '<div class="followers">
				<div class="follow_count">'; 
			echo $two; 
			echo ' </div>
				Moyenne Domaine
			</div>';
            
		}


		$req1 =$bdd->query("SELECT count(id_qcm) as somme FROM recap_repondeur WHERE id_repondeur = $repondeur");
		$o=$req1->fetch();
		$req1->closeCursor();
		$one=$o['somme'];

		$req3 =$bdd->query("SELECT sum(temps_qcm) as sum FROM recap_repondeur WHERE id_repondeur = $repondeur");
		$th=$req3->fetch();
		$req3->closeCursor();
		$three=$th['sum'];

		$up1 =$bdd->prepare ('UPDATE repondeur SET nb_qcm_fait = :o WHERE id_repondeur = :id');
$up1->bindValue(':id',$repondeur);
$up1->bindValue(':o',$one);
$up1->execute();

$up3 =$bdd->prepare ('UPDATE repondeur SET temps_total = :th WHERE id_repondeur = :id');
$up3->bindValue(':id',$repondeur);
$up3->bindValue(':th',$three);
$up3->execute();
	
$statrep =$bdd->prepare ('Select nb_qcm_fait,temps_total from repondeur WHERE id_repondeur = :id');
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

if(isset($_GET['d'])and trim ($_GET['d']!='') and !isset($_GET['sd']) ){
$d=$bdd->prepare('SELECT domaine FROM domaine WHERE id_domaine= :d');
$d->bindValue(':d',$_GET['d']);
$d->execute();
	while($l=$d->fetch(PDO::FETCH_ASSOC)){
	echo $l['domaine'];
	}
}

echo '</h2>';

if(!isset($_GET['d']) ){
	echo '<h2 class="name">Domaines : </h2>';
		
}

if(isset($_GET['d'])and trim ($_GET['d']!='') and isset($_GET['sd']) and trim ($_GET['sd']!='') ){
	
echo '
          
			<h2 class="name">'.$_GET['d'].'</br>'.$_GET['sd'].'</h2>';
		
	
$d=$bdd->prepare('SELECT * FROM recap_repondeur WHERE id_repondeur = :id_rep and sous_domaine=:sd');
$d->bindValue(':id_rep',$repondeur);
$d->bindValue(':sd',$_GET['sd']);
$d->execute();
	while($l=$d->fetch(PDO::FETCH_ASSOC)){
        
        ?>
           
			<ul class="contact_information">
				<li class="website"><a class="nostyle" href="#"> <?php 
				
					echo $l['domaine'].' '.$l['sous_domaine']; 
                    echo $l['date_qcm_fait'];
					echo 'Note '.$l['note_qcm'];
					echo 'Temps '.$l['temps_qcm'].' sec.';
       
             ?></a></li>
			</ul>
            </div>
            
            
            <?php
    }
    
    
    }else if(isset($_GET['d'])and trim ($_GET['d']!='') and !isset($_GET['sd'])){
	
	$req=$bdd->prepare("SELECT distinct domaine,sous_domaine FROM recap_repondeur natural join sous_domaine natural join domaine where id_domaine=:d and id_repondeur=:id_rep");
	$req->bindValue(':d',$_GET['d']);
	$req->bindValue(':id_rep',$repondeur);
	$req->execute();
	while($ligne=$req->fetch(PDO::FETCH_ASSOC))
	{
        
        ?>      
			<ul class="contact_information">
				<li class="website"> <?php echo '<a href="ProfilR.php?d='.$ligne['domaine'].'&sd='.$ligne['sous_domaine'].'"class="nostyle">'.$ligne['sous_domaine'].'</a>'; ?></li>
               
             
			</ul>
	  
            <?php
    }
    
    $req=$bdd->prepare("SELECT * FROM recap_repondeur natural join domaine WHERE id_repondeur=:id_rep and id_domaine=:d and sous_domaine is null");
	$req->bindValue(':d',$_GET['d']);
	$req->bindValue(':id_rep',$repondeur);
	$req->execute();
	while($l=$req->fetch(PDO::FETCH_ASSOC))
		{
            
               ?>
           
			<ul class="contact_information">
				<li class="website"><a class="nostyle" href="#">  <?php echo $l['domaine'].' '.$l['sous_domaine'];
				  echo $l['date_qcm_fait'];
					echo 'Note '.$l['note_qcm'];
					echo 'Temps '.$l['temps_qcm'].' sec.';
				
				?> </a></li>
             
			</ul>
		 
            <?php
    }
    
    }else{	 
	
	$dom=$bdd->prepare('SELECT distinct id_domaine,domaine FROM domaine natural join recap_repondeur where id_repondeur = :id_rep ');
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
