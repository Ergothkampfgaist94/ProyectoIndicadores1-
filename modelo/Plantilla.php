<?php
class Plantilla
{
    var $var1;
    var $var2;

    function __construct($var1, $var2)
    {
        $this->var1 = $var1;
        $this->var2 = $var2;
    }

    function setvar1($var1)
    {
        $this->var1 = $var1;
    }

    function getvar1()
    {
        return $this->var1;
    }

    function setvar2($var2)
    {
        $this->var2 = $var2;
    }

    function getvar2()
    {
        return $this->var2;
    }
}
