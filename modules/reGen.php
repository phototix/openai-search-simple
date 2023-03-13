<?php
if(isset($_GET["regenImageFile"])&&!empty($_GET["regenImageFile"])){
	$sizeInput = '1024x1024';
	if(isset($_GET["size"])&&!empty($_GET["size"])){
		$sizeInput = $_GET["size"];
	}

	$fileURL = "https://".$_SERVER["HTTP_HOST"]."/cache/".$_GET["regenImageFile"];
	$token = "YOUR-OPENAPI-TOKEN-KEY";

	$url = 'https://api.openai.com/v1/images/variations';
	$data = array(
	    'image' => new CURLFILE($fileURL),
	    'n' => 1,
	    'size' => $sizeInput,
	    'user' => 'testuser'
	);

	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_POST, true);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
	curl_setopt($curl, CURLOPT_HTTPHEADER, array(
	    'Authorization: Bearer ' . $token,
	    'Content-Type: multipart/form-data'
	));

	$response = curl_exec($curl);
	curl_close($curl);
}

if ($response === false) {
    echo 'Response error.<br>';
    echo $response;
} elseif(isset($_GET["regenImageFile"])&&!empty($_GET["regenImageFile"])){
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
    echo 'Orginal | New<br>';
    echo '<img src="cache/'.$_GET["regenImageFile"].'" width="200px" style="margin-top:10px;"> | ';
    echo '<img src="cache/'.$Token.'.png" width="200px" style="margin-top:10px;"><br><a href="cache/'.$Token.'.png" target="_blank">Open Image</a><br><br>';
    echo '<a href="?regenImageFile='.$Token.'.png">Regenerate</a><br><br>';
}
?>