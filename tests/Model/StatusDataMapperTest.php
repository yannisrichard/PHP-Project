<?php

use Model\Database\StatusMapper;
use Model\Database\StatusFinder;
use Model\Status;
use Model\Database\Connection;

class StatusDataMapperTest extends \PHPUnit_Framework_TestCase
{
    private $finder;
    private $con;
    private $mapper;

    //Modification des tables pour la test avec la suppression de l'auto incrément
    //sur user_id et status_id qui faisait planter mes tests!
    public function setUp()
    {
        $this->con = new Connection('sqlite::memory:',null,null);
        $this->con->exec(<<<SQL
CREATE TABLE IF NOT EXISTS USERS(
        user_id INTEGER PRIMARY KEY,
        user_name VARCHAR(100) NOT NULL,
        user_password VARCHAR(100) NOT NULL
);
CREATE TABLE IF NOT EXISTS STATUSES(
        status_id INTEGER PRIMARY KEY,
        status_message VARCHAR(500) NOT NULL,
        status_user_id INTEGER,
        status_date DATETIME NOT NULL,
        FOREIGN KEY (status_user_id) REFERENCES USERS(user_id) ON DELETE CASCADE
);
SQL
);
        $this->finder = new StatusFinder($this->con);
        $this->mapper = new StatusMapper($this->con);
        $this->mapper->persist(new Status(1, new DateTime("13-02-2014 20:45:30"), new \Model\User(1,"Yannis","yannis"), "plop"));
        $this->mapper->persist(new Status(2, new DateTime("14-02-2014 17:08:00"), new \Model\User(2,"Toto","toto"), "lasticot"));
    }

    public function testPersist()
    {
        $status = new Status(3, new DateTime("14-02-2014 18:31:12"), new \Model\User(3,"Titi","titi"), "lol");
        $this->assertTrue($this->mapper->persist($status));
    }

    public function testFindAll()
    {
        $statuses = $this->finder->findAll();
        $this->assertEquals(2, count($statuses));
    }

    public function testFindOneById()
    {
        $status = $this->finder->findOneById(1);
        $this->assertEquals("plop", $status->getText());
    }
}
