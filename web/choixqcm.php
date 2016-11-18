<?php 

require_once('Connexionbdd.php');
try{
$bdd->query('SET NAMES utf8');
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if(isset($_GET['idsd'])and trim($_GET['idsd']!=' ')){
	echo'sous-domaine : '.$_GET['idsd'];
	$req=$bdd->prepare("SELECT distinct id_qcm,auteur FROM public.qcm natural join public.qcm_question where qcm_question.sous_domaine=:idsd and qcm.id_qcm=qcm_question.id_qcm");
	$req->bindValue(':idsd',$_GET['idsd']);
	$req->execute();
	while($l=$req->fetch(PDO::FETCH_ASSOC))
		{
			echo '<p><a href="e.php?iq='.$l['id_qcm'].'">'.$l['id_qcm'].' '.$l['auteur'].'</a></p>';
		}
}
}catch(PDOException $e){
	die('<p>Votre requête est erronée.</p>');
}
	
?>
