//функция, подпомагаща избирането на дата
 $(document).ready(function(){
    $('.datepicker').datepicker();
	$(".dropdown-trigger").dropdown();
        
  });
  function myFunction() {
	var x = document.getElementById("myLinks");
	if (x.style.display === "block") {
		x.style.display = "none";
  } else {
		x.style.display = "block";
  }
} 
  
