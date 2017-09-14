<?php

namespace SimonWessel\TeamCityApi\Entities;

abstract class TeamCityObject implements \ArrayAccess
{

    public function __construct($attributes = [])
    {
        $this->fill($attributes);
    }

    /**
     * Fills class attributes with the given array
     * @param array $attributes
     */
    public function fill(array $attributes)
    {
        $existingAttributes = get_object_vars($this);

        foreach ($existingAttributes as $attributeName => $oldAttributeValue) {
            array_key_exists($attributeName, $attributes) ?  $this->$attributeName = $attributes[$attributeName] : NULL;
        }
    }

    public function offsetExists($offset)
    {
        return array_key_exists($offset, get_object_vars($this));
    }

    public function offsetGet($offset)
    {
        return $this->$offset;
    }

    public function offsetSet($offset, $value)
    {
        $this->$offset = $value;
    }

    public function offsetUnset($offset)
    {
        $this->$offset = null;
    }

}
