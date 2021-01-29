<?php

function autoload(string $name)
{
    $classMap = [
        'Logger' => __DIR__ . '/App/Helpers/Logger/',
        'LoggerInterface' => __DIR__ . '/App/Helpers/Logger/',
        'LogLevel' => __DIR__ . '/App/Helpers/Logger/',
        'ProductSearcher' => __DIR__.'/App/Model/',
        'LayoutLoader' => __DIR__.'/App/Helpers/',
        'ProductFoundtException' => __DIR__.'/App/Helpers/Exceptions/',
        'Router' => __DIR__.'/Router/',
        'MainController' => __DIR__.'/App/Controller/',
        'Controller' => __DIR__.'/App/Controller/',
        'View' => __DIR__.'/App/View/',
        'BadRouteException' => __DIR__.'/App/Helpers/Exceptions/',
        'ProductStorage' => __DIR__.'/App/Model/',
        'Product' => __DIR__.'/App/Model/',
        'AccountController' => __DIR__.'/App/Controller/',
        'StorageException' => __DIR__.'/App/Helpers/Exceptions/'
    ];
    $fileName = $name . '.php';
    include_once $classMap[$name].$fileName;
}
spl_autoload_register('autoload');