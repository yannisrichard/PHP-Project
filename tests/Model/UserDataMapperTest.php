<?php

use Model\Database\UserMapper;
use Model\Database\UserFinder;
use Model\User;
use Model\Database\Connection;

class UserDataMapperTest extends \PHPUnit_Framework_TestCase
{
    private $finder;
    private $con;
    private $mapper;

    //Modification des tables pour la test avec la suppression de l'auto incrément
    //sur user_id qui faisait planter mes tests!
    public function setUp()
    {
        $this->con = new Connection('sqlite::memory:',null,null);
        $this->con->exec(<<<SQL
CREATE TABLE IF NOT EXISTS USERS(
        user_id INTEGER PRIMARY KEY,
        user_name VARCHAR(100) NOT NULL,
        user_password VARCHAR(100) NOT NULL
);
SQL
);
        $this->finder = new UserFinder($this->con);
        $this->mapper = new UserMapper($this->con);
        $this->mapper->persist(new User(1,"Yannis","yannis"));
        $this->mapper->persist(new User(2,"Toto","toot"));
    }

    public function testPersist()
    {
        $user = new User(3,"Titi","titi");
        $this->assertTrue($this->mapper->persist($user));
    }

    public function testFindAll()
    {
        $users = $this->finder->findAll();
        $this->assertEquals(2, count($users));
    }

    public function testFindOneById()
    {
        $users = $this->finder->findOneById('1');
        $this->assertEquals("Yannis", $users->getName());
    }

    public function testFindOneByName()
    {
        $users = $this->finder->findOneByName('Yannis');
        $this->assertEquals("1", $users->getId());
    }
}
