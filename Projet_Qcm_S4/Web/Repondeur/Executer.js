$(document).ready(function(){ //attend le chargement de la page pour executer le script
console.log("document pret");	
		$("#formulaire").submit(function (e){//form désigne l'ensemble des formulaires
		console.log("submit");		
		$.ajax({
                url: 'Executer.php', // Le nom du fichier indiqué dans le formulaire
                datatype: 'POST', // La méthode indiquée dans le formulaire (get ou post)
                data: $("#formulaire").serialize(), // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
		});
	});      
}); 

