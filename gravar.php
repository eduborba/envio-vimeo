<?php

use Vimeo\Vimeo;

require_once "vendor/autoload.php";

define('CLIENT_ID', '4d467ac27ed8304ca246f18cfc8d840c6c87a3ab');
define('CLIENT_SECRET', 'TsxkMuveDngy0OaFBhVP9eqEbbf2x34qAOWv2UbRxuSErkx29ekj0RYlEJldYTUhf4B8bUDwKOGR6Mpk5iUhlDei0WZQWBLRdSRQZeZtdeR4hxXFjVhBM77YiVUlTg6c');
define('CLIENT_TOKEN', 'f626f26d3ac78ce95bba4e14afa27d0b');

$vimeo = new Vimeo(CLIENT_ID, CLIENT_SECRET, CLIENT_TOKEN);

$video_uri = $vimeo->upload($_FILES['data']['tmp_name'], array(
    'name' => $_POST['fileName'],
    'privacy' => [
        'embed' => 'public',
        'view' => 'anybody'
    ],
)); 

$upload_status = $vimeo->request($video_uri . '?fields=transcode.status');
$video_resp = $vimeo->request($video_uri . '?fields=link');
$video_url = $video_resp['body']['link'];

echo "URL Vídeo: {$video_url} Status: ${$upload_status['body']['transcode']['status']}";