<?php

namespace Citrix\ShareFile\Api\Models;

/**
 * Class ItemInfo
 * @package src\ShareFile\Api\Models
 */
class ItemInfo extends BaseModel
{
    /**
     * @var
     */
    public $HasVroot;
    /**
     * @var
     */
    public $IsSystemRoot;
    /**
     * @var
     */
    public $IsAccountRoot;
    /**
     * @var
     */
    public $IsVRoot;
    /**
     * @var
     */
    public $IsMyFolders;
    /**
     * @var
     */
    public $IsAHomeFolder;
    /**
     * @var
     */
    public $IsMyHomeFolder;
    /**
     * @var
     */
    public $IsAStartFolder;
    /**
     * @var
     */
    public $IsSharedFolder;
    /**
     * @var
     */
    public $IsPassthrough;
    /**
     * @var
     */
    public $CanAddFolder;
    /**
     * @var
     */
    public $CanAddNode;
    /**
     * @var
     */
    public $CanView;
    /**
     * @var
     */
    public $CanDownload;
    /**
     * @var
     */
    public $CanUpload;
    /**
     * @var
     */
    public $CanSend;
    /**
     * @var
     */
    public $CanDeleteCurrentItem;
    /**
     * @var
     */
    public $CanDeleteChildItems;
    /**
     * @var
     */
    public $CanManagePermissions;
    /**
     * @var
     */
    public $ShowFolderPayBuyButton;

    /**
     * @var
     */
    public $url;
}
