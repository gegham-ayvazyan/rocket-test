<?php
$user = null;
if (!function_exists('view')) {
    function view($view_name, $title = null)
    {
        if (!strstr($view_name, '.html')) {
            $view_name .= '.html';
        }
        $viewsDir = __DIR__ . DIRECTORY_SEPARATOR . 'Views';
        $view = $viewsDir . DIRECTORY_SEPARATOR . $view_name;
        if (file_exists($view)) {
            require_once '../DOMTemplate/domtemplate.php';
            $template = new DOMTemplate(file_get_contents($view));
            $appName = APP_NAME;
            $template->setValue('#app-name', $appName);
            if ($title) {
                $title = $title . ' | ' . $appName;
            }
            $template->setValue('title', $title);
            return $template;
        }
        throw new Exception('View not found: ' . $viewsDir);
    }
}
if (!function_exists('redirect')) {
    function redirect($route)
    {
        $host = $_SERVER['HTTP_HOST'];
        $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        header("Location: http://$host$uri/?r=$route");
        exit();
    }
}
if (!function_exists('logged_in')) {
    function logged_in()
    {
        return isset($_SESSION['uid']);
    }
}

if (!function_exists('get_user')) {
    /**
     * Returns the authenticated user or null if the client guest
     * @return null|stdClass
     */
    function get_user()
    {
        global $user;
        if (logged_in()) {
            if (!$user) {
                $data = \Plusql::from(DB_CONNECTION_NAME)->user
                    ->where('user.user_id = "' . $_SESSION['uid'] . '"')
                    ->select('user_name, user_email, user_id')->run();
                if ($row = $data->nextRow()) {
                    $user = new stdClass();
                    $user->id = $row['user_id'];
                    $user->name = $row['user_name'];
                    $user->email = $row['user_email'];
                }
            }
        }
        return $user;
    }
}

if (!function_exists('dd')) {
    /**
     * @param array ...$data
     */
    function dd(... $data)
    {
        foreach ($data as $item) {
            echo "<code><pre>";
            var_dump($item);
            echo "</pre></code>";
        }
        die();
    }
}

if (!function_exists('str_random')) {
    /**
     * Generate a more truly "random" alpha-numeric string.
     * Stolen from Laravel framework
     * @param $length
     * @return string
     */
    function str_random($length)
    {
        $string = '';
        while (($len = strlen($string)) < $length) {
            $size = $length - $len;
            $bytes = random_bytes($size);
            $string .= substr(str_replace(['/', '+', '='], '', base64_encode($bytes)), 0, $size);
        }
        return $string;
    }
}

if (!function_exists('is_admin')) {
    function is_admin()
    {
        return isset($_SESSION['admin']);
    }
}