<?php
namespace troussos\basis;

use troussos\basis\DataUrl;
use troussos\basis\User;

spl_autoload_register(function ($class) {
    include str_replace("\\", "/", $class) . '.php';
});
$user = new User('i');

$dataURL = new DataUrl;
echo $dataURL->generateRequestURL('5');
?>