<center>
	<?php include("modules/newTextGen.php"); ?>
</center>

<?php if(isset($_POST["descText"])&&!empty($_POST["descText"])){ ?>
	<center>
		<a href="/?function=text" class="btn btn-primary" style="width:200px;">New Generate</a>
	</center>
<?php }else{ ?>
	<br><br>
	<form method="post">
		<textarea name="descText" class="form-control" placeholder="Try ask something." style="height: 200px;"></textarea>

		<center>
			<br><input type="submit" class="btn btn-primary" value="Submit" style="width:200px;">
		</center>

	</form>
<?php } ?>

<center><br><br>
	<a href="/list_text.php" class="btn btn-success">View All Generated History</a>
</center>