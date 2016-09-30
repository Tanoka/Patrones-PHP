<?php

interface ITransportStrategy
{
    public function travel(Location $location);

    public function isAvailable();
}


class Car implements ITransportStrategy
{
    public function __construct () {}

    public function travel(Location $location)
    {
        // Drive car
    }

    public function isAvailable()
    {
        // Can i use the car (or do i even have one)?
    }
}

class Train implements ITransportStrategy
{
    public function __construct () {}

    public function travel(Location $location)
    {
        // Catch train to nearest location
    }

    public function isAvailable()
    {
        // Are there any trains available and am i near a station?
    }
}

class Commuter
{
    private static $_strategies = array(
        'Car',
        'Train',
    );

    private $_strategy;

    public function __construct ()
    {
        foreach (self::$_strategies as $className)
        {
            $method = new $className();

            if ($method instanceof ITransportStrategy && $method->isAvailable())
            {
                $this->_strategy = $method;
                break;
            }
        }

        if (!isset($this->_strategy)) {
            throw new Exception('No transport methods available');
        }
    }

    public function travel(Location $location)
    {
        if ($this->_strategy) {
            return $this->_strategy->travel($location);
        }

        return false;
    }
}



$bob = new Commuter();

if ($bob->travel(Map::getLocation('work'))) {
    // Bob got to work, nobody cares how :-)
}