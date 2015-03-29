<?php


namespace AndyWaite\SemRushApi\Test\Data;

use AndyWaite\SemRushApi\Data\Column;
use PHPUnit_Framework_TestCase;

class ColumnTest extends PHPUnit_Framework_TestCase {

    public function testGetColumns()
    {
        $columns = Column::getColumns();
        $this->assertEquals(9, count($columns));
    }

    public function testIsValidColumn()
    {
        $this->assertTrue(Column::isValidColumn("At"));
        $this->assertFalse(Column::isValidColumn("Invalid"));
    }

} 