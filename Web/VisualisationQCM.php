<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
		 <link rel="stylesheet" href="VisualisationQCM.css" />
        <title></title>
    </head>
    <body>
		

<div id="desk-nav">
  <nav>
    <ul>
      <li><a href="AccueilQ.php">Home</a></li>
      <li><a href="Profil.php">Profil</a></li>
      <li><a href="ChoixQC.php">QCM</a></li>
      <li><a href="Index.php">Déconnexion</a></li>
    </ul>
  </nav>
</div>

<div class="container">
    <h1>Visualisation de votre QCM</h1>

  


<?php
session_start();
require_once("Connexionbdd.php");
if (isset($_POST['id']) and trim($_POST['id']!=''))//4-qcm sélectionné,affichage des questions/réponses.3 boutons:un pour supprimer,un pour modifier et le dernier pour modifier la visibilité.
{
	$req=$bdd->prepare("SELECT * FROM public.qcm_question natural join public.question where public.qcm_question.id_qcm=:id");
	$req->bindValue(':id',$_POST['id']);
	$req->execute();
	
	while($ligne=$req->fetch(PDO::FETCH_ASSOC))
	{
	echo "<div class=\"form-group\"><label class=\"control-label\" for=\"select\">";
		echo 'Question: '.$ligne['question'].'<br/>';
		echo "</label><i class=\"bar\"></i></div> ";
		$req2=$bdd->prepare("SELECT * FROM public.qcm_question natural join public.reponse where id_question=:idq");
		$req2->bindValue(':idq',$ligne['id_question']);
		$req2->execute();
		
		echo'</br></br>';
		while($ligne2=$req2->fetch(PDO::FETCH_ASSOC))
		{
			if($ligne2['correct']){
				echo'<i class="helper"><div class="green">';
			echo $ligne2['reponse'];
			echo '</div> ';
			}else{
				echo'<i class="helper"><div class="red">';
			echo $ligne2['reponse'];
			echo '</div> ';
			
		}
		}
	}
	

	
	
	
	echo '<form action="SupprimerQCM.php" method="post"><input type="submit" name="supp" value="Supprimer"/><input type="hidden" name="id" value="'.$_POST['id'].'"/></form>';
	echo '<form action="VisibiliteQCM.php"  method="post"><input type="submit" name="vis" value="Modifier la Visibilité"/><input type="hidden" name="id" value="'.$_POST['id'].'"/></form>';
	echo '<form action="Profil.php" method="post"><input type="submit" name="modif" value="Modifier(en travaux)"/></form>';
	
}
?>
</div>





	
	</body>
	</html>
