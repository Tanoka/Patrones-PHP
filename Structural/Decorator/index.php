<?php

/**
 * Also known as Wrapper.
 * Is a design pattern that allows behavior to be added to an individual object, either statically or dynamically,
 * without affecting the behavior of other objects from the same class.
 * Decorators provide a flexible alternative to subclassing for extending functionality.
 *
 * Component
 * Concrete component
 * Decorator
 * Concrete decorator
 */
interface eMailBody
{

    public function loadBody();
}

//Main Email Class
class eMail implements eMailBody
{

    public function loadBody()
    {
        echo "This is Main Email body.<br />";
    }
}

//Main decorator
abstract class emailBodyDecorator implements eMailBody
{
    protected $emailBody;

    public function __construct(eMailBody $emailBody)
    {
        $this->emailBody = $emailBody;
    }

    abstract public function loadBody();
}

//Concrete decorators
class christmasEmailBody extends emailBodyDecorator
{

    public function loadBody()
    {
        echo 'This is Extra Content for Christmas<br />';
        $this->emailBody->loadBody();
    }
}

class newYearEmailBody extends emailBodyDecorator
{

    public function loadBody()
    {
        echo 'This is Extra Content for New Year.<br />';
        $this->emailBody->loadBody();
    }
}

//Use

// Normal Email
$email = new eMail();
$email->loadBody();

// Output:
// This is Main Email body.


 //  Email with Xmas Greetings
$email = new eMail();
$email = new christmasEmailBody($email);
$email->loadBody();

// Output:
// This is Extra Content for Christmas
//This is Main Email body.

//  Email with Xmas and New Year Greetings
$email = new eMail();
$email = new christmasEmailBody($email);
$email = new newYearEmailBody($email);
$email->loadBody();

// Output
// This is Extra Content for New Year.
// This is Extra Content for Christmas
// This is Main Email body.