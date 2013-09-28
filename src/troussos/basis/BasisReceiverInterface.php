<?php

namespace troussos\basis;

/**
 * Class BasisReceiverInterface
 * @package troussos\basis
 */
interface BasisReceiverInterface
{
    public function makeRequest();
    public function setParameters(DataUrl $dataURL, User $user);
}