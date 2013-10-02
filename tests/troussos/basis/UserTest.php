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
     * @var $user User
     *
     * User object to test against
     */
    private $user = null;

    /**
     * Setup the class level user object for tests
     *
     * @coversNothing
     */
    public function __construct()
    {
        $this->user = new User('TEST');
    }

    /**
     * Check the constructor
     *
     * @covers troussos\basis\User::__construct
     */
    public function testConstruct()
    {
        $user = new User('function level');
        $this->assertEquals('function level', $user->getUserId());
    }

    /**
     * Make sure that that initialized userID is saved
     *
     * @covers troussos\basis\User::getUserId
     */
    public function testGetID()
    {
        $this->assertEquals('TEST', $this->user->getUserId());
    }

    /**
     * Check that the userID can be updated
     *
     * @covers troussos\basis\User::setUserId
     */
    public function testSetID()
    {
        $this->user->setUserId('Another ID');
        $this->assertEquals('Another ID', $this->user->getUserId());
    }
}