<?php
set_time_limit(0);

if (!file_exists('madeline.php')) {
    copy('https://phar.madelineproto.xyz/madeline.php', 'madeline.php');
}
include 'madeline.php';

$bot ="YouTubeDownloaderBot";

 


$MadelineProto = new \danog\MadelineProto\API('session.madeline');
$MadelineProto->start();


if(isset($_GET["url"]) && isset($_GET["chat_id"]) && isset($_GET["type"])){

shell_exec("wget -O '".$_GET['chat_id'].".".$_GET["type"]."' '".$_GET["url"]."'");


if($_GET["type"] == "mp4"){	
$MadelineProto->messages->sendMedia([
    'peer' =>$_GET["chat_id"],
    'media' => [
        '_' => 'inputMediaUploadedDocument',
        'file' => $_GET["chat_id"].'.mp4',
        'attributes' => [
            ['_' => 'documentAttributeVideo', 'round_message' => false, 'supports_streaming' => true]
        ]
    ],
    'message' => $bot,
    'parse_mode' => 'html'
]);
	@unlink($_GET["chat_id"].'.mp4');
	
	}elseif($_GET["type"] == "mp3"){
		
		
 $MadelineProto->messages->sendMedia([
    'peer' =>$_GET["chat_id"],
    'media' => [
        '_' => 'inputMediaUploadedDocument',
        'file' => $_GET["chat_id"].'.mp3',
        'attributes' => [
            ['_' => 'documentAttributeAudio', 'voice' => false, 'title' => $botname, 'performer' => $_GET["chat_id"]]
        ]
    ],
    'message' => $bot,
    'parse_mode' => 'html'
]);


@unlink($_GET["chat_id"].'.mp3');
}
}

unlink("MadelineProto.log");
unlink("session.madeline");

?>
