<?php

require_once "vendor/autoload.php";

define('VIMEO_CLIENT_ID', '');
define('VIMEO_CLIENT_SECRET', '');
define('VIMEO_CLIENT_TOKEN', '');

$vimeo = new \Vimeo\Vimeo(VIMEO_CLIENT_ID, VIMEO_CLIENT_SECRET, VIMEO_CLIENT_TOKEN);

$video_uri = $vimeo->upload($_FILES['video']['tmp_name'], array(
    'name' => $_POST['titulo'],
    'description' => $_POST['desc'],
    'privacy' => [
        'view' => 'nobody'
    ],
));

$video_resp = $vimeo->request($video_uri . '?fields=link');
$video_url = $video_resp['body']['link'];

echo $video_url;
