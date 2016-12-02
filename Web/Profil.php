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
      <li><a href="Index.php">Home</a></li>
      <li><a href="Profil.php">Profil</a></li>
      <li><a href="ChoixQC.php">QCM</a></li>
      <li><a href="Index.php">Déconnexion</a></li>
    </ul>
  </nav>
</div>

<!-- END NAVIGATION -->

   

<!-- About  -->

<div id="about-me">

<h2>Profil</h2>
  <p>Profil Questionneur.</p>

<?php 
session_start();
require_once('Connexionbdd.php');

if (isset($_POST['qcmb']) and trim($_POST['qcmb']!=''))
{
	$req=$bdd->prepare("SELECT * FROM public.qcm_question natural join public.question where public.qcm_question.id_qcm=:id");
	$req->bindValue(':id',$_POST['id']);
	$req->execute();
	
	while($ligne=$req->fetch(PDO::FETCH_ASSOC))
{
	
	echo 'Question: '.$ligne['question'].'<br/>';
	$req2=$bdd->prepare("SELECT * FROM public.qcm_question natural join public.reponse where id_question=:idq");
	$req2->bindValue(':idq',$ligne['id_question']);
	$req2->execute();
	$c=0;
	echo'</br></br>';
	while($ligne2=$req2->fetch(PDO::FETCH_ASSOC))
	{
		if($ligne2['correct'])
		echo 'Réponse correcte numéro '.$c.': '.$ligne2['reponse'].'</br>';
		else
		echo 'Réponse numéro '.$c.': '.$ligne2['reponse'].'</br>';
		$c++;
	}
	echo'</br></br>';
	
}
echo ' <form action="Profil.php" method="post"><input type="hidden" name="id" value="'.$_POST['id'].'" /><input type="submit" name="supp" value="Supprimer le QCM" /></form>';
}

elseif (isset($_POST['supp']) and trim($_POST['supp']!=''))
{
	echo ' <p>Voulez vous vraiment supprimer le QCM numéro '.$_POST['id'].'?</p>';
	echo ' <form action="Profil.php" method="post"><input type="hidden" name="id" value="'.$_POST['id'].'" /><input type="submit" name="suppc" value="Oui"/> <input type="submit" name="suppn" value="Non"/></form>';
	
}
elseif(isset($_POST['suppc']))
{
	
	$req=$bdd->prepare("DELETE  FROM public.qcm_question WHERE id_qcm=:id");
	$req->bindValue(':id',$_POST['id']);
	$req->execute();
	$req=$bdd->prepare("DELETE  FROM public.qcm WHERE public.qcm.id_qcm=:id");
	$req->bindValue(':id',$_POST['id']);
	$req->execute();
	echo ' <p> Le questionnaire numéro '.$_POST['id']. ' a été supprimé.</p><br/><a href=Profil.php>retour</a>';
}
elseif(isset($_POST['suppn']))
{
	header('Location: Profil.php');
}
else
{
$req=$bdd->prepare("SELECT distinct id_qcm,domaine,sous_domaine FROM public.Qcm natural join public.Qcm_question  where auteur=:aut");
$req->bindValue(':aut',$_SESSION['user']);
$req->execute();
while($ligne=$req->fetch(PDO::FETCH_ASSOC))
{
	echo '<p>Domaine: '.$ligne['domaine'].'  Sous-domaine: '.$ligne['sous_domaine'].' </p>';
	echo '<form action="Profil.php" method="post"><input type="submit" name="qcmb" value="QCM numéro '.$ligne['id_qcm'].'" /><input type="hidden" name="id" value="'.$ligne['id_qcm'].'" /></form>';
	echo'</br>';
}
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

