<?php
//REQUIRED CONFIG FILES

/** Help Functions */
require_once('helpers.php');
/** Directories Configurations */
$dirsConfig = require_once('config/dirs.php');
/** Database Configurations */
$db = require_once('config/db.php');

if (!defined('CURRENT_HOSTNAME')) {
    $hostName = php_uname('n');
    if (!isset($dirsConfig[$hostName])) {
        $hostName = 'default';
    }
    define('CURRENT_HOSTNAME', $hostName);
}
if (!defined('DB_CONNECTION_NAME')) {
    $hostName = php_uname('n');
    if (!isset($db[$hostName])) {
        $hostName = 'default';
    }
    define('DB_CONNECTION_NAME', $hostName);
}
if (!defined('APP_NAME')) {
    define('APP_NAME', 'RocketSled Test');
}

require_once($dirsConfig[CURRENT_HOSTNAME]['rs'] . 'RocketSled/rocket_sled.class.php');

include_once($dirsConfig[CURRENT_HOSTNAME]['rs'] . 'DataBank/data_bank.class.php');

RocketSled::scan($dirsConfig[CURRENT_HOSTNAME]);
$dbConfig = $db[DB_CONNECTION_NAME];
Plusql::credentials(DB_CONNECTION_NAME, [$dbConfig['host'], $dbConfig['username'], $dbConfig['password'], $dbConfig['database']]);
$dbConnection = DB_CONNECTION_NAME;