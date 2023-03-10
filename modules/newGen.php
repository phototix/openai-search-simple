<?php
if(isset($_POST["descText"])&&!empty($_POST["descText"])){

	$sizeInput = '1024x1024';
	if(isset($_POST["size"])&&!empty($_POST["size"])){
		$sizeInput = $_POST["size"];
	}

	$token = "YOUR-OPENAPI-TOKEN-KEY";

	$url = 'https://api.openai.com/v1/images/generations';
	$data = array(
	    'prompt' => $_POST["descText"],
	    'n' => 1,
	    'size' => $sizeInput,
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
} elseif(isset($_POST["descText"])&&!empty($_POST["descText"])){
	$postBody = json_decode($response, true);
	$apiData = $postBody["data"];
    $privateURL = $apiData[0]['url'];

    if($privateURL<>""){
		$filename = "cache/".$Token.'.png';

		$image_data = file_get_contents($privateURL);
		if ($image_data === false) {
		    echo 'Unabled to save image';
		} else {
		    $file = fopen($filename, 'w');
		    fwrite($file, $image_data);
		    fclose($file);
		}
    }

    echo '<img src="'.$privateURL.'" width="200px" style="margin-top:10px;"><br><a href="'.$privateURL.'" target="_blank">Open Image</a> | ';
    echo '<a href="?regenImageFile='.$Token.'.png">Regenerate</a><br><br>';
    echo '<textarea class="form-control" readonly="readonly">'.$_POST["descText"].'</textarea><br><br>';
}
?>