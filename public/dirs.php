<?php
// UNCOMMENT THE FOLLOWING LINE TO SEE THE HOSTNAME OF YOUR COMPUTER
// die(php_uname('n'));

// ADD ADDITIONAL HOSTS TO THE $dirs ARRAY BELOW FOR VARIOUS DEPLOYMENT
// ENVIRONMENTS

require_once ('helpers.php');

$dirs = [
    'DESKTOP-EIEETGL' => [
        'libs' => '../', // where any external libraries are installed
        'rs' => '../', // where the RocketSled package is installed
        'userland' => '../', // where my application packages are installed
        'Actions' => './'
    ],
];

$current_hostname = php_uname('n');
