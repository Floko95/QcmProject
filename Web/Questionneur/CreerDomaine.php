<!DOCTYPE html>


<html>
	<head>
	<title>Créer Domaine</title>
		  <link rel="stylesheet" href="cd.css" />
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,600' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
        <link href="https://fonts.googleapis.com/css?family=PT+Sans+Narrow" rel="stylesheet">
	  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" />
	</head>
	
	
<body> 
   	  <div id="desk-nav">
  <nav>
    <ul>
      <li><a href="AccueilQ.php">Home</a></li>
      <li><a href="Profil.php">Profil</a></li>
      <li><a href="ChoixQC.php">QCM</a></li>
      <li><a href="../Index.php">Déconnexion</a></li>
    </ul>
  </nav>
</div>

<?php 
require_once('../Autres/Connexionbdd.php');

	if(isset($_POST['bouton']) and $_POST['bouton']=='Créer Domaine'){			//si le questionneur a choisi de créer un domaine
																				//formulaire qui conduit sur la même page et prend en parmètre le nom de domaine entré
		?>
		
  <div class="container">
    <div class="wrap">
     <ul class="steps">
        <li class="is-active"><a href='ChoixQC.php'></a></li>
      </ul>
		
		
			<form class="form-wrapper" action="CreerDomaine.php" method="post">
			<fieldset class="section is-active">
	 
			<h4>Nom du domaine à créer: </h4>
			<input type="text" name='domainec'/> 
			<input type="submit" class="button" value="Créer domaine"/>
			</fieldset>
		</form>
    </div>
  </div>
                
	<?php		
		
	
	}else if(isset($_POST['sbouton']) and $_POST['sbouton']=='Créer Sous-domaine' and isset($_POST['domaine']) and trim($_POST['domaine']!='')){ //si il a choisi de créer un sous-domaine
																				//formulaire qui conduit sur la même page et prend en parmètre le nom de sous-domaine entré
  
?>	
   <div class="container">
    <div class="wrap">
     <ul class="steps">
        <li class="is-active"><a href='ChoixQC.php'></a></li>
      </ul>
		
		
			<form class="form-wrapper" action="CreerDomaine.php" method="post">
			<fieldset class="section is-active">
            <?php  echo '<h4>Nom du sous-domaine dans '.$_POST['domaine'].'</h4>'; ?>
			<input type="text" name='sdomainec'/> 
            <?php echo '<input type="hidden" name="do" value="'.$_POST['domaine'].'"/>'; ?>
			<input type="submit" class="button" value="Créer sous-domaine"/>
			</fieldset>
		</form>
    </div>
  </div>
			

		<?php
	}

	if(isset($_POST['domainec']) and trim($_POST['domainec'])){						//si le questionneur a créé un domaine
	
		$req=$bdd->prepare("INSERT INTO domaine(domaine) values (:dom)");			//insertion du domaine dans la base 
		$req->bindValue(':dom',$_POST['domainec']);
		$req->execute();
		?>
		
		 <div class="container">
    <div class="wrap">
     <ul class="steps">
        <li class="is-active"><a href='ChoixQC.php'></a></li>
      </ul>
		
		
			<form class="form-wrapper" action="ChoixQC.php" method="post">
			<fieldset class="section is-active">
                        <?php 
                        echo'<h4>Le domaine '. $_POST['domainec'].' a bien été créé.</h4>';   
        
                        //on retourne au profil s'il a été supprimé
					   ?>
                
                <input type="submit" class="button" value="Retour"/>
			</fieldset>
		</form>
    </div>
  </div>
				
		
		<?php
	}

	if(isset($_POST['sdomainec']) and trim($_POST['sdomainec'])){					//si le questionneur a créé un sous-domaine
		
		$req1=$bdd->prepare("SELECT id_domaine FROM domaine WHERE domaine=:dom");			//récupération du domaine auquel le sous-domaine se rapporte
		$req1->bindValue(':dom',$_POST['do']);
		$req1->execute();
		$ligne=$req1->fetch(PDO::FETCH_ASSOC);
		
		$req=$bdd->prepare("INSERT INTO sous_domaine (id_domaine,sous_domaine) values (:do,:sdom)");	//insertion du sous-domaine et du domaine auquel il appartient dans la base 
		$req->bindValue(':do',$ligne['id_domaine']);
		$req->bindValue(':sdom',$_POST['sdomainec']);
		$req->execute();
		
		?>
		
		 <div class="container">
    <div class="wrap">
     <ul class="steps">
        <li class="is-active"><a href='ChoixQC.php'></a></li>
      </ul>
		
		
			<form class="form-wrapper" action="ChoixQC.php" method="post">
			<fieldset class="section is-active">
                        <?php 
                        echo '<p>Le sous-domaine '. $_POST['sdomainec'].' a bien été créé dans le domaine '.$_POST['do'].'</p>'; 
                        //on reoturne au profil s'il a été supprimé
					   ?>
				<input type="submit" class="button" value="Retour"/>
			</fieldset>
		</form>
    </div>
  </div>
		
		<?php
	
	}
	
?>
</body>
</html>
