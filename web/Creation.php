<!DOCTYPE html>


<html>
	<head>
	<title>QCM-Creation</title>
	
	</head>
	
	
<body> 

<p>questions importées:</p>
<?php 
if(isset($_POST['domaine']) and trim($_POST['domaine'])!='' )
{
	echo'<p>Domaine: '.$_POST['domaine'].'</p>';
}
if(isset($_POST['sdomaine']) and trim($_POST['sdomaine'])!='' )
{
	echo'<p>Sous-Domaine: '.$_POST['sdomaine'].'</p>';
}
if(isset($_POST['questions']))
{
	foreach($_POST['questions'] as $v)
	{
		echo'<p>Question numéro:'.$v;
	}
}
if(isset($_POST['question']))
	echo'<p>Question numéro:'.$_POST['question'].'</p>';
?>
</body>
</html>