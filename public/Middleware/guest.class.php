<?php
namespace Middleware;

trait Guest
{
    /**
     * Guest constructor.
     * Ensures that the user is not logged in. Redirects otherwise
     */
    public function __construct()
    {
        if (logged_in()) {
            return redirect('Dashboard');
        } else if (is_admin()) {
            return redirect('AdminDashboard');
        }
    }
}