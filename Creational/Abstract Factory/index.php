<?php
/*
 * Factory classes
 */
abstract class BikeFactory
{
    abstract function buildMountainBike();
    abstract function buildRoadBike();
}

class TrekFactory extends BikeFactory
{
    function buildMountainBike()
    {
        return new MountainBike("Trek");
    }
    function buildRoadBike()
    {
        return new RoadBike("Trek");
    }
}

class CannondaleFactory extends BikeFactory
{
    function buildMountainBike()
    {
        return new MountainBike("Cannondale"); //podrian ser clases tipo MountainBikeCannondale y la de la otra factory MountainBikeTrek
    }
    function buildRoadBike()
    {
        return new RoadBike("Cannondale");
    }
}

/*
 *   Product classes
 */
abstract class Bike
{
    abstract function getType();
    abstract function getBrand();
}

class Mountainbike extends Bike
{
    private $brand;
    private $type;
    function __construct($brand) {
        $this->brand = $brand;
        $this->type = "Mountainbike";
    }

    public function getType()
    {
        return $this->type;
    }

    public function getBrand()
    {
        return $this->brand;
    }
}

class RoadBike extends Bike
{
    private $brand;
    private $type;
    function __construct($brand) {
        $this->brand = $brand;
        $this->type = "Roadbike";
    }

    public function getType()
    {
        return $this->type;
    }

    public function getBrand()
    {
        return $this->brand;
    }
}

/**
 * cliente
 */
class BikeFactoryCreater
{
    const CANNONDALE = "Cannondale";
    const TREK = "Trek";

    public static function CreateBikeFactory($factoryName)
    {
        switch($factoryName)
        {
            case self::CANNONDALE :
                return new CannondaleFactory();
                break;
            case self::TREK :
                return new TrekFactory();
                break;
        }
        throw new Exception("BikeFactoryCreater " . $factoryName. " not found.");
    }
}

/**
 * Ejecuación
 */
$cannondaleFactory = BikeFactoryCreater::CreateBikeFactory(BikeFactoryCreater::CANNONDALE);
$bike = $cannondaleFactory->buildMountainBike();
print_r($bike);

$trekFactory = BikeFactoryCreater::CreateBikeFactory(BikeFactoryCreater::TREK);
$bike = $trekFactory->buildRoadBike();
print_r($bike);

/* Resultado
 *
Mountainbike Object
(
    [brand:Mountainbike:private] => Cannondale
    [type:Mountainbike:private] => Mountainbike
)
RoadBike Object
(
    [brand:RoadBike:private] => Trek
    [type:RoadBike:private] => Roadbike
)
 */