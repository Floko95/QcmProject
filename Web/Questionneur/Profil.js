 $(document).ready(function () {
     $(".pop").hide();
     console.log("blabla");
     $("i").click(function () {
         console.log("blabla");
         $(".pop").fadeIn(300);
         
     });

     $(".pop > span, .pop").click(function () {
         $(".pop").fadeOut(300);
     });
 });