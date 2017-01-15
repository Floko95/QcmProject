<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
		 <link rel="stylesheet" href="../Autres/Index.css" />
         <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300" rel="stylesheet">
         <link href="https://fonts.googleapis.com/css?family=Open+Sans:300" rel="stylesheet">
         <link href="https://fonts.googleapis.com/css?family=Redressed" rel="stylesheet">
        <title>Accueil</title>
    </head>
    <body>

<?php 
session_start();
require_once('../Autres/Connexionbdd.php');
?>

<div id="desk-nav">
  <h1><?php echo 'Utilisateur : '.htmlspecialchars($_SESSION['user'],ENT_QUOTES); ?></h1>
    <nav><ul>
      <li><a href="../Index.php">Deconnexion</a></li>
      <li><a href="#information">Information</a></li>
      <li><a href="ChoixRD.php">QCM</a></li>
      <li><a href="ProfilR.php">Profil</a></li>
      <li><a href="#contact">Contact</a></li>
    </ul></nav>
</div>

<!-- END NAVIGATION -->

    <img id="banniere" src="http://img15.hostingpics.net/pics/145380brainpaintmindcreative.jpg" />


<!-- INFORMATION -->

<div id="information">
    <h2>INFORMATION</h2>
    <p>Nous sommes une équipe de cinq étudiants en DUT Informatique à l’Université Paris 13. Réalisé dans le cadre de nos projets tuteurés de S3, ce site vous permettra, suivant votre catégorie, de créer ou de répondre à des QCM. Il s’articule donc autour de ces deux fonctionnalités codées en html, php et css, et s’appuie sur une base de données postgresql.</p>
</div>

<!-- END INFORMATION  -->


<!-- Profil and QCM  -->

<div id="pro-qcm">
    <div id="qcm">
        <a href="ChoixRD.php"><h2>QCM</h2></a>
        <p>Start working</p>
    </div>

    <div id="profil">
        <a href="ProfilR.php"><h2>Profil</h2></a>
        <p>Check your profil</p>
    </div>
</div>


<!-- End Resume -->
  


<!-- END PORTFOLIO AND RESUME  -->

<!-- Contact Information -->

    <div id="contact">

      <a name="contact-me"></a>
      <div id="con-left">
        <h1>Let's work together</h1>
        <p>Feel free to reach out to me if you have any questions or comments about the services I offer.</p>

        <h3>Contact Information</h3>
        <p class="contactIn">Addresse: IUT de PARIS 13, Villetaneuse</p>
        <p class="contactIn">Site: paris13.com</p>
          <p class="contactIn">Email: projets3@gmail.com</p></br></br>
      </div>
    </div>

<!-- END CONTACT INFORMATION  -->

<!-- Footer -->


<footer>

  <p>&copy;  DUT Informatique  <span class="year">2016</span>. All Rights Reserved. </p>
  
</footer>

<!-- END FOOTER  -->

        	<?php 
	
		if ($_SESSION['connecte']){
			switch ($_SESSION['role']) {
				case 'repondeur' :
					echo('<p> Connexion répondeur réussie </p>');
					break;
				case 'questionneur' :
					echo('<p> Connexion questionneur réussie </p>');
					break;
				default : die('<p> Vous n\'avez techniquement pas à voir ça O_o </p>');
			} 
        }
		?>
	
	</body>
	</html>
		
		
		

