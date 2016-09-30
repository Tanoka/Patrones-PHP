<?php

/**
 * An adapter helps two incompatible interfaces to work together.
 * The Adapter design pattern allows otherwise incompatible classes to work together by converting the interface of one class into an interface expected by the clients.
 *
 * There are two types of adapter patterns:
 * Object Adapter pattern. the adapter contains an instance of the class it wraps. In this situation, the adapter makes calls to the instance of the wrapped object.
 * Class Adapter pattern.  uses multiple polymorphic interfaces implementing or inheriting both the interface that is expected and the interface that is pre-existing.
 */
//Interfaces incompatibles
interface IFormatIPhone
{

    public function recharge();

    public function useLightning();
}

interface IFormatAndroid
{

    public function recharge();

    public function useMicroUsb();
}

//Clases que implementan los interfaces
class IPhone implements IFormatIPhone
{
    private $connectorOk = FALSE;

    public function useLightning()
    {
        $this->connectorOk = TRUE;
        echo "Lightning connected -$\n";
    }

    public function recharge()
    {
        if ($this->connectorOk) {
            echo "Recharge Started\n";
        } else {
            echo "Connect Lightning first\n";
        }
    }
}

class Android implements IFormatAndroid
{
    private $connectorOk = FALSE;

    public function useMicroUsb()
    {
        $this->connectorOk = TRUE;
        echo "MicroUsb connected ->\n";
    }

    public function recharge()
    {
        if ($this->connectorOk) {
            echo "Recharge Started\n";
        } else {
            echo "Connect MicroUsb first\n";
        }
    }
}

// Adapter
class IPhoneAdapter implements IFormatAndroid
{
    private $mobile;

    public function __construct(IFormatIPhone $mobile)
    {
        $this->mobile = $mobile;
    }

    public function recharge()
    {
        $this->mobile->recharge();
    }

    public function useMicroUsb()
    {
        echo "MicroUsb connected -> ";
        $this->mobile->useLightning();
    }
}

/**
 * Cliente que utiliza el adaptador
 * Así podemos utilizar los métodos definidos en el interface IFormatAndroid en una clase IPhone
 */
class cliente
{

    public function __construct()
    {
        echo "---Recharging iPhone with Generic Recharger---\n";
        $this->phone = new IPhone();
        $this->phoneAdapter = new IPhoneAdapter($this->phone);
        $this->phoneAdapter->useMicroUsb();
        $this->phoneAdapter->recharge();
        echo "---iPhone Ready for use---\n\n";
    }
}
