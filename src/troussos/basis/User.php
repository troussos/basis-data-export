<?php
/**
 * @package basisExport
 */
namespace troussos\basis;

/**
 * Class User
 *
 * A class to represent the user. Currently it is not nessecary,
 * but it was built into the library in the event future expansion of
 * the user occurs.
 *
 * @see BasisReciver Basis Reciver
 *
 * @used-by BasisReciver Basis Reciver
 *
 * @author Tyler Roussos <tylerroussos@gmail.com>
 * @license GNU Public License
 * @license http://opensource.org/licenses/GPL-2.0
 * @package troussos\basis
 */
class User
{

    /**
     * @var string Basis User ID
     */
    private $_userId;

    /**
     * Set the class level userId
     *
     * @param string $id Basis User Id
     */
    public function __construct($id)
    {
        $this->_userId = $id;
    }

    /**
     * Set the class level userId
     *
     * @param string $userId My Basis User Id
     *
     * @return $this
     */
    public function setUserId($userId)
    {
        $this->_userId = $userId;

        return $this;
    }

    /**
     * Get the User Id
     *
     * @return string My Bais User Id
     */
    public function getUserId()
    {
        return $this->_userId;
    }
}