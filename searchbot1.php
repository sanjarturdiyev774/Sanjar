<?php 
ob_start();
$API_KEY = '5335160496:AAGwkeuWSIP8DfuVFaCB3cdnzj30RkYlGcc';
define('API_KEY',$API_KEY);
function bot($method,$datas=[]){
    $url = "https://api.telegram.org/bot".API_KEY."/".$method;
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
    $res = curl_exec($ch);
    if(curl_error($ch)){
        var_dump(curl_error($ch));
    }else{
        return json_decode($res);
    }
}

$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$from_id = $message->from->id;
$chat_id = $message->chat->id;
$txt = $message->text;
$data = $update->callback_query->data;
$chat_id2 = $update->callback_query->message->chat->id;
$message_id = $update->callback_query->message->message_id;

if($txt == "/start"){
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"🔍 Qidiruv bot! \n☑️ Matn kiriting!\n",
'parse_mode'=>"Markdown",
    'reply_markup'=> json_encode([
    'inline_keyboard'=>[
    [
['text'=>"App store 🌐", 'url'=>"https://www.apple.com/us/search?q=$txt"],
],
[
['text'=>"Google 📈", 'url'=>"https://www.google.com.iq/search?q=$txt"],
],
[
['text'=>"Youtube 🎥", 'url'=>"https://m.youtube.com/results?q=$txt&sm=3"],
],
[
['text'=>"instagram 📯", 'url'=>"https://www.instagram.com/$txt"],
],

[
['text'=>"Telegram 📪", 'url'=>"https://www.telegram.me/$txt"],
],
[
['text'=>"Github 🐱", 'url'=>"https://github.com/search?utf8=✓&q=$txt"],
]
[
['text'=>''Shazam🔍'', 'url'=>''https://www.shazam.com/search?q=$txt"],
],
    ]
    ])
    ]);

    }