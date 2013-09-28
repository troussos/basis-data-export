<?php
/**
 * Created by JetBrains PhpStorm.
 * User: tylerroussos
 * Date: 9/27/13
 * Time: 10:15 PM
 * To change this template use File | Settings | File Templates.
 */

namespace troussos\basis;


interface BasisReceiverInterface
{
    public function makeRequest();
    public function setParameters(DataUrl $dataURL, User $user);
}