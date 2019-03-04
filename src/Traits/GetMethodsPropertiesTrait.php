<?php

namespace Citrix\Traits;


/**
 * Class GetMethodsPropertiesTrait
 * @package src\Traits
 */
trait GetMethodsPropertiesTrait
{
    /**
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        if (method_exists($this, 'get' . ucfirst($name))) {
            return call_user_func([$this, 'get' . ucfirst($name)]);
        }
        return $this->$name;
    }

}