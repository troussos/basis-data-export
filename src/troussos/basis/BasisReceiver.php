<?php

namespace troussos\basis;

use troussos\basis\User;
use troussos\basis\DataUrl;

/**
 * Class BasisReceiver
 * @package troussos\basis
 */
class BasisReceiver
{

    /**
     * @User
     */
    private $user;

    /**
     * @DataURL
     */
    private $dataURL;

    public function setParameters(User $user, DataUrl $dataURL)
    {
        $this->user = $user;
        $this->dataURL = $dataURL;
    }
}