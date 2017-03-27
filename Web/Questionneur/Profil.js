 $(document).ready(function () {
     $(".pop").hide();
     console.log("blabla");
     $("i").click(function () {
         console.log("blabla");
		 console.log($(this).parent().find('button').attr('id'));
		 $.get("getMoyenne.php",{id:$(this).parent().find('button').attr('id')},function(reponse){
			 if(reponse==-1)
			 {console.log("erreur");
			 $('#note').text("Personne n'a fait votre Qcm :( ");
			 $('.jaugeverte').css('width','0px');}
			else
			{ console.log(reponse);
			 $('.jaugeverte').css('width',reponse*20+'px');
			$('#note').text(reponse+'/20');}
		 });
         $(".pop").fadeIn(300);
         
     });

     $(".pop > span, .pop").click(function () {
         $(".pop").fadeOut(300);
     });
 });