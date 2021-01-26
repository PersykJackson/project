<?php

function autoload(string $name)
{
    $classMap = [
        'Logger' => __DIR__.'/Logger/',
        'LoggerInterface' => __DIR__.'/Logger/',
        'LogLevel' => __DIR__.'/Logger/',
        'ProductSearcher' => __DIR__.'/',
        'LayoutLoader' => __DIR__.'/',
        'ProductFoundtException' => __DIR__.'/'
    ];
    $fileName = $name . '.php';
    include_once $classMap[$name].$fileName;
}
spl_autoload_register('autoload');