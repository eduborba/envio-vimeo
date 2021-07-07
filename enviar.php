<?php

require_once "vendor/autoload.php";

define('VIMEO_CLIENT_ID', '4d467ac27ed8304ca246f18cfc8d840c6c87a3ab');
define('VIMEO_CLIENT_SECRET', 'TsxkMuveDngy0OaFBhVP9eqEbbf2x34qAOWv2UbRxuSErkx29ekj0RYlEJldYTUhf4B8bUDwKOGR6Mpk5iUhlDei0WZQWBLRdSRQZeZtdeR4hxXFjVhBM77YiVUlTg6c');
define('VIMEO_CLIENT_TOKEN', 'f626f26d3ac78ce95bba4e14afa27d0b');

$vimeo = new \Vimeo\Vimeo(VIMEO_CLIENT_ID, VIMEO_CLIENT_SECRET, VIMEO_CLIENT_TOKEN);

$video_uri = $vimeo->upload($_FILES['video']['tmp_name'], array(
    'name' => $_POST['titulo'],
    'description' => $_POST['desc'],
    'privacy' => [
        'view' => 'anybody'
    ],
));

$video_resp = $vimeo->request($video_uri . '?fields=link');
$video_url = $video_resp['body']['link'];

$response = new stdClass();
$response->link = $video_url;

echo json_encode($response);