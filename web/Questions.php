<?php

	//var_dump($_POST);
	echo "Questions créées<br /><br />";
	echo 'Question : '.$_POST['q'].'<br /><br />';
	echo 'Réponses : <br /><br />';

	foreach($_POST['Rep'] as $Rep)
	{
		echo $Rep.'<br />';
	}
?>

