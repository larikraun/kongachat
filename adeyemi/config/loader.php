<?php
/**
 * Created by PhpStorm.
 * User: Olaoye Adeyemi
 * Date: 1/22/14
 * Time: 1:12 AM
 * To change this template use File | Settings | File Templates.
 */

class Loader{

    public static function load($directories){
        $files_output = array();
        foreach($directories as $directory){
            $files = scandir($directory);
            foreach($files as $file){
                array_push($files_output, $directory."/".$file);
            }
        }
        return $files_output;
    }

}