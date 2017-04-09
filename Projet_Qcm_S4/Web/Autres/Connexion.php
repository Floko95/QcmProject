<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
		 <link rel="stylesheet" href="Connexion.css" />
        <title>Connexion</title>
    </head>
    <body>

<section class="container">
		    <article class="half">
			        <h1>Connexion</h1>
			        <div class="tabs">
				            <span class="tab signin active"><a href="#signin">Sign in</a></span>
				            <span class="tab signup"><a href="../Index.php">Retour</a></span>
			        </div>
			        <div class="content">
				            <div class="signin-cont cont">
                                                     
                                		
<?php
session_start();
	if (isset($_POST['nom']) and isset($_POST['mdp']) and trim($_POST['nom']!='') and trim($_POST['mdp']!=''))
		{
		require_once('Connexionbdd.php');
		try {
			$req = $bdd->prepare("SELECT * FROM utilisateur WHERE login=:user AND password=crypt(:mdp,password)");
			$req->bindValue(':user', $_POST['nom']);
			$req->bindValue(':mdp', $_POST['mdp']);
			$req->execute();
			while($l=$req->fetch(PDO::FETCH_ASSOC)){														
			if($l['role']=='repondeur'){
					$_SESSION['user'] = $_POST['nom'];
					$_SESSION['role'] = 'repondeur';
					$_SESSION['connecte']= true;	
					header('Location: ../Repondeur/AccueilR.php');
			}else if($l['role']=='questionneur'){ 	
					$_SESSION['user'] = $_POST['nom'];
					$_SESSION['role'] = 'questionneur';
					$_SESSION['connecte']= true;
					header('Location: ../Questionneur/AccueilQ.php');
			}else{
				echo('<p> Pseudo ou mot de passe incorrect </p>');
			}
			}
		}catch (PDOException $e){
			die('<p> Probleme avec authentification ['.$e->getCode().'] '.$e->getMessage().'</p>');
		}
}
?>                                    
					                <form action="Connexion.php" method="post" >
						                    <input type="text" name="nom" id="nom" class="inpt"  placeholder="Pseudo">
						                    <label>Pseudo</label>
						                    <input type="password" name="mdp" id="mdp" class="inpt" 
                                                   placeholder="Your password">
                						    <label>Password</label>
						                   
						                    <div class="submit-wrap">
							                        <input type="submit" value="Sign in" class="submit">

						                    </div>
        					        </form>
    				        </div>   
            </div>
		    </article>
		    <div class="half bg"></div>
	</section>
	</body>
	</html>
