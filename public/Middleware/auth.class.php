<?php
namespace Middleware;

trait Auth
{
    public function __construct()
    {
        if (!logged_in()) {
            return redirect('Login');
        }
    }
}