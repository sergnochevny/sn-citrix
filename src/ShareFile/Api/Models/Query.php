<?php

namespace Citrix\ShareFile\Api\Models;

/**
 * Class Query
 * @package src\ShareFile\Api\Models
 *
 */
class Query extends BaseModel
{
    /**
     * @var array
     */
    private $resolved_item_types = ['Folder', 'File', 'Note'];
    /**
     * @var string
     */
    public $ItemTypes;
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
    protected function setItemTypesAttribute($value)
    {
        $ItemTypes = $this->ItemTypes;
        if (empty($ItemTypes)) {
            $ItemTypes = [];
        }
        if (!empty($value) && is_array($value) && (count($value) > 0)) {
            foreach ($value as $type) {
                if (!empty($type) &&
                    in_array($type, $this->resolved_item_types) &&
                    !in_array($type, $ItemTypes)
                ) {
                    $ItemTypes[] = $type;
                }
            }
            $this->ItemTypes = $ItemTypes;
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
