<?php

abstract class Graphic{
    abstract public function draw();
}

class Triangle extends Graphic{
    private $name = '';

    public function __construct($name = 'unknown'){
        $this->name = $name;
    }

    public function draw(){
        echo '-I\'m a triangle '.$this->name.'.<br>';
    }
}

class Container extends Graphic{
    private $name = '';
    private $container = array();

    public function __construct($name = 'unknown'){
        $this->name = $name;
    }

    public function draw(){
        echo 'I\'m a container '.$this->name.'.<br>';
        foreach($this->container as $graphic)
            $graphic->draw();
    }

    public function add(Graphic $graphic){
        $this->container[] = $graphic;
    }

    public function del(Graphic $graphic){
        unset($this->container[$graphic]);
    }
}

$tri1 = new Triangle('1');
$tri2 = new Triangle('2');
$tri3 = new Triangle('3');

$container1 = new Container('1');
$container2 = new Container('2');
$container3 = new Container('3');

$container1->add($tri1);
$container1->add($tri2);
$container2->add($tri3);

$container3->add($container1);
$container3->add($container2);

$container3->draw();


// The above example will output:
/*
I'm a container 3.
I'm a container 1.
-I'm a triangle 1.
-I'm a triangle 2.
I'm a container 2.
-I'm a triangle 3.
*/