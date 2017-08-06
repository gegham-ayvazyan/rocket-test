<?php
namespace Middleware;

trait Auth
{
    /**
     * Auth constructor.
     * Ensures that the user is logged in. Redirects otherwise
     */
    public function __construct()
    {
        if (!logged_in()) {
            return redirect('Login');
        }
    }
}