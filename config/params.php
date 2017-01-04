<?php

$params = [
    'id_salt' => 'Do you know New Lesson?',
    'imageHost' => 'http://image.dakashuo.com/',
];


if (YII_ENV_DEV) {
    $params['weixin_appid'] = '';
    $params['weixin_secret'] = '';
}

return $params;