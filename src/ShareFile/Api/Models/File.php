<?php


namespace Citrix\ShareFile\Api\Models;

/**
 * Class File
 * @package src\ShareFile\Api\Models
 */
class File extends Item
{
    /**
     * @var
     */
    public $Hash;
    /**
     * @var
     */
    public $VirusStatus;
    /**
     * @var
     */
    public $Info;

    /**
     * @param $value
     */
    protected function setInfoAttribute($value)
    {
        if (isset($value)) {
            if (!empty($value->{'odata.type'})) {
                $class = 'Citrix\\'.str_replace('.', '\\', $value->{'odata.type'});
                $this->Info = new $class($value);
            } else $this->Info = $value;
        } else $this->Info = $value;
    }

}
