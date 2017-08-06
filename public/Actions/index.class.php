<?php
namespace Actions;

use RocketSled\Runnable;

class Index implements Runnable
{

    public function run()
    {
        echo "Homepage";
    }
}