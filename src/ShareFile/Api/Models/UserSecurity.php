<?php

namespace Citrix\ShareFile\Api\Models;


/**
 * Class UserSecurity
 * @package src\ShareFile\Api\Models
 */
class UserSecurity extends BaseModel
{
    /**
     * @var bool
     */
    public $IsDisabled = false;
    /**
     * @var bool
     */
    public $IsLocked = false;
    /**
     * @var
     */
    public $LockExpires;
    /**
     * @var
     */
    public $LastWebAppLogin;
    /**
     * @var
     */
    public $LastAnyLogin;
    /**
     * @var
     */
    public $FirstAnyLogin;
    /**
     * @var
     */
    public $UserIPRestrictions;
    /**
     * @var
     */
    public $DisableLoginBefore;
    /**
     * @var
     */
    public $DisableLoginAfter;
    /**
     * @var bool
     */
    public $ForcePasswordChange = false;
    /**
     * @var bool
     */
    public $PasswordNeverExpires = false;
    /**
     * @var
     */
    public $LastPasswordChange;
    /**
     * @var
     */
    public $UsernameShort;
    /**
     * @var
     */
    public $LastFailedLogin;
    /**
     * @var
     */
    public $LastFailedLoginIP;
    /**
     * @var int
     */
    public $FailedLoginCount = 0;
    /**
     * @var string
     */
    public $UserAuthenticationType = "Basic";
    /**
     * @var
     */
    public $Id;
    /**
     * @var
     */
    public $url;
}