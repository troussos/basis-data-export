<?php
/**
 * Created by JetBrains PhpStorm.
 * User: tylerroussos
 * Date: 9/27/13
 * Time: 9:50 PM
 * To change this template use File | Settings | File Templates.
 */

namespace troussos\basis;


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