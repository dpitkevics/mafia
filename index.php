<?php

error_reporting(E_ALL);
ini_set('error_reporting', E_ALL);

date_default_timezone_set('Europe/Helsinki');

include dirname(__FILE__) . '/core/globals.php';
include dirname(__FILE__) . '/core/Base.php';

/**
 * Izveidojam pašu aplikāciju un palaižam
 */
$base = new core\Base();
$base->Run();
