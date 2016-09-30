<?php
/**
 * Structural design pattern
 * A facade is an object that provides a simplified interface to a larger body of code.
 *
 * The Facade design pattern is often used when a system is very complex or difficult to understand because the system has a large number
 * of interdependent classes or its source code is unavailable.
 * This pattern hides the complexities of the larger system and provides a simpler interface to the client.
 *
 */
//*************************************************************************************************

/**
 * Puede ser una clase con multitud de métodos o varias clases las que queramos simplificar con facade.
 *
 */
class messylibrary
{

    public function method1()
    {

    }

    public function method2()
    {
        
    }

    public function method3()
    {

    }

    public function method4()
    {
        
    }
}

class biglibrary
{

    public function method6()
    {

    }

    public function method7()
    {
        
    }

    public function method8()
    {

    }

    public function method9()
    {
        
    }
}

/**
 * Juntamos las clases o métodos que nos hacen falta del subsistema a utilizar en un clase adecuada a nuestras necesidades
 */
class facade
{
    private $messy;
    private $crappy;

    public function __construct()
    {
        $this->messy = new messylibrary();
        $this->crappy = new biglibrary();
    }

    public function methodFac1()
    {
        $this->messy->method1();
    }

    public function methodFac2()
    {
        $this->messy->method4();
    }

    public function methodFac3()
    {
        $this->crappy->method6();
    }
}

/**
 *
 */
class client
{
    private $facade;

    public function __construct()
    {
        $this->facade = new facade();
    }

    public function doThing()
    {
        $this->facade->methodFac1();
        $this->facade->methodFac2();
    }
}
