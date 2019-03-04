<?php

namespace Citrix\Traits;


/**
 * Class SetPropertiesTrait
 * @package src\Traits
 */
trait SetPropertiesTrait
{

    /**
     * @param $name
     * @param $arguments
     * @return $this
     */
    public function __call($name, $arguments)
    {
        if (strncmp('set', $name, 3) == 0) {
            $attr = substr($name, 3);
            if (preg_match_all('|[A-Z][a-z]*|s', $attr, $match_attr)) {
                $attr = implode('_', array_map('strtolower', $match_attr[0]));
                if (property_exists($this, $attr)) {
                    $this->{$attr} = $arguments[0];
                    return $this;
                }
            }
        }
        return parent::__call($name, $arguments);
    }

}