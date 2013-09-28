<?php


namespace troussos\basis;
require('vendor/autoload.php');

use PHPUnit_Framework_TestCase;
use troussos\basis\User;

/**
 * Class UserTest
 * @package troussos\basis
 */
class UserTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @User - User object to test against
     */
    private $user = null;

    /**
     * Setup the class level user object for tests
     */
    public function __construct()
    {
        $this->user = new User('TEST');
    }

    /**
     * Check the constructor
     */
    public function testConstruct()
    {
        $user = new User('function level');
        $this->assertEquals('function level', $user->getUserId());
    }

    /**
     * Make sure that that initialized userID is saved
     */
    public function testGetID()
    {
        $this->assertEquals('TEST', $this->user->getUserId());
    }

    /**
     * Check that the userID can be updated
     */
    public function testSetID()
    {
        $this->user->setUserId('Another ID');
        $this->assertEquals('Another ID', $this->user->getUserId());
    }
}