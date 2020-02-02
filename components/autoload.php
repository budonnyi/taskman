<?php

//function to call methods from components and models directories
function autoload($class_name)
{
    $array_path = array(
        '/components/',
        '/models/'
    );

    foreach ($array_path as $path) {
        $path = ROOT . $path . $class_name . '.php';

        if (is_file($path)) {
            include_once $path;
        }
    }
}

spl_autoload_register('autoload');
