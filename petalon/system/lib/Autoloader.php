<?php

include LIB_PATH.'flourish'.DS.'fLoader'.EXT;

fLoader::lazy();

spl_autoload_register(array('Autoloader', 'auto_load'));

class Autoloader {

    static public function auto_load($class)
    {
        if (strstr($class, 'Controller'))
        {
            $controller = str_replace('_', DS, strtolower($class));
            $cntr_file = SYS_PATH.DS.$controller.EXT;

            if (file_exists($cntr_file))
            {
                return require $cntr_file;
            }
        }

        if (strstr($class, 'Helper'))
        {
            $helper = str_replace('_', DS, strtolower($class));
            $helper_file = SYS_PATH.DS.$helper.EXT;

            if (file_exists($helper_file))
            {
                return require_once $helper_file;
            }
        }

        $model_file = MODEL_PATH.$class.EXT;

        if (file_exists($model_file))
        {
            return require $model_file;
        }

        echo 'The class '. $class .' could not be loaded';
    }

} // END class Autoloader
