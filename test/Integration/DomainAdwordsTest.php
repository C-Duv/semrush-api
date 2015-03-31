<?php


namespace Silktide\SemRushApi\Integration;

use Silktide\SemRushApi\Data\Column;
use Silktide\SemRushApi\Data\Database;
use Silktide\SemRushApi\Model\Row;

class DomainAdwordsIntegrationTest extends AbstractIntegrationTest {

    public function testDomainAdwordsRequest()
    {
        $this->setupResponse('domain_adwords_argos');
        $result = $this->client->getDomainAdwords('argos.com', ['database' => Database::DATABASE_GOOGLE_US]);
        $this->verifyResult($result, 10);

        /**
         * @var Row $row
         */
        $row = $result[9];
        $this->assertEquals("home framing software", $row->getValue(Column::COLUMN_DOMAIN_KEYWORD));
    }
} 