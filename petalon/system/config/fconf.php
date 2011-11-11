<?php

fTimestamp::setDefaultTimezone("America/Chicago");

fCore::enableErrorHandling(STORAGE_PATH.'logs'.DS.'errors.log');
fCore::enableExceptionHandling(STORAGE_PATH.'logs'.DS.'exceptions.log');

//fCore::enableErrorHandling('html');
//fCore::enableExceptionHandling('html');
//fCore::enableExceptionHandling('html', array($templating, 'place'), array('footer'));

//fCore::disableContext();

fSession::setPath(STORAGE_PATH.'session'.DS);
fSession::setLength('180 minutes');

fAuthorization::setLoginPage(URL_ROOT.'user/log_in');

$db = new fDatabase('sqlite', STORAGE_PATH.'db'.DS.'northshorewebgeeks.db');
fORMDatabase::attach($db);