<?php

namespace AndyWaite\SemRushApi\Test\Model;

use PHPUnit_Framework_TestCase;
use AndyWaite\SemRushApi\Model\Row;

class RowTest extends PHPUnit_Framework_TestCase {

    /**
     * @var Row
     */
    private $instance;

    /**
     * Set up an instance of row
     */
    public function setup()
    {
        $this->instance = new Row();
    }

    /**
     * Check we can set and get data
     *
     * @throws \AndyWaite\SemRushApi\Model\Exception\InvalidDataException
     */
    public function testSetAndGetData()
    {
        $values = [
            'Ab' => 'top',
            'Ac' => '560',
            'Ad' => 'biscuits, cookies, hobnobs'
        ];
        $this->instance->setData($values);
        $this->assertEquals($values, $this->instance->getData());
    }

    /**
     * Make sure an exception is thrown with invalid data
     *
     * @throws \AndyWaite\SemRushApi\Model\Exception\InvalidDataException
     */
    public function testSetInvalidData()
    {
        $this->setExpectedException('AndyWaite\SemRushApi\Model\Exception\InvalidDataException');
        $this->instance->setData("boot");
    }

    /**
     * Make sure an exception is thrown with invalid field name
     *
     * @throws \AndyWaite\SemRushApi\Model\Exception\InvalidFieldException
     */
    public function testSetInvalidField()
    {
        $values = [
            'Ab' => 'top',
            'Ac' => '560',
            'something' => 'biscuits, cookies, hobnobs'
        ];
        $this->setExpectedException('AndyWaite\SemRushApi\Model\Exception\InvalidFieldException');
        $this->instance->setData($values);
    }

    /**
     * Make sure getting a value returns the correct value
     * 
     * @throws \AndyWaite\SemRushApi\Model\Exception\InvalidDataException
     */
    public function testGetValue()
    {
        $values = [
            'Ab' => 'top',
            'Ac' => '560',
            'Ad' => 'biscuits, cookies, hobnobs'
        ];
        $this->instance->setData($values);

        foreach ($values as $key => $value) {
            $this->assertEquals($value, $this->instance->getValue($key));
        }
    }

}