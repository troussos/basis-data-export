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
    private $user = null;

    /**
     * @DataUrl
     */
    private $dataURL = null;

    /**
     * Initialize the User and DataURL variables.
     *
     * This method must be called prior to calling make requests, otherwise an exception is thrown.
     *
     * @param User $user
     * @param DataUrl $dataURL
     */
    public function setParameters(User $user, DataUrl $dataURL)
    {
        $this->user = $user;
        $this->dataURL = $dataURL;
    }

    public function makeRequest()
    {
        //Has setParameters been called?
        if(is_null($this->user) || is_null($this->dataURL))
        {
            //If not, then throw an exception
            throw new \LogicException('Parameters must be set before making a request');
        }

        //Try to generate the URL
        try
        {
            $url = $this->dataURL->generateRequestURL($this->user->getUserId());
        }
        catch (\Exception $e)
        {
            //Check if the exception being thrown is because we have not set a start date.
            if($e->getCode() === 45)
            {
                //If that's the case, then set a generic start date to yesterday
                $this->dataURL->setStartDate(date('Y-m-d', strtotime('-1 day', time())));
                $url = $this->dataURL->generateRequestURL($this->user->getUserId());
            }
            else
            {
                //Otherwise rethrow the exception
                throw $e;
            }
        }

        return $this->performBasisRequest($url);
    }

    /**
     * Makes a request for data from the MyBasis website based on the formed URL
     *
     * @param $url
     * @return mixed
     * @throws \RuntimeException
     */
    private function performBasisRequest($url)
    {
        //Creat a CURL object
        $ch = curl_init($url);

        //Setup the CURL Parameters
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, 0);

        //Make the CURL request and pull the response code
        $responseData = curl_exec($ch);
        $responseCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        //Close the CURL object
        curl_close($ch);

        //If the response code is not a 200 (success), then throw an error
        if($responseCode === 404)
        {
            throw new \RuntimeException('Invalid UserID');
        }
        elseif ($responseCode !== 200)
        {
            throw new \RuntimeException('Error retrieving Basis Data - Server Responded with a Response Code of ' . $responseCode);
        }
        else
        {
            return $responseData;
        }
    }
}