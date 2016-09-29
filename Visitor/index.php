<?php

/**
 * An Element class.
 * Defining this as an interface or abstract class is equivalent.
 */
abstract class InputValue
{
    private $_value;

    public function __construct($value)
    {
        $this->set($value);
    }

    public function set($value)
    {
        $this->_value = $value;
    }

    public function get()
    {
        return $this->_value;
    }

    public abstract function acceptVisitor(Visitor $visitor);
}

/**
 * A ConcreteElement. Accepts a Visitor and forwards to it on its specialized method.
 */
class SingleInputValue extends InputValue
{
    public function acceptVisitor(Visitor $visitor)
    {
        $visitor->visitSingleInputValue($this);
    }
}

/**
 * Another ConcreteElement.
 */
class MultipleInputValue extends InputValue
{
    public function acceptVisitor(Visitor $visitor)
    {
        $visitor->visitMultipleInputValue($this);
    }
}

/**
 * The Visitor participant. Again, interface or abstract classes are equivalent.
 */
interface Visitor
{
    /**
     * Since in PHP there is no simple mechanism for method overloading,
     * the visit() methods must not only have different parameters
     * but different names too.
     */
    public function visitSingleInputValue(SingleInputValue $inputValue);
    public function visitMultipleInputValue(MultipleInputValue $inputValue);
}

/**
 * A ConcreteVisitor.
 * Filters all the values provided casting them to integers.
 */
class IntFilter implements Visitor
{
    public function visitSingleInputValue(SingleInputValue $inputValue)
    {
        $inputValue->set((int) $inputValue->get());
    }

    public function visitMultipleInputValue(MultipleInputValue $inputValue)
    {
        $newValues = array();
        foreach ($inputValue->get() as $index => $value) {
            $newValues[$index] = (int) $value;
        }
        $inputValue->set($newValues);
    }
}

/**
 * Another ConcreteVisitor.
 * Sorts multiple values.
 */
class AscendingSort implements Visitor
{
    /**
     * Do nothing. This part is equivalent to a Null Object,
     * which leverages polymorphism to achieve more concise code.
     */
    public function visitSingleInputValue(SingleInputValue $inputValue)
    {
    }

    public function visitMultipleInputValue(MultipleInputValue $inputValue)
    {
        $values = $inputValue->get();
        asort($values);
        $inputValue->set($values);
    }
}


// client code
$userId = new SingleInputValue("42");
$categories = new MultipleInputValue(array('hated' => 16, 'ordinary' => 23, 'preferred' => 15));
$userId->acceptVisitor(new IntFilter);
var_dump($userId->get());
$categories->acceptVisitor(new AscendingSort);
var_dump($categories->get());