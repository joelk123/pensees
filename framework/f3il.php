<?php

namespace F3il;
session_start();
define('__F3IL__', '');
require_once __DIR__ . '/autoloader.php';

if (!defined('ROOT_PATH')) {
    \F3il\AutoLoader::getInstance('','');
    throw new Error("Constante non définie : ROOT_PATH");
}
if (!defined('APPLICATION_PATH')) {
    \F3il\AutoLoader::getInstance('','');
    throw new Error("Constante non définie : APPLICATION_PATH");
}
if (!defined('APPLICATION_NAMESPACE')) {
    \F3il\AutoLoader::getInstance('','');
    throw new Error("Constante non définie : APPLICATION_NAMESPACE");
}
\F3il\AutoLoader::getInstance(APPLICATION_PATH, APPLICATION_NAMESPACE);



