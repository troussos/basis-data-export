<?php


namespace troussos\basis;
require('vendor/autoload.php');

use PHPUnit_Framework_TestCase;
use troussos\basis\BasisReceiver;

class BasisReceiverTest extends \PHPUnit_Framework_TestCase
{

    private $basisReciever;


    public function __construct()
    {
        $this->basisReciever = new BasisReceiver();
    }

    /**
     * @expectedException LogicException
     */
    public function testInvalidSetParamsMakeRequest()
    {
        $this->basisReciever->makeRequest();
    }

    /**
     * @expectedException RuntimeException
     */
    public function testInvalidUserIDMakeRequest()
    {
        $user = new User('1');
        $dataURLs = new DataUrl();
        $this->basisReciever->setParameters($user, $dataURLs);
        $this->basisReciever->makeRequest();
    }
}
