<?php
    define('__PENSEES__','');
    
    define('ROOT_PATH', __DIR__);
    define('APPLICATION_PATH', ROOT_PATH.'/application');
    define('APPLICATION_NAMESPACE', 'Pensees');
   
    //require_once 'phar://framework.phar/f3il.php';
    require_once 'framework/f3il.php';
    
    $app = F3il\Application::getInstance(APPLICATION_PATH.'/configuration.ini');
    
    $app->setDefaultController('pensees');
    $app->run();                    
    
?>