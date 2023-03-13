<?php
/* Pre Defined Variables for Date & Time - This will used for Token generation */
$Today=date("Y-m-d");
$Day=date("d");
$Month=date("m");
$Year=date("Y");
$Hour=date("g");
$Minute=date("i");
$TimeText=date("A");
$Time=$Hour.":".$Minute." ".$TimeText;

$timeBuffer = time();

// Put DateTime into Token for unique proof.
$Token=md5($Today."webbycms".uniqid().$Time);

$function="";
if(isset($_GET["function"])&&!empty($_GET["function"])){
	$function=$_GET["function"];
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/css/bootstrap.min.css"/>
	<title>OpenAI Image Gen Test</title>
</head>
<style type="text/css">
h1{font-size: 1em;}
</style>
<body>

<div class="container">
	<div class="row">
		<div class="col-12">
			<a href="?function=image">Generate Image</a> |  <a href="?function=text">Text Reponse</a>
		</div>
	</div>
	<div class="row">

		<?php if($function==""||$function=="image"){ include("image.php"); } ?>
		<?php if($function=="text"){ include("text.php"); } ?>
		

		<hr style="border-bottom: 2px solid #000;margin-top: 20px;">


	</div>

</div>

<?php
/* Add updater includes */
include("updates/update.php");
?>

</body>
</html>