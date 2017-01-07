<!DOCTYPE html>

<html>
  <head>
		
      	 <link rel="stylesheet" href="ProfilQ.css" />
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
$tim=0;
$ins=$bdd->prepare('select * from repondeur where nom_repondeur=:n');
$ins->bindValue(':n',$_SESSION['user']);
$ins->execute();
while($lu=$ins->fetch(PDO::FETCH_ASSOC)){
		$tim=$lu['id_repondeur'];
		}
if(isset($_GET['d']) and trim($_GET['d']!='') and !isset($_GET['sd'])){
$d=$_GET['d'];
$req2 =$bdd->query("SELECT round(avg(note_qcm)::numeric,2) as round FROM recap_repondeur natural join domaine WHERE id_repondeur = $tim and id_domaine=$d");
$t=$req2->fetch();
$req2->closeCursor();
$two=$t['round'];
            
            
            
            
			echo '<div class="followers">
				<div class="follow_count">'; 
    echo $two; echo ' </div>
				Moyenne Domaine
			</div>';
            
}
            
            
            
            $req1 =$bdd->query("SELECT count(id_qcm) as somme FROM recap_repondeur WHERE id_repondeur = $tim");
$o=$req1->fetch();
$req1->closeCursor();
$one=$o['somme'];
$req2 =$bdd->query("SELECT round(avg(note_qcm)::numeric,2) as round FROM recap_repondeur WHERE id_repondeur = $tim");
$t=$req2->fetch();
$req2->closeCursor();
$two=$t['round'];
$req3 =$bdd->query("SELECT sum(temps_qcm) as sum FROM recap_repondeur WHERE id_repondeur = $tim");
$th=$req3->fetch();
$req3->closeCursor();
$three=$th['sum'];
$up1 =$bdd->prepare ('UPDATE repondeur SET nb_qcm_fait = :o WHERE id_repondeur = :id');
$up1->bindValue(':id',$tim);
$up1->bindValue(':o',$one);
$up1->execute();
$up2 =$bdd->prepare ('UPDATE repondeur SET moyenne = :t WHERE id_repondeur = :id');
$up2->bindValue(':id',$tim);
$up2->bindValue(':t',$two);
$up2->execute();
$up3 =$bdd->prepare ('UPDATE repondeur SET temps_total = :th WHERE id_repondeur = :id');
$up3->bindValue(':id',$tim);
$up3->bindValue(':th',$three);
$up3->execute();
	
$statrep =$bdd->prepare ('Select * from repondeur WHERE id_repondeur = :id');
$statrep->bindValue(':id',$tim);
$statrep->execute();
while($l=$statrep->fetch(PDO::FETCH_ASSOC)){
            

            ?>
			<div class="following">
				<div class="follow_count"><?php echo $l['nb_qcm_fait'] ;?></div>
                Score Total</div>
            <div class="following">
				<div class="follow_count"><?php echo $l['temps_total']; ?></div>
                Temps Total</div></div>

            
		<div class="right_col">
			<h2 class="name"> Tu mets le D/S-D ici !</h2>
	
            
    <?php        
    
}
            
	
if(isset($_GET['d'])and trim ($_GET['d']!='') and isset($_GET['sd']) and trim ($_GET['sd']!='') ){
	
	
	
$d=$bdd->prepare('SELECT * FROM recap_repondeur WHERE id_repondeur = :id_rep and sous_domaine=:sd');
$d->bindValue(':id_rep',$tim);
$d->bindValue(':sd',$_GET['sd']);
$d->execute();
	while($l=$d->fetch(PDO::FETCH_ASSOC)){
        
        ?>
           
			<ul class="contact_information">
				<li class="website"><a class="nostyle" href="#"> <?php echo $l['domaine'].' '.$l['sous_domaine']; ?></a></li>
               
             
			</ul>
            </div>
            
            
            <?php
    }
    
    
    }else if(isset($_GET['d'])and trim ($_GET['d']!='') and !isset($_GET['sd'])){
	
	$req=$bdd->prepare("SELECT distinct domaine,sous_domaine FROM recap_repondeur natural join sous_domaine natural join domaine where id_domaine=:d and id_repondeur=:id_rep");
	$req->bindValue(':d',$_GET['d']);
	$req->bindValue(':id_rep',$tim);
	$req->execute();
	while($ligne=$req->fetch(PDO::FETCH_ASSOC))
	{
        
        ?>
            
			<ul class="contact_information">
				<li class="website"> <?php echo '<a href="ProfilQ.php?d='.$ligne['domaine'].'&sd='.$ligne['sous_domaine'].'"class="nostyle">'.$ligne['sous_domaine'].'</a>'; ?></li>
               
             
			</ul>
		
            
            
            <?php
    }
    
    $req=$bdd->prepare("SELECT * FROM recap_repondeur natural join domaine WHERE id_repondeur=:id_rep and id_domaine=:d and sous_domaine is null");
	$req->bindValue(':d',$_GET['d']);
	$req->bindValue(':id_rep',$tim);
	$req->execute();
	while($l=$req->fetch(PDO::FETCH_ASSOC))
		{
            
               ?>
           
			<ul class="contact_information">
				<li class="website"><a class="nostyle" href="#">  <?php echo $l['domaine'].' '.$l['sous_domaine'];?> </a></li>
               
             
			</ul>
		
            
            
            <?php
    }
    
    
    }else if(isset($_GET['d'])and trim ($_GET['d']!='') and !isset($_GET['sd'])){
	
	$req=$bdd->prepare("SELECT distinct domaine,sous_domaine FROM recap_repondeur natural join sous_domaine natural join domaine where id_domaine=:d and id_repondeur=:id_rep");
	$req->bindValue(':d',$_GET['d']);
	$req->bindValue(':id_rep',$tim);
	$req->execute();
	while($ligne=$req->fetch(PDO::FETCH_ASSOC))
	{
        
         ?>
            
			<ul class="contact_information">
				<li class="website"> <?php echo '<a href="ProfilQ.php?d='.$ligne['domaine'].'&sd='.$ligne['sous_domaine'].'" class="nostyle">'.$ligne['sous_domaine'].'</a>'; ?> </li>
               
             
			</ul>
		
            
            
            <?php
    }
    
       
	$req=$bdd->prepare("SELECT * FROM recap_repondeur natural join domaine WHERE id_repondeur=:id_rep and id_domaine=:d and sous_domaine is null");
	$req->bindValue(':d',$_GET['d']);
	$req->bindValue(':id_rep',$tim);
	$req->execute();
	while($l=$req->fetch(PDO::FETCH_ASSOC))
		{ 
            
              ?>
            
			<ul class="contact_information">
				<li class="website"><a class="nostyle" href="#"> <?php  echo $l['domaine'].' '.$l['sous_domaine']; ?> </a></li>
               
             
			</ul>
		
            
            
            <?php
    }
    
    }else{	 
	
	$dom=$bdd->prepare('SELECT distinct id_domaine,domaine FROM domaine natural join recap_repondeur where id_repondeur = :id_rep ');
	$dom->bindValue(':id_rep',$tim);
	$dom->execute();
	while($li=$dom->fetch(PDO::FETCH_ASSOC)){
           ?>
          
			<ul class="contact_information">
				<li class="website"> <?php   echo '<a href="ProfilQ.php?d=' .$li['id_domaine'].'" class="nostyle">'.$li['domaine'].'</a>'; ?> </li>
               
             
			</ul>
		
            
            
            <?php
    }
}

            
    ?>
        
        
         
		</div>
	</body>
</html>
