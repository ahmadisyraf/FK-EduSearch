<?php
spl_autoload_register('myAutoLoader');

function myAutoLoader($className)
{
    $path = "classes/";
    $extenstion = ".classes.php";
    $fullPath = $path . $className . $extenstion;

    include_once $fullPath;
}
?>