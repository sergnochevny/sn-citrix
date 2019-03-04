<?php

namespace Citrix\ShareFile\Api\Models;


/**
 * Class PlanFeatures
 * @package src\ShareFile\Api\Models
 */
class PlanFeatures extends BaseModel
{
    /**
     * @var bool
     */
    public $API = false;
    /**
     * @var bool
     */
    public $Outlook = false;
    /**
     * @var bool
     */
    public $DriveMapping = true;
    /**
     * @var bool
     */
    public $CLI = false;
    /**
     * @var bool
     */
    public $FTP = true;
    /**
     * @var bool
     */
    public $FTPS = true;
    /**
     * @var bool
     */
    public $Sync = true;
    /**
     * @var bool
     */
    public $AntiVirus = true;
    /**
     * @var bool
     */
    public $RequireLoginOnDownload = false;
    /**
     * @var int
     */
    public $MaxFileMB = 102400;
    /**
     * @var int
     */
    public $PlanStorMB = -1;
    /**
     * @var int
     */
    public $PlanBandMB = -1;
    /**
     * @var string
     */
    public $SystemName = "ShareFile";
    /**
     * @var string
     */
    public $SystemType = "";
    /**
     * @var bool
     */
    public $HasOutlookOptions = false;
    /**
     * @var
     */
    public $UsedStorMB;
    /**
     * @var
     */
    public $UsedStorUtcTicks;
    /**
     * @var
     */
    public $UsedStorBytes;
    /**
     * @var bool
     */
    public $IsEmployee = true;
    /**
     * @var bool
     */
    public $IsAdministrator = true;
    /**
     * @var bool
     */
    public $CanCreateRootFolders = true;
    /**
     * @var bool
     */
    public $CanUseFileBox = true;
    /**
     * @var bool
     */
    public $IsConfirmed = false;
    /**
     * @var bool
     */
    public $CanResetPassword = true;
    /**
     * @var string
     */
    public $PasswordRegEx = "^.*(?=.{8,})(?=.*\\d)(?=.*[a-zA-Z]).*$";
    /**
     * @var bool
     */
    public $CanManageMySettings = true;
    /**
     * @var
     */
    public $HomeFolder;
    /**
     * @var bool
     */
    public $EnableAutoUpdate = true;
    /**
     * @var bool
     */
    public $EnableTopLevelView = true;
}