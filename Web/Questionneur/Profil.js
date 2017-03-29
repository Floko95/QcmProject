 $(document).ready(function () {
     $(".pop").hide();
     console.log("blabla");
     $("i").click(function () {
         console.log("blabla");
		 console.log($(this).parent().find('button').attr('id'));
		 $('#qcm').text( $('#qcm').text()+$(this).parent().find('button').attr('id'))
		 $.get("getMoyenne.php",{id:$(this).parent().find('button').attr('id')},function(reponse){
			 if(reponse==-1)
			 {console.log("erreur");
			 $('#note').text("Personne n'a fait votre Qcm :( ");
			 $('.jaugeverte').css('width','0px');
			 $('.tranche1').text('Nombre de notes entre 0 et 5:0 ');
			$('.tranche2').text('Nombre de notes entre 5 et 10: 0');
			$('.tranche3').text('Nombre de notes entre 10 et 15: 0');
		 $('.tranche4').text('Nombre de notes entre 15 et 20:0');}
			else
			{ console.log(reponse);
			 $('.jaugeverte').css('width',reponse.moy*20+'px');
			$('#note').text(reponse.moy+'/20');
			$('.tranche1').text('Nombre de notes entre 0 et 5: '+reponse.t1);
			$('.tranche2').text('Nombre de notes entre 5 et 10: '+reponse.t2);
			$('.tranche3').text('Nombre de notes entre 10 et 15: '+reponse.t3);
	 $('.tranche4').text('Nombre de notes entre 15 et 20: '+reponse.t4);}
		 });
         $(".pop").fadeIn(300);
         
     });

     $(".pop > span, .pop").click(function () {
         $(".pop").fadeOut(300);
     });
 });