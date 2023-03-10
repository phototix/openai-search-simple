<?php
if(isset($_POST["descText"])&&!empty($_POST["descText"])){
	
	$token = "YOUR-OPENAPI-TOKEN-KEY";

	$url = 'https://api.openai.com/v1/completions';
	$data = array(
	    'model' => 'text-davinci-003',
	    'prompt' => $_POST["descText"],
	    'max_tokens' => 200,
	    'temperature' => 1.2,
	    'n' => 1,
	    'echo' => false,
	    'user' => 'testuser'
	);

	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_POST, true);
	curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
	curl_setopt($curl, CURLOPT_HTTPHEADER, array(
	    'Authorization: Bearer ' . $token,
	    'Content-Type: application/json'
	));

	$response = curl_exec($curl);
	curl_close($curl);
}

if ($response === false) {
    echo 'Response error.';
    echo $response;
} else{
	echo '<div style="display:none">';
    echo $response;
    echo '</div>';
    $notEnough = false;
	$postBody = json_decode($response, true);
	$apiData = $postBody["choices"];
	foreach ($apiData as $answers) {
		$allAnswer .= $answers["text"];
		$allAnswerIndex .= $answers["index"]."-";
		$allAnswerFinish .= $answers["finish_reason"]."-";
		if($answers["finish_reason"]=="length"){ $notEnough = true; }
	}
}
$textEnding="";
if($notEnough==true){
	$textEnding="... (can't finish talking....)";
}
?>

<?php if(isset($_POST["descText"])&&!empty($_POST["descText"])){ ?>
<br><br><textarea class="form-control" readonly="readonly" style="height: 500px;"><?=$allAnswer.$textEnding?></textarea><br><br>
<?php } ?>