<?php 
require_once('../Autres/Connexionbdd.php');
$id=$_GET['id'];
$req1=$bdd->prepare("SELECT note_qcm FROM recap_repondeur WHERE id_qcm=:id");			
		$req1->bindValue(':id',$id);
		$req1->execute();
		$somme=0;
		$n=0;
		while($ligne=$req1->fetch(PDO::FETCH_ASSOC))
		{
			$somme=$somme + $ligne['note_qcm'];
			$n=$n+1;
			
			
		}
		if($n!=0)
		echo $somme/$n;
		else
			echo -1;
?>