<?php
if (!function_exists('view')) {
    function view($view_name)
    {
        if (!strstr($view_name, '.html')) {
            $view_name .= '.html';
        }
        $viewsDir = __DIR__ . DIRECTORY_SEPARATOR . 'Views';
        $view = $viewsDir . DIRECTORY_SEPARATOR . $view_name;
        if (file_exists($view)) {
            require_once '../DOMTemplate/domtemplate.php';
            return new DOMTemplate(file_get_contents($view));
        }
        throw new Exception('View not found: ' . $viewsDir);
    }
}