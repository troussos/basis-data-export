<?php


namespace troussos\basis;
require('vendor/autoload.php');

use PHPUnit_Framework_TestCase;
use troussos\basis\BasisReceiver;

/**
 * Class BasisReceiverTest
 * @package troussos\basis
 */
class BasisReceiverTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var $basisReciever BasisReciever
     */
    private $basisReciever;

    /**
     * Basic Constructor, setup a new reciever object and assign it to the class property
     *
     * @coversNothing
     */
    public function __construct()
    {
        $this->basisReciever = new BasisReceiver();
    }

    /**
     * Test making a request without any parameters
     *
     * @covers troussos\basis\BasisReceiver::makeRequest
     * @expectedException LogicException
     */
    public function testInvalidSetParamsMakeRequest()
    {
        $this->basisReciever->makeRequest();
    }

    /**
     * Make a request with an invalid user ID
     *
     * @covers troussos\basis\BasisReceiver::makeRequest
     * @expectedException RuntimeException
     */
    public function testInvalidUserIDMakeRequest()
    {
        //Ensure that the timezone has been set
        date_default_timezone_set('America/Los_Angeles');
        $user = new User('1');
        $dataURLs = new DataUrl();
        $this->basisReciever->setParameters($user, $dataURLs);
        $this->basisReciever->makeRequest();
    }

    /**
     * Check that we can set the Parameters and an error is not thrown
     *
     * @covers troussos\basis\BasisReceiver::setParameters
     */
    public function testSetParameters()
    {
        $user = new User('1');
        $dataURLs = new DataUrl();
        $this->basisReciever->setParameters($user, $dataURLs);
    }
}
