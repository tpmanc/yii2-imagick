<?php
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'test');

require(__DIR__ . '/../vendor/autoload.php');
require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');

Yii::setAlias('@tests', __DIR__);
Yii::setAlias('@img', __DIR__ . "/../examples");
Yii::setAlias('@temp', __DIR__ . "/../temp");

\yii\helpers\FileHelper::removeDirectory(Yii::getAlias('@temp/'));
\yii\helpers\FileHelper::createDirectory(Yii::getAlias('@temp/'));

new \yii\console\Application([
    'id' => 'unit',
    'basePath' => __DIR__,
]);