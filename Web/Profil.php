<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
		 <link rel="stylesheet" href="P.css" />
         <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,600' rel='stylesheet' type='text/css'>
         <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
         <link href="https://fonts.googleapis.com/css?family=PT+Sans+Narrow" rel="stylesheet">
        <title></title>
    </head>
    <body>
		
        <!-- NAVIGATION -->

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
        
        <!-- END NAVIGATION -->
        
        
<?php session_start();
require_once('Connexionbdd.php'); ?>
        
        
<div class="fond">
<div class="bloc">
	
    <div class="top-bar"><span class="title">Profil</span></div>
    
	<div class="profil">
		<div class="cover">
			<span class="vec vec_a"></span>
			<span class="vec vec_b"></span>
			<span class="vec vec_c"></span>
			<span class="vec vec_d"></span>
			<span class="vec vec_e"></span>
		</div>
        
    <div class="photo"><img src="http://icons.iconarchive.com/icons/webalys/kameleon.pics/512/Alien-icon.png"></div>
		<div class="info"><?php echo '<div class="name">'.$_SESSION['user'].'</div>';?></div>
		
        <label for="retour" class="retour"><a href="" onClick="javascript:window.history.go(-1)"><img src="http://img15.hostingpics.net/pics/571733arrow8724.png"></a></label>
	</div>
    
    
