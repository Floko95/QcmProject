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
      <li><a href="Index.php">Déconnexion</a></li>
    </ul>
  </nav>
</div>
        
        
        <?php 
session_start();
require_once('Connexionbdd.php');
?>
        
        
    <div class="material-wrap">
<div class="material clearfix">
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
	<div class="profile">
		<div class="cover">
			<span class="vec vec_a"></span>
			<span class="vec vec_b"></span>
			<span class="vec vec_c"></span>
			<span class="vec vec_d"></span>
			<span class="vec vec_e"></span>
		</div>
		<div class="photo">
			<a href="" target="_blank"><img src="http://icons.iconarchive.com/icons/webalys/kameleon.pics/512/Alien-icon.png"></a>
		</div>
		<div class="info">
        <?php echo '<div class="name">'.$_SESSION['user'].'</div>';?>
		</div>
		<a href="" onClick="javascript:window.history.go(-1)"> <input id="toggle" type="checkbox" class="plus"><label for="toggle" class="toggle"></label>
		<div class="links">
			<a href="" data-title="IDK"><i class="fa fa-facebook"></i></a>
			<a href="" data-title="IDK"><i class="fa fa-twitter"></i></a>
			<a href="" data-title="IDK"><i class="fa fa-codepen"></i></a>
			<a href="" data-title="IDK"><i class="fa fa-pinterest"></i></a>
		</div>
            </a>
	</div>
    
   
    
    <?php 
$tim=0;
$ins=$bdd->prepare('select * from repondeur where nom_repondeur=:n');
$ins->bindValue(':n',$_SESSION['user']);
$ins->execute();
while($lu=$ins->fetch(PDO::FETCH_ASSOC)){
		$tim=$lu['id_repondeur'];
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
    echo '<div class="tabs clearfix"> <a href="#">';
    
    echo $l['temps_total'];    
        
    echo '</a><a href="#">';
    echo $l['nb_qcm_fait'];
    
    echo '</a><a href="#">';
    
    echo $l['moyenne'];
    
    echo '</a></div>';
}
    ?>
        
	<div class="tabs-content">
		<div class="friend-list">
			<div class="list-ul">
				<div class="list-li title">Récapitulatif</div>
                
    <?php
	///////////////////
if(isset($_GET['d'])and trim ($_GET['d']!='') and !isset($_GET['sd'])){
	//  where recap_repondeur.domaine=domaine.domaine and sous_domaine.id_domaine=domaine.id_domaine and sous_domaine.id_domaine=:d
	$req=$bdd->prepare("SELECT distinct domaine,sous_domaine FROM recap_repondeur natural join sous_domaine natural join domaine where id_domaine=:d");
	$req->bindValue(':d',$_GET['d']);
	$req->execute();
	while($ligne=$req->fetch(PDO::FETCH_ASSOC))
	{
        echo'    <div class="list-li clearfix">	
					<div class="info pull-left">
						<div class="name">';
		echo '<a href="ProfilR.php?d='.$ligne['domaine'].'&sd='.$ligne['sous_domaine'].'">'.$ligne['sous_domaine'].'</a>';
        echo'</div>
					</div>
				</div>';
	}
}else{	 
	$dom=$bdd->prepare('SELECT distinct id_domaine,domaine FROM domaine natural join recap_repondeur');
	$dom->execute();
	while($li=$dom->fetch(PDO::FETCH_ASSOC)){
		echo '
		<div class="list-li clearfix">	
					<div class="info pull-left">
						<div class="name">';
              echo '<a href="ProfilR.php?d='.$li['id_domaine'].'">'.$li['domaine'].'</a>';
                
                echo'</div></div></div>';
	}
}
	/////////////////////
	/*
	
    $d=$bdd->prepare('SELECT * FROM recap_repondeur WHERE id_repondeur = :id_rep');
$d->bindValue(':id_rep',$tim);
$d->execute();
	while($l=$d->fetch(PDO::FETCH_ASSOC)){
                
				
            echo'    <div class="list-li clearfix">	
					<div class="info pull-left">
						<div class="name">';
              
                echo $l['domaine']. $l['sous_domaine'];
                
                echo'</div>
						<div class="time">';
                    
                    echo $l['date_qcm_fait'];
        
       echo' </div>
					</div>
					<div class="action pull-right">
						<div class="name">';
           echo $l['note_qcm'];
        
        echo'</div>
						<div class="time">';
        echo $l['temps_qcm'];
        
        echo'</div>
					</div>
				</div>';
    }*/
                                
        ?>        
	
			</div>
		</div>
	</div>
</div>
</div>
    
    
    </body>
	</html>
    
    
    