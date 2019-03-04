<?php

namespace Citrix\ShareFile\Api\Models;

/**
 * Class Item
 * @package src\ShareFile\Api\Models
 */
class Item extends BaseModel
{

    /**
     * @var
     */
    public $Id;
    /**
     * @var
     */
    public $url;
    /**
     * @var
     */
    public $Name;
    /**
     * @var
     */
    public $FileName;
    /**
     * @var
     */
    public $Creator;
    /**
     * @var
     */
    public $Parent;
    /**
     * @var
     */
    public $AccessControls;
    /**
     * @var
     */
    public $Zone;
    /**
     * @var
     */
    public $CreationDate;
    /**
     * @var
     */
    public $ProgenyEditDate;
    /**
     * @var
     */
    public $ClientCreatedDate;
    /**
     * @var
     */
    public $ClientModifiedDate;
    /**
     * @var
     */
    public $ExpirationDate;
    /**
     * @var
     */
    public $Description;
    /**
     * @var
     */
    public $DiskSpaceLimit;
    /**
     * @var
     */
    public $IsHidden;
    /**
     * @var
     */
    public $BandwidthLimitInMB;
    /**
     * @var
     */
    public $Owner;
    /**
     * @var
     */
    public $Account;
    /**
     * @var
     */
    public $FileSizeInKB;
    /**
     * @var
     */
    public $Path;
    /**
     * @var
     */
    public $CreatorFirstName;
    /**
     * @var
     */
    public $CreatorLastName;
    /**
     * @var
     */
    public $ExpirationDays;
    /**
     * @var
     */
    public $FileSizeBytes;
    /**
     * @var
     */
    public $PreviewStatus;
    /**
     * @var
     */
    public $PreviewPlatformsSupported;
    /**
     * @var
     */
    public $EditingPlatformsSupported;
    /**
     * @var
     */
    public $HasPendingDeletion;
    /**
     * @var
     */
    public $AssociatedFolderTemplateID;
    /**
     * @var
     */
    public $IsTemplateOwned;
    /**
     * @var
     */
    public $StreamID;
    /**
     * @var
     */
    public $CreatorNameShort;
    /**
     * @var
     */
    public $HasMultipleVersions;
    /**
     * @var
     */
    public $HasPendingAsyncOp;
    /**
     * @var
     */
    public $Metadata;
    /**
     * @var
     */
    public $Statuses;

    /**
     * @param $value
     */
    protected function setParentAttribute($value)
    {
        if (isset($value)) {
            if (!empty($value->{'odata.type'})) {
                $class = 'Citrix\\'.str_replace('.', '\\', $value->{'odata.type'});
                $this->Parent = new $class($value);
            } else $this->Parent = $value;
        } else $this->Parent = $value;
    }

}
