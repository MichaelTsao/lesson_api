<?php

$params = [
    'id_salt' => 'Do you know New Lesson?',
    'imageHost' => 'http://image.dakashuo.com/',
];


if (YII_ENV_DEV) {
    $params['weixin_appid'] = 'wxbd04c6f3a4768d5d';
    $params['weixin_secret'] = 'f5214b4c4e803229d524b844b640cd26';
}

return $params;