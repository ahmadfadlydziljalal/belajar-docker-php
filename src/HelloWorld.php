<?php

namespace App;

class  HelloWorld
{
    public function say(): string
    {
        return "Hello World" . PHP_EOL;
    }

    public function phpInfo()
    {
        return phpinfo();
    }
}
