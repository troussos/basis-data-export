<?php
namespace troussos\basis;

require_once('vendor/autoload.php');

use troussos\basis\BasisReceiver;
use troussos\basis\User;
use troussos\basis\DataUrl;

$user = new User('1');

$urls = new DataUrl();

$basis = new BasisReceiver();
$basis->setParameters($user, $urls);
$basis->makeRequest();
?>