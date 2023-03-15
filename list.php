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

<div class="container" style="margin-top:20px;margin-bottom:20px;">

	<h1>Generated Images (Maximum 12 history)</h1>

	<div class="row">
		<?php
		$strLoopNumber=0;
		$files = glob("cache/*.png");
		usort($files, function($a, $b) {
		    return filemtime($b) - filemtime($a);
		});
		foreach ($files as $fileName) { ?>

			<div class="col-6 col-md-4" style="padding:5px;">
				<a href="<?=$fileName?>" target="_blank"><img src="<?=$fileName?>" width="100%" style="width: 100%;"></a>
			</div>
			<?php  $count++; ?>
			<?php
			// Check if the counter has reached 10
		    if ($count >= 12) {
		        break;
		    }
			?>
		<?php } ?>

		<hr style="border-bottom: 2px solid #000;margin-top: 20px;">

	</div>

	<a href="/" class="btn btn-success">Back to Home</a>

</div>