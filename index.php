<?php
/**
 * Telegram Bot access token и URL.
 */
$access_token = '246470400:AAElj-KNd6S9mTyo6wesYzyU8OrquBHQKRA';
$url = 'https://api.telegram.org/bot' . $access_token;
$output = json_decode(file_get_contents('php://input'), true);
//$lang = json_decode(file_get_contents('php://input'), true);
//$language =$output['callback_query']['data'];
$chat_id = $output['message']['chat']['id'];
$message = $output['message']['text'];
//$language = $lang['callback_query']['id'];
$fp = json_decode(file_get_contents('user.json'), true);
if(isset($output['callback_query']['data'])){

if (checkUser($fp, $output['callback_query']['message']['chat']['id']) != false) {
            foreach ( $fp as $key=> $value) {
              if($key==$output['callback_query']['message']['chat']['id']){
                 $fp[$key] = $output['callback_query']['data'];
              }
             }
             $arr3 = json_encode($fp);
             file_put_contents('user.json', $arr3);
          }
          else{
           AddUserLanguage($output['callback_query']['message']['chat']['id'],$fp,$output['callback_query']['data']);
          }

file_get_contents("https://api.telegram.org/bot246470400:AAElj-KNd6S9mTyo6wesYzyU8OrquBHQKRA/sendMessage?chat_id=".$output['callback_query']['message']['chat']['id']."&text=Language successfully changed to: ".($output['callback_query']['data'])."&parse_mode=HTML");//exit();
exit();
            
}
switch ($message) {
    case '/start':
        $message = 'Hello, i am Marvin bot.';
    sendMessage($chat_id,$message.printKeybord());
        break;
    case 'Language':
         $message = 'Choose language.';
    sendMessage($chat_id,$message.inlineKeybord());
        break;
     case 'Genegate Insult':
        checkLanguage($fp,$chat_id);
        break;
    case 'Homepage':
        $message='';
          sendMessage($chat_id,forURL());
        break;
       case 'secret Keyboard':
             $message = 'You found my secret';
        sendMessage($chat_id, $message.secretKeyboard());
         break;
         case 'Generate Secret':
                FuckYou($chat_id);
         break;
         case 'Go Back':
             $message = "Welcome back";
        sendMessage($chat_id,$message.printKeybord());
         break; 
    default:
       checkLanguage($fp, $chat_id);
}

function FuckYou($chat_id){
    $number = rand(1, 4);
    switch($number){
            case 1:
                $photo = "AgADAgADs6cxGy1h7g_4CyeuCcFzkJMjcQ0ABBH8Y3MeW8w5aUsAAgI";
            sendPhoto($chat_id, $photo);
            break;
            case 2:
                $photo = "AgADAgADsqcxGy1h7g8dBdAETGyaUaMrcQ0ABKgghyjXUQayzkoAAgI";
            sendPhoto($chat_id, $photo);
            break;
            case 3:
                $photo = "AgADAgADsacxGy1h7g9KAiIu5zjfv8g1cQ0ABGrlstN4Rt0s-0wAAgI";
            sendPhoto($chat_id, $photo);
            break;
            case 4:
                $photo = "AgADAgADsKcxGy1h7g_J-P6O8n0Gv7ogcQ0ABPODhNMNWhfrF04AAgI";
            sendPhoto($chat_id, $photo);
            break;
    }
    
}

function genegateInsult($chat_id,$lang){
    $fuck = file_get_contents("https://evilinsult.com/generate_insult.php?lang=".$lang);
    sendMessage($chat_id, $fuck);
}
function sendMessage($chat_id, $message) {
    // http://web-performers.com/bot/chatbot/conversation_start.php?say=2
    file_get_contents("https://api.telegram.org/bot246470400:AAElj-KNd6S9mTyo6wesYzyU8OrquBHQKRA/sendMessage?chat_id=".$chat_id."&text=".$message.printKeybord()."&parse_mode=HTML");
}
function checkUser($mass,$chat_id){
    $is = false;
    foreach ( $mass as $key=> $value) {
        if($key==$chat_id){
            $is = true;
        }
    }
    return $is;
}
function AddUserLanguage($chat_id,$mass,$message){
    $mass[$chat_id] = $message;
    $arr3 = json_encode($mass);
    file_put_contents('user.json', $arr3);
}
function AddUser($chat_id,$mass,$message){
    $mass[$chat_id] = $message;
    $arr3 = json_encode($mass);
    file_put_contents('user.json', $arr3);
    genegateInsult($chat_id,$message);
}
function secretKeyboard(){
        $reply_markup = '';
    $buttons = [['Go Back'],['Generate Secret']];
    $keyboard = json_encode($keyboard = [
        'keyboard' => $buttons /*[$buttons]*/,
        'resize_keyboard' => true,
        'one_time_keyboard' => false,
        'parse_mode' => 'HTML',
        'selective' => true
    ]);
    $reply_markup = '&reply_markup=' . $keyboard;
    
    return $reply_markup;
}

function checkLanguage($mass,$chat_id){
    $language = 'en';
    foreach ( $mass as $key=> $value) {
        if($key==$chat_id){
            $language = $value;
        }
    }
    genegateInsult($chat_id,$language);
}



function printKeybord(){
        $reply_markup = '';
//    $buttons = [[['text' => 'tekst',
//        'request_contact' => true ,
//        'request_location' => false ]]];
    // $buttons = ['refrefre' , 'erfre ' , 'erferf'];
    //'request_contact' => true]]];
    $buttons = [['Generate Insult'],['Language','Homepage']];
    $keyboard = json_encode($keyboard = [
        'keyboard' => $buttons /*[$buttons]*/,
        'resize_keyboard' => true,
        'one_time_keyboard' => false,
        'parse_mode' => 'HTML',
        'selective' => true
    ]);
    $reply_markup = '&reply_markup=' . $keyboard . '';
    
    return $reply_markup;
}



function languageKeybord(){
            $reply_markup = '';
//    $buttons = [[['text' => 'tekst',
//        'request_contact' => true ,
//        'request_location' => false ]]];
    // $buttons = ['refrefre' , 'erfre ' , 'erferf'];
    //'request_contact' => true]]];
    $buttons = [['Generate Insult'],['en','de'/*<---сюда*/]]; //создать текстовое описание, корое будет передаваться на сервер
    $keyboard = json_encode($keyboard = [
        'keyboard' => $buttons /*[$buttons]*/,
        'resize_keyboard' => true,
        'one_time_keyboard' => false,
        'parse_mode' => 'HTML',
        'selective' => true
    ]);
    $reply_markup = '&reply_markup=' . $keyboard . '';
    
    return $reply_markup;
    }
function inlineKeybord(){ ///Выводяться только с сообщением
$reply_markup = '';
$x1 = array('text'=>'en','callback_data'=>"en");
$x2 = array('text'=>'de','callback_data'=>"de");
$x3 = array('text'=>'ru','callback_data'=>"ru");
$x4 = array('text'=>'fr','callback_data'=>"fr");
$x5 = array('text'=>'es','callback_data'=>"es");
$x6 = array('text'=>'pt','callback_data'=>"pt");
// Создать нову переменную $xn(следующий номер), установить её опиание в поле text и добавить к ней callback_data, который будет 
// возвращаться на сервер
$opz = [[$x1,$x2,$x3,$x4],[$x5,$x6]];
$keyboard=array("inline_keyboard"=>$opz);
$keyboard = json_encode($keyboard,true);
     $reply_markup = '&reply_markup=' . $keyboard;
    return $reply_markup;
}
function sendPhoto($chat_id, $photo){
    file_get_contents("https://api.telegram.org/bot246470400:AAElj-KNd6S9mTyo6wesYzyU8OrquBHQKRA/sendphoto?chat_id=".$chat_id."&photo=".$photo);

}
function HTML(){
    $HTML = '<b>bold</b>, <strong>bold</strong>
<i>italic</i>, <em>italic</em>
<a href="https://evilinsult.com/">inline URL</a>
<code>inline fixed-width code</code>
<pre>pre-formatted fixed-width code block</pre>';
    return $HTML;
    
}
function forURL(){
    $HTML='<a href="https://evilinsult.com/">http://evilinsult.com/</a>';
    return $HTML;
}


