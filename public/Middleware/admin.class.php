<?php
namespace Middleware;

trait Admin
{
    /**
     * Auth constructor.
     * Ensures that the user is logged in. Redirects otherwise
     */
    public function __construct()
    {
        if (!is_admin()) {
            return redirect('AdminAuth');
        }
    }
}