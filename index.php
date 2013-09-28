<?php
namespace troussos\basis;

require_once('vendor/autoload.php');

use troussos\basis\DataUrl;
use troussos\basis\User;

$user = new User('i');

$dataURL = new DataUrl;
echo $dataURL->generateRequestURL('5');
?>