<?php
//REQUIRED CONFIG FILES

/** Help Functions */
require_once('helpers.php');
/** Directories Configurations */
$dirsConfig = require_once('config/dirs.php');
/** Database Configurations */
$dbConfig = require_once('config/db.php');

if (!defined('CURRENT_HOSTNAME')) {
    $hostName = php_uname('n');
    if (!isset($dirsConfig[$hostName])) {
        $hostName = 'default';
    }
    define('CURRENT_HOSTNAME', $hostName);
}
if (!defined('DB_CONNECTION_NAME')) {
    define('DB_CONNECTION_NAME', 'default');
}

require_once($dirsConfig[CURRENT_HOSTNAME]['rs'] . 'RocketSled/rocket_sled.class.php');

include_once($dirsConfig[CURRENT_HOSTNAME]['rs'] . 'DataBank/data_bank.class.php');

RocketSled::scan($dirsConfig[CURRENT_HOSTNAME]);

Plusql::credentials(DB_CONNECTION_NAME, $dbConfig[CURRENT_HOSTNAME]);
$dbConnection = DB_CONNECTION_NAME;