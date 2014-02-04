<?php
/**
 * Created by PhpStorm.
 * User: Olaoye Adeyemi
 * Date: 1/22/14
 * Time: 1:11 AM
 * To change this template use File | Settings | File Templates.
 */

set_include_path(get_include_path() . PATH_SEPARATOR . './');
$dir = getcwd();
chdir(__DIR__);
require 'config.php';
require 'loader.php';
$files = Loader::load(array("../util", "../data", "../model", "../"));
foreach ($files as $file) {
    if (strpos($file, ".php")) {
        if ($file != '..//handler.php') {
            require "./" . $file;
        }
    }
};
chdir($dir);

