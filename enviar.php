<?php

use Vimeo\Exceptions\VimeoException;
use Vimeo\Exceptions\VimeoUploadException;

require_once "vendor/autoload.php";

define('VIMEO_CLIENT_ID', '4d467ac27ed8304ca246f18cfc8d840c6c87a3ab');
define('VIMEO_CLIENT_SECRET', 'TsxkMuveDngy0OaFBhVP9eqEbbf2x34qAOWv2UbRxuSErkx29ekj0RYlEJldYTUhf4B8bUDwKOGR6Mpk5iUhlDei0WZQWBLRdSRQZeZtdeR4hxXFjVhBM77YiVUlTg6c');
define('VIMEO_CLIENT_TOKEN', 'f626f26d3ac78ce95bba4e14afa27d0b');

try {

    $vimeo = new \Vimeo\Vimeo(VIMEO_CLIENT_ID, VIMEO_CLIENT_SECRET, VIMEO_CLIENT_TOKEN);

    $video_uri = $vimeo->upload($_FILES['video']['tmp_name'], array(
        'privacy' => [
            'view' => 'anybody'
        ],
        'embed' => [
            'title' => [
                'owner' => 'hide',
                'name' => 'hide'
            ],
            'logos' => [
                'vimeo' => false,
                'custom' => [
                    'active' => false
                ]
            ],
            'buttons' => [
                'share' => false,
                'embed' => false
            ]
        ]
    ));

    $upload_status = $vimeo->request($video_uri . '?fields=transcode.status');
    $video_resp = $vimeo->request($video_uri . '?fields=link');
    $video_url = $video_resp['body']['link'];

    $response = new stdClass();
    $response->link = $video_url;
    $response->status = $upload_status['body']['transcode']['status'];

    echo json_encode($response);

} catch (VimeoUploadException $e) {
    die('{"error": "Falha ao enviar: ' . $e->getMessage() . '"}');
} catch (VimeoException $e) {
    die('{"error": "Falha com a biblioteca: ' . $e->getMessage() . '"}');
}