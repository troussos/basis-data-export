<?php

namespace troussos\basis;

/**
 * Class User
 * @package troussos\basis
 */
class User {

    /**
     * @var - Basis User ID
     */
    private $userId;

    public function __construct($id)
    {
        $this->userId = $id;
    }

    /**
     * @param mixed $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }
}