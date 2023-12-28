<?php


$curl = curl_init();

$accessToken = $_COOKIE['access_token'];

curl_setopt($curl, CURLOPT_URL, 'https://api.github.com/user/emails');
// curl_setopt($curl, CURLOPT_POST, true);

$headers = [
    'Accept: application/json',
    'Authorization: Bearer ' . $accessToken,
    'X-GitHub-Api-Version: 2022-11-28',
    'User-Agent: mybrowser'
];

curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
// curl_setopt($curl, CURLOPT_, http_build_query([
//     'client_id' => $CLIENT_ID,
//     'client_secret' => $CLIENT_SECRET,
//     'code' => $sessionCode,
// ]));
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$result = curl_exec($curl);
curl_close($curl);

$emails_jarr = json_decode($result, true);

$emails = [];

foreach ($emails_jarr as $item) {
    if (isset($item['email'])) {
        $emails[] = $item['email'];
    }
}


?>

<div>

    <?php

    $allowed_email = array('nyambayar2014@gmail.com', 'ptulgaa@num.edu.mn');

    foreach ($emails as $email) {
        if (in_array($email, $allowed_email)) {
            echo "Welcome, $email! This is the restricted page.";
            $k = 1;
        }
    }

    if ($k != 1) {
        echo "Access denied.";
    }


    ?>


    <!-- <?php print_r(implode(',', $emails)) ?></div> -->

    <!-- <pre><?php print_r($result) ?></pre> -->