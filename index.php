<?php
require_once('./vendor/autoload.php');
// Namespace
use \LINE\LINEBot\HTTPClient\CurlHTTPClient;
use \LINE\LINEBot;
use \LINE\LINEBot\MessageBuilder\TextMessageBuilder;
$channel_token =
'tr6vKAmKQ2YRb6yjJhk51z66cbYNH2SxXxkiuKBm8lV9y/CD5g9jgzd6VJRDw2nkw2/7c6zTAoIjssHVwY8sYkA5kOtKDbsXvlgDO3UZqlOBY2Dj359cT3hK5Xzhws0Jh0b1lbVOePJfha5RgjdbagdB04t89/1O/w1cDnyilFU=';
$channel_secret = '078a5fe04f800b4cbd40150f4c8fd1b9';
// Get message from Line API
$content = file_get_contents('php://input');
$events = json_decode($content, true);
if (!is_null($events['events'])) {
// Loop through each event
foreach ($events['events'] as $event) {
// Line API send a lot of event type, we interested in message only.
if ($event['type'] == 'message') {
switch($event['message']['type']) {
case 'text':
// Get replyToken
$replyToken = $event['replyToken'];
// Reply message
$respMessage = 'Hello, your message is '. $event['message']['text'];
$httpClient = new CurlHTTPClient($channel_token);
$bot = new LINEBot($httpClient, array('channelSecret' => $channel_secret));
$textMessageBuilder = new TextMessageBuilder($respMessage);
$response = $bot->replyMessage($replyToken, $textMessageBuilder);
break;
}
}
}
}
echo "OK";
