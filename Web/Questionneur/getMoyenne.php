<?php 
require_once('../Autres/Connexionbdd.php');
$id=$_GET['id'];
$req1=$bdd->prepare("SELECT note_qcm,id_utilisateur FROM recap_repondeur WHERE id_qcm=:id");			
		$req1->bindValue(':id',$id);
		$req1->execute();
		$somme=0;
		$n=0;
		
		
		$tranche1=0; //de 0 a 5
		$tranche2=0;// de 5 a 10
		$tranche3=0;// de 10 a 15
		$tranche4=0;// de 15 a 20
		while($ligne=$req1->fetch(PDO::FETCH_ASSOC))
		{
			
			$somme=$somme + $ligne['note_qcm'];
			if($ligne['note_qcm']>=0 and $ligne['note_qcm']<5)
				$tranche1++;
			if($ligne['note_qcm']>=5 and $ligne['note_qcm']<10)
				$tranche2++;
			if($ligne['note_qcm']>=10 and $ligne['note_qcm']<15)
				$tranche3++;
			if($ligne['note_qcm']>=15 and $ligne['note_qcm']<=20)
				$tranche4++;
			$n=$n+1;
			$compteur++;
			
		}
		$req1=$bdd->prepare("SELECT distinct id_utilisateur FROM recap_repondeur WHERE id_qcm=:id");			
		$req1->bindValue(':id',$id);
		$req1->execute();
		$compteur=0;
		while($ligne=$req1->fetch(PDO::FETCH_ASSOC))
		{$compteur++;}//avoir le nb de personnes distinctes ayant fait le qcm
		$req1=$bdd->prepare("SELECT distinct id_utilisateur FROM recap_repondeur WHERE id_qcm=:id");			
		$req1->bindValue(':id',$id);
		$req1->execute();
		$c=0;
		$c2=0;
		while($ligne=$req1->fetch(PDO::FETCH_ASSOC))
		{
			if ($c>=$compteur-10)
			{
				$tab2[$c2]=$ligne['id_utilisateur'];
				$c2++
			}
			$c++;
		}
		$tab=["moy"=>$somme/$n, "nb"=>$n, "t1"=>$tranche1,"t2"=>$tranche2,"t3"=>$tranche3,"t4"=>$tranche4,"last"=>$tab2];
		header('Content-type: application/json');
		if($n!=0)
			echo json_encode($tab);
		else
			echo -1;
		
		
?>