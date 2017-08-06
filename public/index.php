<?php
session_start();
require_once('config.php');
//OVERRIDE THE DEFAULT AUTOLOAD TO PREVENT REPEATED
//DIRECTORY SCANNING IN A PRODUCTION ENVIRONMENT
RocketSled::autoload(DataBank::autoload());

//RUN THAT SHIT! http://www.youtube.com/watch?v=N_PX3DWH0nE
try {
    RocketSled::run();
} catch (Exception $e) {
    if ($e instanceof ReflectionException) {
        header("HTTP/1.0 404 Not Found");
        echo view('error', 'Page Not Found');
    } else if ($e instanceof EmptySetException) {
        dd($e);
        // nothing found in the database
    } else {
        dd($e);
        header("HTTP/1.0 500 Internal Server Error");
        echo view('error', 'That\'s 500. Shame on us.');
    }
}
