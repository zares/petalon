<?php

function __autoload($class)
{
    if (strstr($class, 'Controller')) {
        $controller = str_replace('_', DS, strtolower($class));
        $contr_file = SYS_PATH . DS . $controller . EXT;
        if (file_exists($contr_file)) {
		    return require $contr_file;
	    }
    }

    if (strstr($class, 'Helper')) {
        $helper = str_replace('_', DS, strtolower($class));
        $helper_file = SYS_PATH . DS . $helper . EXT;
        if (file_exists($helper_file)) {
		    return require_once $helper_file;
	    }
    }

	$flourish_file = LIB_PATH .'flourish'. DS . $class . EXT;

	if (file_exists($flourish_file)) {
		return require $flourish_file;
	}

	$model_file = MODEL_PATH . $class . EXT;

	if (file_exists($model_file)) {
		return require $model_file;
	}

	echo 'The class '. $class .' could not be loaded';
}