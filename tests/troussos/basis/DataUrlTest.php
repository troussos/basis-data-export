<?php

namespace troussos\basis;
require('vendor/autoload.php');

use PHPUnit_Framework_TestCase;
use troussos\basis\DataUrl;

/**
 * Class DataUrlTest
 * @package troussos\basis
 */
class DataUrlTest extends PHPUnit_Framework_TestCase
{

    /**
     * @var $dataURL DataUrl
     *
     * Object to test against
     */
    private $dataURL = null;

    /**
     * Creates an instance of the dataURL object to test against
     *
     * @coversNothing
     */
    public function __construct()
    {
        $this->dataURL = new DataUrl();
    }

    /**
     * Checks the validation on the setStartDate Method
     *
     * @covers troussos\basis\DataUrl::setStartDate
     * @expectedException InvalidArgumentException
     */
    public function testInvalidStartDate()
    {
        $this->dataURL->setStartDate('TEST', 'Start Date must be validated as ISO 8601');
    }

    /**
     * Checks that valid entries can be made into the setStartDate method
     *
     * @covers troussos\basis\DataUrl::setStartDate
     */
    public function testValidStartDate()
    {
        //Try with zeros prefacing the month and day
        $this->dataURL->setStartDate('2013-05-06');
        $this->assertEquals('2013-05-06', $this->dataURL->getStartDate());

        //Try without and prefixed zeros
        $this->dataURL->setStartDate('2013-3-7');
        $this->assertEquals('2013-3-7', $this->dataURL->getStartDate());

        //Try with mixed prefixes
        $this->dataURL->setStartDate('2013-01-9');
        $this->assertEquals('2013-01-9', $this->dataURL->getStartDate());
    }

    /**
     * Verify that the input is validated to be numeric
     *
     * @covers troussos\basis\DataUrl::setInterval
     * @expectedException InvalidArgumentException
     */
    public function testInvalidNumericSetInterval()
    {
        $this->dataURL->setInterval('TEST', 'Interval must be numeric');
    }

    /**
     * Verify that the minimum value of the interval is validated. It should not allow values less than 60.
     *
     * @covers troussos\basis\DataUrl::setInterval
     * @expectedException InvalidArgumentException
     */
    public function testInvalidRangeSetInterval()
    {
        $this->dataURL->setInterval(59, '59 is below the lower validation limit');
    }

    /**
     * Verify that various valid inputs are able to be passed into the setInterval method
     *
     * @covers troussos\basis\DataUrl::setInterval
     */
    public function testValidSetInterval()
    {
        //Make sure that 60 is a valid input (lower limit of the validation)
        $this->dataURL->setInterval(60);
        $this->assertEquals(60, $this->dataURL->getInterval(), '60 should be valid.');

        //Test three digit inputs
        $this->dataURL->setInterval(143);
        $this->assertEquals(143, $this->dataURL->getInterval(), '143 should be valid');

        //Another test point on the validation
        $this->dataURL->setInterval(87);
        $this->assertEquals(87, $this->dataURL->getInterval(), '87 should be valid');
    }

    /**
     * Verify that an exception is thrown if we have not set the start date
     *
     * @covers troussos\basis\DataUrl::generateRequestURL
     * @expectedException LogicException
     */
    public function testInvalidStartDateGenerateURL()
    {
        $this->dataURL->generateRequestURL('TEST');
    }

    /**
     * Check that an error is thrown if we don't pass a userID parameter
     *
     * @covers troussos\basis\DataUrl::generateRequestURL
     * @expectedException PHPUnit_Framework_Error
     */
    public function testInvalidParameterGenerateURL()
    {
        //DANGER: DO NOT CORRECT THIS LINE, IT IS SUPPOSED TO BE WRONG
        $this->dataURL->generateRequestURL();
    }

    /**
     * Check the generate URL method
     *
     * @covers troussos\basis\DataUrl::generateRequestURL
     */
    public function testValidGenerateURL()
    {
        $this->dataURL->setStartDate('2013-05-07');
        $this->assertEquals(
            'https://app.mybasis.com/api/v1/chart/USERID.json?summary=true&units=s&start_date=2013-05-07&start_offset=0&end_offset=0&heartrate=true&steps=true&calories=true&gsr=true&skin_temp=true&air_temp=true&bodystates=true',
            $this->dataURL->generateRequestURL('USERID')
        );
    }

    /**
     * Test that an error is thrown when we pass a non-array variable
     *
     * @covers troussos\basis\DataUrl::setAssessments
     * @expectedException PHPUnit_Framework_Error
     */
    public function testInvalidSetAssessments()
    {
        $this->dataURL->setAssessments('TEST', 'Assessments dose not validate the input as an array');

    }

    /**
     * Test that an exception is thrown when we pass in an invalid array
     *
     * @covers troussos\basis\DataUrl::setAssessments
     * @expectedException OutOfBoundsException
     */
    public function testInvalidArraySetAssessments()
    {
        $this->dataURL->setAssessments(array('TEST'),'Assessments dose not validate the input array.');
    }


    /**
     * Validate that we can update the assessments property and that it maintains the initialized values, if they
     * are not updated.
     *
     * @covers troussos\basis\DataUrl::setAssessments
     */
    public function testValidSetAssessments()
    {
        //Validate the initial keys in the assessments array
        $this->assertArrayHasKey(
            'heartrate',
            $this->dataURL->getAssessments(),
            'Assessments array dose not have a heartrate key'
        );

        //Validate the initial keys in the assessments array
        $this->assertArrayHasKey(
            'steps',
            $this->dataURL->getAssessments(),
            'Assessments array dose not have a steps key'
        );

        //Validate the initial keys in the assessments array
        $this->assertArrayHasKey(
            'calories',
            $this->dataURL->getAssessments(),
            'Assessments array dose not have a calories key'
        );

        //Validate the initial keys in the assessments array
        $this->assertArrayHasKey(
            'gsr',
            $this->dataURL->getAssessments(),
            'Assessments array dose not have a gsr key'
        );

        //Validate the initial keys in the assessments array
        $this->assertArrayHasKey(
            'skin_temp',
            $this->dataURL->getAssessments(),
            'Assessments array dose not have a skin_temp key'
        );

        //Validate the initial keys in the assessments array
        $this->assertArrayHasKey(
            'air_temp',
            $this->dataURL->getAssessments(),
            'Assessments array dose not have a air_temp key'
        );

        //Validate the initial keys in the assessments array
        $this->assertArrayHasKey(
            'bodystates',
            $this->dataURL->getAssessments(),
            'Assessments array dose not have a bodystates key'
        );

        //Validate the initialized values in assessments
        $assessments = $this->dataURL->getAssessments();
        
        $this->assertEquals('1', $assessments['gsr']);
        $this->assertEquals('1', $assessments['air_temp']);
        $this->assertEquals('1', $assessments['heartrate']);
        $this->assertEquals('1', $assessments['steps']);
        $this->assertEquals('1', $assessments['calories']);
        $this->assertEquals('1', $assessments['skin_temp']);
        $this->assertEquals('1', $assessments['bodystates']);

        $this->dataURL->setAssessments(
            array(
                'heartrate' => false,
                'gsr' => false,
                'air_temp' => false
            ));

        //Validate that the settings are maintained after setting assessments
        $assessments = $this->dataURL->getAssessments();
        
        $this->assertEquals('', $assessments['gsr']);
        $this->assertEquals('', $assessments['air_temp']);
        $this->assertEquals('', $assessments['heartrate']);
        $this->assertEquals('1', $assessments['steps']);
        $this->assertEquals('1', $assessments['calories']);
        $this->assertEquals('1', $assessments['skin_temp']);
        $this->assertEquals('1', $assessments['bodystates']);
    }
}
