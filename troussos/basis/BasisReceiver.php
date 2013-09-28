<?php

namespace troussos\basis;

use troussos\basis\User;
use troussos\basis\DataUrl;


class BasisReceiver implements BasisReciverInterface
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