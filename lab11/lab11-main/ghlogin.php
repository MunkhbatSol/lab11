<?php
// Get the temporary GitHub code from the request query parameters

$CLIENT_ID = 'eaecf4f015dba3b16844';
$CLIENT_SECRET = '6e15f0364cb04b3ed5ac249a17d00b2a436797a4';

$sessionCode = $_GET['code'];

// Use cURL to make a POST request to GitHub to get an access token
$curl = curl_init();

curl_setopt($curl, CURLOPT_URL, 'https://github.com/login/oauth/access_token');
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Accept: application/json'));
curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query([
    'client_id' => $CLIENT_ID,
    'client_secret' => $CLIENT_SECRET,
    'code' => $sessionCode,
]));
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$result = curl_exec($curl);
curl_close($curl);

// Extract the access token and granted scopes from the JSON response
$jresult = json_decode($result, true);
$accessToken = $jresult['access_token'];

setcookie('access_token', $accessToken, 0, '/');
// echo "the code is " + $sessionCode;

?>

<!-- <pre>

    <?php
    echo $result;
    ?>
</pre> -->

<span></span>