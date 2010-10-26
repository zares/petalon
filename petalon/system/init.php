<?php

error_reporting(E_ALL | E_STRICT);

define('DS', DIRECTORY_SEPARATOR);
define('EXT', '.php');

define('DOC_ROOT', realpath(dirname(__FILE__).DS.'..'.DS));
define('URL_ROOT', str_replace('\\', '/', substr(DOC_ROOT, strlen(realpath($_SERVER['DOCUMENT_ROOT']))) .'/'));
define('SYS_PATH', dirname(__FILE__));

define('STORAGE_PATH', SYS_PATH.DS.'storage'.DS);
define('CONFIG_PATH', SYS_PATH.DS.'config'.DS);
define('MODEL_PATH', SYS_PATH.DS.'model'.DS);
define('VIEW_PATH', SYS_PATH.DS.'view'.DS);
define('LIB_PATH', SYS_PATH.DS.'lib'.DS);

include LIB_PATH .'moor'.DS.'Moor'.EXT;
include LIB_PATH .'Constructor'.EXT;
include LIB_PATH .'Autoloader'.EXT;
include CONFIG_PATH .'fconf'.EXT;

//** Routes for: http://localhost/petalon/

Moor::route('/petalon/', 'Controller_Demo_Home::index')
    ->route('/petalon/@method', 'Controller_Demo_Home::@method')
    ->route('/petalon/user/@method', 'Controller_Demo_User::@method')
    ->route('/petalon/manage', 'Controller_Demo_Manage::index')
    ->route('/petalon/manage/add', 'Controller_Demo_Manage::add')
    ->route('/petalon/manage/:date([0-9-]+)/edit', 'Controller_Demo_Manage::edit')
    ->route('/petalon/manage/:date([0-9-]+)/delete', 'Controller_Demo_Manage::delete')
    ->run();













