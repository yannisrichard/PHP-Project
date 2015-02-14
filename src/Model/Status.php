<?php

namespace Model;

class Status
{
    private $id;

    private $date;

    private $user;

    private $message;

    public function __construct($id = null, \DateTime $date,User $user, $message)
    {
        $this->id = $id;
        $this->date = $date;
        $this->user = $user;
        $this->message = $message;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getText()
    {
        return $this->message;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function getOwner()
    {
        return $this->user;
    }
}
