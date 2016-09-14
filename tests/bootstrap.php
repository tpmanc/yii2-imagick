<?php

require(__DIR__ . '/../vendor/autoload.php');

define("TEMP_DIR", realpath(__DIR__ . '/../temp/'));
define("IMG_DIR", realpath(__DIR__ . '/../examples/'));

if (is_dir(TEMP_DIR)) {
    rmdir(TEMP_DIR);
}
mkdir(TEMP_DIR);
