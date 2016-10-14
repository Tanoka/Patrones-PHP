<?php

abstract class ListItem
{

    protected $description = "";
    protected $datedue = null;
    protected $datecreated = null;
    protected $datecompleted = null;

    function __construct($description, $datedue = null)
    {

        $this->setDescription($description);
        $this->setDateDue($datedue);
        $this->setDateCreated(time());
    }

    function getComposite()
    {
        return null;
    }

    function setDescription($description)
    {
        $this->description = $description;
    }

    function getDescription()
    {
        return $this->description;
    }

    function setDateDue($datedue)
    {
        $this->datedue = $datedue;
    }

    function getDateDue()
    {
        return $this->datedue;
    }

    function setDateCompleted($datecompleted)
    {
        $this->datecompleted = $datecompleted;
    }

    function getDateCompleted()
    {
        return $this->datecompleted;
    }

    function setDateCreated($datecreated)
    {
        $this->datecreated = $datecreated;
    }

    function getDateCreated()
    {
        return $this->datecreated;
    }

}

abstract class CompositeListItem extends ListItem
{

    protected $listitems = array();

    function getComposite()
    {
        return $this;
    }

    protected function listitems()
    {
        return $this->listitems;
    }

    function removeListItem(ListItem $listitem)
    {
        $listitems = array();

        foreach ($this->listitems as $thisitem) {
            if ($listitem !== $thisitem) {
                $listitems[] = $thisitem;
            }
        }

        $this->listitems = $listitems;
    }

    function addListItem(ListItem $listitem)
    {
        if (in_array($listitem, $this->listitems, true)) {
            return;
        }

        $this->listitems[] = $listitem;
    }

}

class ToDoList extends CompositeListItem
{

}

class GroceryList extends CompositeListItem
{

}

class LibraryList extends CompositeListItem
{

}

class GroceryItem extends ListItem
{

}

class LibraryItem extends ListItem
{

}

class PostOfficeItem extends ListItem
{

}

// Create our post office item
$poItem = new PostOfficeItem("Post letter at post office.");

// Create our Library List and Library Items
$libList = new LibraryList("Go to the Library");
$libItem1 = new LibraryItem("Return Craig Sefton's book.");
$libItem2 = new LibraryItem("Get another PHP book.");
$libList->addListItem($libItem1);
$libList->addListItem($libItem2);

// Create our Grocery List and Grocery Items
$groceryList = new GroceryList("Grocery Shopping List");
$groceryItem1 = new GroceryItem("Milk");
$groceryItem2 = new GroceryItem("Eggs");
$groceryItem3 = new GroceryItem("Bread");
$groceryList->addListItem($groceryItem1);
$groceryList->addListItem($groceryItem2);
$groceryList->addListItem($groceryItem3);

// Create our ToDo List, and add our other lists and items to it
$todoList = new ToDoList("My ToDo List");
$todoList->addListItem($groceryList);
$todoList->addListItem($libList);
$todoList->addListItem($poItem);


foreach ($todoList->listitems() as $todo) {

    $list = $todo->getComposite();
    if (is_object($list)) {
        // we've got a composite list item
    } else {
        // we've got an individual list item
    }
}