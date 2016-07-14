<?php

namespace Lucy\Traits;

trait BlockHydratorTrait
{
    public function hydrate(array $args)
    {
        foreach ($args as $prop => $value) {
            if (property_exists($this, $prop)) {
                $this->{$prop} = $value;
            }
        }

        return $this;
    }

    public function __get($prop)
    {
        return $this->{$prop};
    }
}
