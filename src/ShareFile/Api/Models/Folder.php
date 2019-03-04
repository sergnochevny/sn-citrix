<?php


namespace Citrix\ShareFile\Api\Models;

/**
 * Class Folder
 * @package src\ShareFile\Api\Models
 *
 * method setChildren($value)
 */
class Folder extends Item
{
    /**
     * @var
     */
    public $FileCount;
    /**
     * @var
     */
    public $Children;
    /**
     * @var
     */
    public $HasRemoteChildren;
    /**
     * @var
     */
    public $Info;
    /**
     * @var
     */
    public $ItemInfo;
    /**
     * @var
     */
    public $Redirection;
    /**
     * @var
     */
    public $FavoriteFolder;

    /**
     * @param $value
     */
    protected function setChildrenAttribute($value)
    {
        if (isset($value) && is_array($value)) {
            $children = [];
            foreach ($value as $child) {
                if (!empty($child->{'odata.type'})) {
                    $class = 'Citrix\\'.str_replace('.', '\\', $child->{'odata.type'});
                    $children[] = new $class($child);
                } else {
                    $children[] = $child;
                }
                $this->Children = $children;
            }
        } else {
            $this->Children = $value;
        }
    }
}
