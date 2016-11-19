<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
		 <link rel="stylesheet" href="test.css" />
        <title></title>
    </head>
    <body>
		

<div id="desk-nav">
  <nav>
    <ul>
      <li><a href="ar.php">Home</a></li>
      <li><a href="">Profil</a></li>
      <li><a href="choixd.php">QCM</a></li>
      <li><a href="a.php">Déconnexion</a></li>
    </ul>
  </nav>
</div>

<!-- END NAVIGATION -->

   

<!-- About  -->

<div id="about-me">

<h2>Statistiques</h2>
  <p>Tu as fini...quel est ton score ?</p>

<?php 

require_once('Connexionbdd.php');

try{


if(isset($_POST['bouton'])and trim($_POST['bouton']!=' ')){
	echo "beuleubeuleubeuleu c'est en travaux...";
echo '<p><img src="http://asvhgbasket.kalisport.com/public/412/upload/images/articles/1-travaux-2-2015-10-19-16-23-58.jpg"/></p>';


}

if(isset($_POST['reponse'])and trim($_POST['reponse']!=' ')){
	echo 'beuleubeuleubeuleu';
//////////////////////////////////////////////-> keep working

}
}catch(PDOException $e){
	die('<p>Votre requête est erronée.</p>');
}
	
?>
</div>

<!-- END ABOUT  -->


<!-- Footer -->


<div id="footer-media">

  <a target="_blank" href="https://www.instagram.com/"><img src="https://raw.githubusercontent.com/atloomer/personal-site-revamp/gh-pages/img/insta-icon.png" alt="instagram icon" /></a>
  
  <a target="_blank" href="https://www.facebook.com/"><img src="https://raw.githubusercontent.com/atloomer/personal-site-revamp/gh-pages/img/facebook-icon.png" alt="facebook icon" /></a>

</div>

<footer>

  <p>&copy;  DUT Informatique  <span class="year">2016</span>. All Rights Reserved. </p>
  
</footer>

<!-- END FOOTER  -->
	
	</body>
	</html>