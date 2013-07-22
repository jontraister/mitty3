<?php

class ObjectArray extends ReadOnlyArrayObject
{

    public function __construct($array)
    {
        foreach ($array as &$value)
            $value = $this->fixValue($value);

        parent::__construct($array);

    }

    public function offsetGet($index)
    {
        $value = parent::offsetGet($index);

        return $this->fixValue($value);
    }

    public function __get($name)
    {
        return $this->offsetGet($name);
    }

    private function fixValue($value)
    {
        if (is_array($value) || $value instanceof ArrayAccess)
            return new ObjectArray($value);

        if (is_string($value) && !empty($value))
            return new SafeString($value);

        return $value;
    }

}