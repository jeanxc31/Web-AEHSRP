<?php 
	session_start();
	if(isset($_SESSION['usuario'])){
		
 ?>


<!DOCTYPE html>
<html>
<head>
	<title>inicio</title>
	<?php require_once "menu.php"; 

	?>

	
</head>
<body onload="deshabilitaRetroceso()">


</body>
</html>

<script>

function deshabilitaRetroceso(){
    window.location.hash="no-back-button";
    window.location.hash="Again-No-back-button" //chrome
    window.onhashchange=function(){window.location.hash="";}
}
</script>



<?php 
	}else{

		header("location:../index.php");
	}
 ?>
 
