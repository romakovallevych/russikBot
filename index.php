<?php
$token = "246470400:AAElj-KNd6S9mTyo6wesYzyU8OrquBHQKRA";
$url  = "https://api.telegram.org/bot".$token;
//$update = file_get_contents($url."/getupdates");
//$result = json_decode($_POST, TRUE);
//$id = $_SERVER["result"][0]["message"]["chat"]["id"];
$output = @file_get_contents('php://input');
$chat_id = $output['message']['chat']['id'];
print_r("id = ", $chat_id);
//echo curl_version(); 
//////////ВАЖНО /////
$fuck = file_get_contents('https://evilinsult.com/generate_insult.php?lang=en');
//echo $update;
$update = file_get_contents($url."/sendmessage?chat_id=267280685&text=$fuck");