<html lang="en">
  <head>
    <meta charset="utf-8">
      <link rel="stylesheet" href="ChoixCI.css" />
      <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,600' rel='stylesheet' type='text/css'>
         <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
         <link href="https://fonts.googleapis.com/css?family=PT+Sans+Narrow" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Lato:100,300" rel="stylesheet">
      <title>Créer/Importer</title>
  </head>
  <body>
      

      <div class="card transition">
  <h2 class="transition">Créer votre question</h2>
  <p>Accéder à notre créateur de question pour ensuite l'ajouter à votre QCM.</p>
  
 <?php
        
		 $monidqcm=$_POST['id'];
        
            echo' <form action="CreationQuestions.php" method="post">
			<input type="hidden" name="idd" value="'.$_POST['id'].'"/>
			<input type="hidden" name="idqcm" value="'.$monidqcm.'"/>
			<button type="submit" class="cta-container transition"><div class="cta">Créer</div></button></form>';

?>
          
  <div class="card_circle transition"></div>
</div>
      
        <div class="card transition">
  <h2 class="transition">Importer une question</h2>
  <p>Importer des questions déjà existantes créées par d'autres utilisateurs.</p>
  
            
       <?php     
  	echo' <form action="Importer.php" method="post">
			<input type="hidden" name="idd" value="'.$_POST['id'].'"/>
			<input type="hidden" name="idqcm" value="'.$monidqcm.'"/>
            <button type="submit" class="cta-container transition"><div class="cta">Importer</div></button></form>'; 
        ?>
      
  <div class="card_circle transition"></div>
</div>     
  </body>
</html>
