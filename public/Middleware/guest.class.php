<?php
namespace Middleware;

trait Guest
{
    public function __construct()
    {
        if (logged_in()) {
            return redirect('Dashboard');
        }
    }
}