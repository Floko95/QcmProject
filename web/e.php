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

<h2>QCM</h2>
  <p>Bonne chance...</p>

 <?php 
require_once('Connexionbdd.php');


try{

if(isset($_GET['iq'])and trim($_GET['iq']!=' ')){

	$req=$bdd->prepare("SELECT * FROM public.qcm_question natural join public.question where id_qcm=:idqcm");
	$req->bindValue(':idqcm',$_GET['iq']);
	$req->execute();
	
	while($ligne=$req->fetch(PDO::FETCH_ASSOC))
		{
			echo ''.$ligne['id_question'].'. '.htmlspecialchars($ligne['question'],ENT_QUOTES).'</br>';
	$req2=$bdd->prepare("SELECT * FROM public.reponse natural join public.question natural join qcm_question where id_qcm=:idqcm and id_question=:numeroquest"); 
	$req2->bindValue(':idqcm',$_GET['iq']);
	$req2->bindValue(':numeroquest',$ligne['id_question']);
	$req2->execute();
	echo'</br>';
	echo '<form action="s.php" method="post">';
		echo '<input type="hidden" name="qcm" value="'.$ligne['id_qcm'].'"/>';
	while($l=$req2->fetch(PDO::FETCH_ASSOC))
		{
			//echo '<input type="hidden" name="question[]" value="'.$l['question'].'"/>';
			echo'<input type="checkbox" name="reponse[]" value="'.$l['id_reponse'].'"/>'.htmlspecialchars($l['reponse'],ENT_QUOTES).'</br>';
		
		}
		
		echo'</br>';
		}///////////
		echo'<input type="submit" name="checkboxes" value="VALIDER">';
		echo'</form>';
		

		
}		
}catch(PDOException $e){
	echo'Exception reçue : ',$e->getMessage(),'\n';
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
