<?php
/**
 * Created by JetBrains PhpStorm.
 * User: tylerroussos
 * Date: 9/27/13
 * Time: 10:15 PM
 * To change this template use File | Settings | File Templates.
 */

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