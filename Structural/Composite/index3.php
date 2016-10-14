<?php

/**
 * Component interface.
 * The Client depends only on this abstraction, whatever graph is built using
 * the specializations.
 */
interface HtmlElement
{

    public function __toString();
}

/**
 * Leaf sample implementation.
 * Represents an <h1> element.
 */
class H1 implements HtmlElement
{

    private $_text;

    public function __construct($text)
    {
        $this->_text = $text;
    }

    public function __toString()
    {
        return "<h1>{$this->_text}</h1>";
    }

}

/**
 * Leaf sample implementation.
 * Represents a <p> element.
 */
class P implements HtmlElement
{

    private $_text;

    public function __construct($text)
    {
        $this->_text = $text;
    }

    public function __toString()
    {
        return "<p>{$this->_text}</p>";
    }

}

class Div implements HtmlElement
{

    private $_children = array();

    public function addChild(HtmlElement $element)
    {
        $this->_children[] = $element;
    }

    public function __toString()
    {
        $html = "<div>\n";
        foreach ($this->_children as $child) {
            $childRepresentation = (string) $child;
            $childRepresentation = str_replace("\n", "\n    ", $childRepresentation);
            $html .= '    ' . $childRepresentation . "\n";
        }
        $html .= "</div>";
        return $html;
    }

}

// Client code
$div = new Div();
$div->addChild(new H1('Title'));
$div->addChild(new P('Lorem ipsum...'));
$sub = new Div();
$sub->addChild(new P('Dolor sit amet...'));
$div->addChild($sub);
echo $div, "\n";