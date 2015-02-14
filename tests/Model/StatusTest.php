<?php

namespace Model;
//require '../vendor/autoload.php';
$loader = require __DIR__ . '/../../vendor/autoload.php';

/**
* Status test case.
*/
class StatusTest extends \PHPUnit_Framework_TestCase
{
    /**
    *
    * @var Status
    */
    private $Status;

    /**
    * Constructs the test case.
    */
    public function __construct()
    {
    }

    /**
    * Tests Status->__construct()
    */
    public function test__construct()
    {
        $this->Status = new Status("40",new \DateTime(), new \Model\User(null, "toto", password_hash("toto",PASSWORD_DEFAULT)),"status test");
        $this->assertNotNull($this->Status);
    }

    /**
    * Tests Status->getId()
    */
    public function testGetId()
    {
        $this->Status = new Status("40",new \DateTime(),new \Model\User(null, "toto", password_hash("toto",PASSWORD_DEFAULT)),"status test");
        $this->assertEquals("40", $this->Status->getId());
    }

    /**
    * Tests Status->getOwner()
    */
    public function testGetOwner()
    {
        $this->Status = new Status("40",new \DateTime(), new \Model\User(null, "toto", password_hash("toto",PASSWORD_DEFAULT)),"status test");
        $this->assertEquals("toto", $this->Status->getOwner()->getName());
    }

    /**
    * Tests Status->getText()
    */
    public function testGetText()
    {
        $this->Status = new Status("40",new \DateTime(), new \Model\User(null, "toto", password_hash("toto",PASSWORD_DEFAULT)),"status test");
        $this->assertEquals("status test", $this->Status->getText());
    }
}
