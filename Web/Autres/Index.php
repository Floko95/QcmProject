<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
		 <link rel="stylesheet" href="Index.css" />
        <link href="https://fonts.googleapis.com/css?family=Lato:100,300" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Redressed" rel="stylesheet">
        <title></title>
    </head>
    <body>
		

<!-- NAVIGATION -->

<div id="desk-nav">
    <h1>PROJET QCM</h1>
    <nav><ul>
      <li><a href="Connexion.php">Connexion</a></li>
      <li><a href="#information">Information</a></li>
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
        <a href="#"><h2>QCM</h2></a>
        <p>Start working</p>
    </div>

    <div id="profil">
        <a href="#"><h2>Profil</h2></a>
        <p>Check your profil</p>
    </div>
</div>

<!-- END Profil AND QCM  -->

<!-- Contact Information -->

<div id="contact">

      <a name="contact-me"></a>
      <div id="con-left">
        <h1>Let's work together</h1>
        <p>N'hésitez pas à poser vos questions pour d'avantage de renseignement.</p>

        <h3>Contact Information</h3>
        <p class="contactIn">Addresse: IUT PARIS 13, Villetaneuse</p>
        <p class="contactIn">Site: paris13.com</p>
        <p class="contactIn">Email: blablabla.gmail.com</p>
      </div>


      <form action="//blablabla@gmail.com" method="POST">

        <div id="name">
          <label for="name">*Nom</label>
          <input type="text" name="name" placeholder="">
        </div>

        <div id="email">
          <label for="_replyto">*Adresse Email</label>
          <input type="email" name="_replyto" placeholder="">
        </div>

        <div id="message">
          <label for="message">*Votre Message</label>
          <textarea name="message" id="" cols="30" rows="10"></textarea>
        </div>

        <div id="submit">
          <input type="submit" value="Send">
		  </div>
      </form>
    </div>

<!-- END CONTACT INFORMATION  -->


        
<!-- Footer -->

<footer>
  <p>&copy;  DUT Informatique  <span class="year">2015</span>. All Rights Reserved. </p>
</footer>

<!-- END FOOTER  -->
	
	</body>
	</html>
