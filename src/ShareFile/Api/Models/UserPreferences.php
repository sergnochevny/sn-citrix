<?php

namespace Citrix\ShareFile\Api\Models;


/**
 * Class UserPreferences
 * @package src\ShareFile\Api\Models
 */
class UserPreferences extends BaseModel
{
    /**
     * @var bool
     */
    public $EnableFlashUpload = true;
    /**
     * @var bool
     */
    public $EnableJavaUpload = false;
    /**
     * @var bool
     */
    public $EnableJavaDownload = false;
    /**
     * @var bool
     */
    public $RememberCustomMessages = true;
    /**
     * @var bool
     */
    public $RequireLoginByDefault = false;
    /**
     * @var bool
     */
    public $NotifyOnUploadByDefault = false;
    /**
     * @var bool
     */
    public $NotifyOnDownloadByDefault = false;
    /**
     * @var bool
     */
    public $CanResetPassword = true;
    /**
     * @var bool
     */
    public $CanViewMySettings = true;
    /**
     * @var bool
     */
    public $IsSharedUserAccount = false;
    /**
     * @var
     */
    public $TimeZone;
    /**
     * @var string
     */
    public $DaylightSavingMode = "US";
    /**
     * @var
     */
    public $TimeZoneOffset;
    /**
     * @var
     */
    public $TimeZoneOffsetMins;
    /**
     * @var bool
     */
    public $DisplayUserMessage = false;
    /**
     * @var string
     */
    public $UserMessageCode = "";
    /**
     * @var int
     */
    public $NotificationInterval = 0;
    /**
     * @var string
     */
    public $ShowTutorial = "NewEmployee";
    /**
     * @var int
     */
    public $EnableToolOverride = 0;
    /**
     * @var bool
     */
    public $IsResetSecurityQuestionRequired = true;
    /**
     * @var string
     */
    public $TimeFormat = "h:mmt";
    /**
     * @var string
     */
    public $LongTimeFormat = "hh:mm:ss tt";
    /**
     * @var string
     */
    public $DateFormat = "M/d/yy";
    /**
     * @var string
     */
    public $UserNotificationLocale = "Invariant";
    /**
     * @var
     */
    public $url;
}