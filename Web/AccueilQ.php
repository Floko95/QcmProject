<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
		 <link rel="stylesheet" href="AccueilQ.css" />
        <title></title>
    </head>
    <body>
		
<?php 
session_start();
require_once('Connexionbdd.php');
?>

<div id="desk-nav">

  <a href="#home"><?php echo 'Utilisateur : '.htmlspecialchars($_SESSION['user'],ENT_QUOTES); ?>
   <!-- Image Logo -->
  </a>
  
  <nav>   
    <ul>
      <li><a href="Index.php">Deconnexion</a></li>
      <li><a href="#about">About</a></li>
      <li><a href="ChoixQC.php">QCM</a></li>
      <li><a href="Profil.php">Profil</a></li>
      <li><a href="#contact-me">Contact</a></li>
    </ul>
  </nav>
</div>


<!-- END NAVIGATION -->

    <img id="al-bg-photo" src="http://img15.hostingpics.net/pics/145380brainpaintmindcreative.jpg" />

<!-- About Me -->
<a name="about"></a>
<div id="about-me">

<h2>ABOUT</h2>
  <p>Nous sommes une équipe de cinq étudiants en DUT Informatique à l’Université Paris 13. Réalisé dans le cadre de nos projets tuteurés de S3, ce site vous permettra, suivant votre catégorie, de créer ou de répondre à des QCM. Il s’articule donc autour de ces deux fonctionnalités codées en html, php et css, et s’appuie sur une base de données postgresql.</p>
  </div>

<!-- END ABOUT  -->


<!-- Portfolio and Resume  -->

<div id="port-res">

<!-- Portfolio -->
<div id="portfolio">

  <a href="Importer.php"><h2>QCM</h2></a>
  <p>Start working</p>

</div>

<!-- End Portfolio  -->

<!-- Resume -->
<div id="resume">

  <a href="#"><h2>Profil</h2></a>
  <p>Check your profil</p>

</div>

<!-- End Resume -->
  
</div>

<!-- END PORTFOLIO AND RESUME  -->

<!-- Contact Information -->

    <div id="contact">

      <a name="contact-me"></a>
      <div id="con-left">
        <h1>Let's work together</h1>
        <p>Feel free to reach out to me if you have any questions or comments about the services I offer.</p>

        <h3>Contact Information</h3>
        <p class="contactIn">Attn: IUT PARIS 13, Villetaneuse</p>
        <p class="contactIn">paris13.com</p>
        <p class="contactIn">blablabla.gmail.com</p>
      </div>


      <form action="//blablabla@gmail.com" method="POST">

        <div id="name">
          <label for="name">*Name</label>
          <input type="text" name="name" placeholder="">
        </div>

        <div id="email">
          <label for="_replyto">*Email Address</label>
          <input type="email" name="_replyto" placeholder="">
        </div>

        <div id="message">
          <label for="message">*Your Message</label>
          <textarea name="message" id="" cols="30" rows="10"></textarea>
        </div>

        <div id="submit">
          <input type="submit" value="Send">
		  </div>
      </form>
    </div>

<!-- END CONTACT INFORMATION  -->

<!-- Footer -->



<div id="footer-media">

<!--  Instagram  -->
  <a target="_blank" href="https://www.instagram.com/"><img src="https://raw.githubusercontent.com/atloomer/personal-site-revamp/gh-pages/img/insta-icon.png" alt="instagram icon" /></a>
  
<!--  Facebook  -->
  <a target="_blank" href="https://www.facebook.com/"><img src="https://raw.githubusercontent.com/atloomer/personal-site-revamp/gh-pages/img/facebook-icon.png" alt="facebook icon" /></a>

</div>

<footer>

  <p>&copy;  DUT Informatique  <span class="year">2016</span>. All Rights Reserved. </p>
  
</footer>

<!-- END FOOTER  -->
        
        
        		
		<?php 
	session_start();
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