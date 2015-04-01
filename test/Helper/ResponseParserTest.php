<?php

namespace Silktide\SemRushApi\Test\Helper;

use Silktide\SemRushApi\Helper\ResponseParser;
use PHPUnit_Framework_TestCase;
use Silktide\SemRushApi\Test\ResponseExample\ResponseExampleHelper;
use Silktide\SemRushApi\Model\Request;

class ResponseParserTest extends PHPUnit_Framework_TestCase  {

    /**
     * @var ResponseParser
     */
    protected $responseParser;

    public function setup()
    {
        $this->responseParser = new ResponseParser();
    }

    public function testResponseParser()
    {
        $columns = ["Ph","Po","Pd","Tr","Tc", "Nr","Cp","Nq","Vu"];
        $request = $this->getMockBuilder('Silktide\SemRushApi\Model\Request')->disableOriginalConstructor()->getMock();
        $request->expects($this->any())->method('getExpectedResultColumns')->willReturn($columns);

        $result = $this->responseParser->parseResult($request, ResponseExampleHelper::getResponseExample('domain_adwords_argos'));
        $this->assertTrue(is_array($result));
        $this->assertEquals(1000, count($result));
        foreach ($result as $row) {
            $this->assertTrue(is_array($row));
            $this->assertEquals(9, count($row));
        }

        $this->assertStringStartsWith("http://www.argos.co.uk/static/Browse", $result[892]['Vu']);
    }

    /**
     * @return Request
     */
    protected function getDefaultRequest()
    {
        $columns = ["Ph","Po","Pp","Pd","Nq","Cp","Vu","Tr","Tc","Co","Nr","Td"];
        $request = $this->getMockBuilder('Silktide\SemRushApi\Model\Request')->disableOriginalConstructor()->getMock();
        $request->expects($this->any())->method('getExpectedResultColumns')->willReturn($columns);
        return $request;
    }

    public function testResponseParserIncorrectColumns()
    {
        $this->setExpectedException('Silktide\SemRushApi\Helper\Exception\ErroneousResponseException');
        $this->responseParser->parseResult($this->getDefaultRequest(), ResponseExampleHelper::getResponseExample('domain_rank_amazon'));
    }

    public function testResponseParserError()
    {
        $this->setExpectedException('Silktide\SemRushApi\Helper\Exception\ErroneousResponseException');
        $this->responseParser->parseResult($this->getDefaultRequest(), ResponseExampleHelper::getResponseExample('error_auth'));
    }

    public function testResponseParserNoData()
    {
        $result = $this->responseParser->parseResult($this->getDefaultRequest(), ResponseExampleHelper::getResponseExample('error_nodata'));
        $this->assertEquals([], $result);
    }

} 