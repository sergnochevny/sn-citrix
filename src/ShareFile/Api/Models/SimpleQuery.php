<?php
/**
 * Created by PhpStorm.
 * User: Serg
 * Date: 05.01.2017
 * Time: 17:33
 */

namespace Citrix\ShareFile\Api\Models;

/**
 * Class SimpleQuery
 * @package src\ShareFile\Api\Models
 *
 * @method SimpleQuery setItemType($value)
 * @method SimpleQuery setParentID($value)
 * @method SimpleQuery setCreatorID($value)
 * @method SimpleQuery setSearchQuery($value)
 * @method SimpleQuery setCreateStartDate($value)
 * @method SimpleQuery setCreateEndDate($value)
 * @method SimpleQuery setItemNameOnly($value)
 */

class SimpleQuery extends BaseModel
{
    /**
     * @var array
     */
    private $resolved_item_types = ['Folder', 'File', 'Note'];
    /**
     * @var string
     */
    public $ItemType;
    /**
     * @var string
     */
    public $ParentID;
    /**
     * @var string
     */
    public $CreatorID;
    /**
     * @var string
     */
    public $SearchQuery;
    /**
     * @var string
     */
    public $CreateStartDate;
    /**
     * @var string
     */
    public $CreateEndDate;
    /**
     * @var string
     */
    public $ItemNameOnly;

    /**
     * @param $value
     */
    protected function setItemTypeAttribute($value)
    {
        if (!empty($value) && in_array($value, $this->resolved_item_types)) {
            $this->ItemType = $value;
        }
    }

    /**
     * @param $value
     */
    protected function setParentIDAttribute($value)
    {
        if (!empty($value) && is_array($value)) {
            if ((count($value) > 0)) {
                $this->ParentID = $value;
            }
        } elseif (!empty($value)) {
            $this->ParentID = [$value];
        }
    }

    /**
     * @param $value
     */
    protected function setCreatorIDAttribute($value)
    {
        if (!empty($value) && is_array($value)) {
            if ((count($value) > 0)) {
                $this->CreatorID = $value;
            }
        } elseif (!empty($value)) {
            $this->CreatorID = [$value];
        }
    }
}
