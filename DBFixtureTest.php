<?php
require_once "AccessLog.php";

class DBFixtureTest extends PHPUnit_Extensions_Database_TestCase {

    protected $pdo;

    public function getConnection() {
        $this->pdo = new PDO('sqlite::memory:');
        AccessLog::createTable($this->pdo);
        return $this->createDefaultDBConnection($this->pdo, ':memory:');
    }

    public function getDataSet() {
        return $this->createFlatXMLDataSet(dirname(__FILE__).'/access_log.xml');
    }

    public function testCountAllDataShouldFound4Records() {
        $accessLog = new AccessLog();
        $accessLog->setPDO($this->pdo);
        $this->assertEquals(5, $accessLog->countLogAll());
    }

    public function testDeleteDataShouldFound1Records() {
        $accessLog = new AccessLog();
        $accessLog->setPDO($this->pdo);
        $remainRow = $accessLog->deleteLogByID(1);
        $this->assertEquals(4, $remainRow);
    }

}
?>