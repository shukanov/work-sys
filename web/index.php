<?php
                                                                

if ($_SERVER['SERVER_PORT'] == '88' || $_SERVER['SERVER_ADDR'] == '192.168.100.40') {
    define("LOCALHOST", FALSE);
}
else if ($_SERVER['SERVER_PORT'] == '8443' || $_SERVER['SERVER_ADDR'] == '192.168.100.10') {
    define("LOCALHOST", TRUE);
}

if ($_SERVER['SERVER_ADDR'] == '192.168.100.40') {
    define("IS_SERVER", TRUE);
} else {
    define("IS_SERVER", FALSE);
}       

// comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';

$config = require __DIR__ . '/../config/web.php';

(new yii\web\Application($config))->run();
