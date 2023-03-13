<center>
	<?php include("modules/newGen.php"); ?>
	<?php include("modules/reGen.php"); ?>
</center>

<?php if(isset($_POST["descText"])&&!empty($_POST["descText"]) || isset($_GET["regenImageFile"])&&!empty($_GET["regenImageFile"])){ ?>
	<center>
		<a href="/" class="btn btn-primary" style="width:200px;">New Generate</a>
	</center>
<?php }else{ ?>
	<form method="post">
		<select name="size" class="form-control" style="margin-top: 50px;">
			<option>1024x1024</option>
			<option>512x512</option>
			<option>256x256</option>
		</select><br>
		<textarea name="descText" class="form-control" placeholder="Describe image to generate" style="height: 200px;"></textarea>

		<center>
			<br><input type="submit" class="btn btn-primary" value="Generate" style="width:200px;">
		</center>

	</form>
<?php } ?>

<center><br><br>
	<a href="/list.php" class="btn btn-success">View All Generated</a>
</center>