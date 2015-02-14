 <?php

  namespace Model;

  class InMemoryFinder implements FinderInterface
  {

    private $statuses = array();

    $this->statuses[0] = new Status(0, new \DateTime(), "Admin", "Test status 1");
    $this->statuses[1] = new Status(1, new \DateTime(), "Admin", "plop plop plop");
    $this->statuses[2] = new Status(2, new \DateTime(), "Admin", "azzzzzzzzzzzz");

    public function findAll()
    {
        return $statuses;
    }

    public function findOneById($id)
    {
       return $this->statuses[$id];
    }
}
