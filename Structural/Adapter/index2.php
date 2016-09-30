<?php

/**
 * Dos sistemas de notificación con interfaces incompatibles
 *
 */
interface emailNotification
{

    public function getSubscribers();

    public function setMessage($message);

    public function sendMail();
}

interface twitterNotification
{

    public function getFollowers();

    public function setMessage($message);

    public function sendTweet();
}

/**
 * Implementación del interface emailNotification
 */
class emailNot implements emailNotification
{

    public function getSubscribers()
    {

    }

    public function setMessage($message)
    {

    }

    public function sendMail()
    {

    }
}

/**
 * Implementación del interface twitterNotification
 */
class twitterNot implements twitterNotification
{

    public function getFollowers()
    {

    }

    public function setMessage($message)
    {

    }

    public function sendTweet()
    {

    }
}

/**
 * Adaptamos twitterNot al interface de emailNotification
 */
class twitterAdapter implements emailNotification
{
    private $twitterNot;

    public function __construct()
    {
        $this->twitterNot = new twitterNot();
    }

    public function getSubscribers()
    {
        return $this->twitterNot->getFollowers();
    }

    public function setMessage($message)
    {
        $this->twitterNot->setMessage($message);
    }

    public function sendMail()
    {
        $this->twitterNot->sendTweet();
    }
}

/**
 * Cualquier clase que espere un objeto de tipo emailNotification podrá utilizar objetos twitterNot adaptados con twitterAdapter
 * Por ejemplo, hemos sustituido el email para comunicación por twitter, así no tenemos que cambiar el código que hace los envios.
 */
class client {

    public function useEmailNot(emailNotification $emailNot){
        $emailNot->setMessage('blabla');
        $emailNot->getSubscribers();
        $emailNot->sendMail();
    }
}

$clie = new client();
$clie->useEmailNot(new twitterAdapter());