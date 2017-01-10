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
if (isset($_POST['id']) and trim($_POST['id']!=''))//qcm sélectionné à partir de Profil.php,affichage des questions/réponses de ce qcm.3 boutons sont alors disponibles: un pour supprimer,un pour modifier et le dernier pour modifier la visibilité du qcm.
{
	$req=$bdd->prepare("SELECT * FROM public.qcm_question natural join public.question where public.qcm_question.id_qcm=:id"); // on selectionne les questions de la table reliées au qcm sélectionné
	$req->bindValue(':id',$_POST['id']);
	$req->execute();
	
	while($ligne=$req->fetch(PDO::FETCH_ASSOC))//on parcourt toutes ces questions
	{
	echo "<div class=\"form-group\"><label class=\"control-label\" for=\"select\">";
		echo 'Question: '.htmlspecialchars($ligne['question'],ENT_QUOTES).'<br/>';//on affiche la question 
		echo "</label><i class=\"bar\"></i></div> ";
		$req2=$bdd->prepare("SELECT distinct id_question,correct,reponse FROM public.qcm_question natural join public.reponse where id_question=:idq");//on sélectionne les réponses reliées à cette question,et ce une //seule fois (car l'id de la question parcourue est présent à chaque fois que cette question est reliée à //un qcm)
		$req2->bindValue(':idq',$ligne['id_question']);
		$req2->execute();
		
		echo'</br></br>';
		while($ligne2=$req2->fetch(PDO::FETCH_ASSOC))//on parocurt toutes les reponses
		{
			if($ligne2['correct']){//on distingue les réponses bonnes des fausses avant de les afficher
				echo'<i class="helper"><div class="green">';
			echo htmlspecialchars($ligne2['reponse'],ENT_QUOTES);
			echo '</div> ';
			}else{
				echo'<i class="helper"><div class="red">';
			echo htmlspecialchars($ligne2['reponse'],ENT_QUOTES);
			echo '</div> ';
			
		}
		}
	}
	

	
	
	
	echo '<form action="SupprimerQCM.php" method="post"><input type="submit" name="supp" value="Supprimer"/><input type="hidden" name="id" value="'.$_POST['id'].'"/></form>';
	echo '<form action="VisibiliteQCM.php"  method="post"><input type="submit" name="vis" value="Modifier la Visibilité"/><input type="hidden" name="id" value="'.$_POST['id'].'"/></form>';
	echo '<form action="Questions.php" method="post">
	<input type="hidden" name="id" value="'.$_POST['id'].'"/><input type="submit" name="modif" value="Modifier "/></form>';//les 3 boutons sont affichés sous forme de formulaire pour passer des informations telles que //l'id du qcm sélectionné
	
}
?>
</div>





	
	</body>
	</html>
