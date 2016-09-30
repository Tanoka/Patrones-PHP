<?php

//http://www.php5dp.com/chain-of-responsibility-making-a-selection/

abstract class Handler
{

    abstract public function handleRequest($request);

    abstract public function setSuccessor($nextService);
}

class Information extends Handler
{

    private $successor;

    public function setSuccessor($nextService)
    {
        $this->successor = $nextService;
    }

    public function handleRequest($request)
    {
        if ($request->getService() == "Information Design") {
            echo ("All types of information can be easily stored  " . "<br />" . "and retrieved in a MySQL database controlled by PHP.");
        } else if ($this->successor != NULL) {
            $this->successor->handleRequest($request);
        }
    }

}

class Services extends Handler
{

    private $successor;

    public function setSuccessor($nextService)
    {
        $this->successor = $nextService;
    }

    public function handleRequest($request)
    {
        if ($request->getService() == "MySQL Database Design") {
            echo "Design both regular and relational databases" . "<br />";
        } else if ($this->successor != NULL) {
            $this->successor->handleRequest($request);
        }
    }

}

class Software extends Handler
{

    private $successor;

    public function setSuccessor($nextService)
    {
        $this->successor = $nextService;
    }

    public function handleRequest($request)
    {
        if ($request->getService() == "Software Security") {
            echo ("We can provide client- and server- based validation with password security");
        } else if ($this->successor != NULL) {
            $this->successor->handleRequest($request);
        }
    }

}

class Request
{

    private $value;

    public function __construct($service)
    {
        $this->value = $service;
    }

    public function getService()
    {
        return $this->value;
    }

}

class Client
{

    public function __construct($queryNow)
    {
        $Info = new Information();
        $CodeSer = new Services();
        $Product = new Software();

        $Info->setSuccessor($CodeSer);
        $CodeSer->setSuccessor($Product);

        // Generate and process load requests
        $loadup = new Request($queryNow);
        $Info->handleRequest($loadup);
    }

}

$makeRequest = new Client("Software Security");