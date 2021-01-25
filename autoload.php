<?php
function autoload(string $name)
{
    $fileName = $name . '.php';
    include_once $fileName;
}
spl_autoload_register('autoload');