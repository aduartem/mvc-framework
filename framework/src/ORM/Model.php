<?php
namespace Framework\ORM;

/**
 * @author aduartem
 */

class Model extends QueryBuilder
{
    private $data = array();

    public function __construct($data = NULL)
    {
        $this->data = $data;
    }

    public function __get($name)
    {
        if(array_key_exists($name, $this->data))
            return $this->data[$name];
    }

    public function __set($name, $value)
    {
        $this->data[$name] = $value;
    }

    public function getColumns()
    {
        return $this->data;
    }
}