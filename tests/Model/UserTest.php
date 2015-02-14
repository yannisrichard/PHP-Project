<?php

namespace Model;
//require '../vendor/autoload.php';
$loader = require __DIR__ . '/../../vendor/autoload.php';

/**
* User test case.
*/
class UserTest extends \PHPUnit_Framework_TestCase
{
    /**
    *
    * @var User
    */
    private $User;

    /**
    * Constructs the test case.
    */
    public function __construct()
    {
    }

    /**
    * Tests User->__construct()
    */
    public function test__construct()
    {
        $this->User = new User(null, "toto", password_hash("toto",PASSWORD_DEFAULT));
        $this->assertNotNull($this->User);
    }

    /**
    * Tests User->getId()
    */
    public function testGetId()
    {
        $this->User = new User(null, "toto", password_hash("toto",PASSWORD_DEFAULT));
        $this->assertEquals(null, $this->User->getId());
    }

    /**
    * Tests User->getName()
    */
    public function testGetName()
    {
        $this->User = new User(null, "toto", password_hash("toto",PASSWORD_DEFAULT));
        $this->assertEquals("toto", $this->User->getName());
    }

    /**
    * Tests User->getPassword()
    */
    public function testGetPassword()
    {
        $this->User = new User(null, "toto", password_hash("toto",PASSWORD_DEFAULT));
        $this->assertTrue(password_verify("toto", $this->User->getPassword()));
    }
}
