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

if(isset($_GET['d']) and trim($_GET['d']!='') and !(isset($_GET['sd'])))//2-domaine sélectionné,affichage des sous domaines de ce domaine dans lesquels le questionneur a créé des qcms
{
	$req=$bdd->prepare("SELECT distinct domaine,sous_domaine  FROM public.qcm_question natural join public.qcm WHERE auteur=:a and domaine=:d");
	$req->bindValue(':a',$_SESSION['user']);
	$req->bindValue(':d',$_GET['d']);
	$req->execute();
	while($ligne=$req->fetch(PDO::FETCH_ASSOC))
	{
		echo '<a href="Profil.php?d='.$ligne['domaine'].'&sd='.$ligne['sous_domaine'].'">'.$ligne['sous_domaine'].'</a>';
	}
}	

else if (isset($_GET['sd']) and trim($_GET['sd']!='') and isset($_GET['d']) and trim($_GET['d']!=''))//3-sous domaine sélectionné,affichage des qcms créés par le questionneur dans ce sous domaine
{
	$req=$bdd->prepare("SELECT  distinct id_qcm FROM public.qcm_question natural join public.qcm WHERE domaine=:d and sous_domaine=:sd and auteur=:a");
	$req->bindValue(':a',$_SESSION['user']);
	$req->bindValue(':d',$_GET['d']);
	$req->bindValue(':sd',$_GET['sd']);
	$req->execute();
	
	while($ligne=$req->fetch(PDO::FETCH_ASSOC))
	{
		 echo '<form action="Profil.php" method="post"><input type="submit" name="qcmb" value="QCM numéro '.$ligne['id_qcm'].'" /><input type="hidden" name="id" value="'.$ligne['id_qcm'].'" /></form>';
	}
}
else if (isset($_POST['qcmb']) and trim($_POST['qcmb']!=''))//4-qcm sélectionné,affichage des questions/réponses.3 boutons:un pour supprimer,un pour modifier et le dernier pour modifier la visibilité.
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
	}
	echo '<form action="SupprimerQCM.php" method="post"><input type="submit" name="supp" value="Supprimer"/><input type="hidden" name="id" value="'.$_POST['id'].'"/></form>';
	echo '<form action="VisibiliteQCM.php"  method="post"><input type="submit" name="vis" value="Modifier la Visibilité"/><input type="hidden" name="id" value="'.$_POST['id'].'"/></form>';
	echo '<form action="Profil.php" method="post"><input type="submit" name="modif" value="Modifier(en travaux)"/></form>';
	
}
else//1-entrée du profil,affichage des domaines dans lesquels le questionneur a créé des qcms
{
	$req=$bdd->prepare("SELECT distinct domaine FROM public.qcm_question natural join public.qcm WHERE auteur=:a");
	$req->bindValue(':a',$_SESSION['user']);
	$req->execute();
	while($ligne=$req->fetch(PDO::FETCH_ASSOC))
	{
		echo '<a href="Profil.php?d='.$ligne['domaine'].'">'.$ligne['domaine'].'</a>';
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

