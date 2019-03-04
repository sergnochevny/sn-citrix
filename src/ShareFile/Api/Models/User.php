<?php

namespace Citrix\ShareFile\Api\Models;


/**
 * Class User
 * @package src\ShareFile\Api\Models
 */
class User extends BaseModel
{
    /**
     * @var
     */
    public $IsAdministrator;
    /**
     * @var
     */
    public $CanCreateFolders;
    /**
     * @var
     */
    public $CanUseFileBox;
    /**
     * @var
     */
    public $CanManageUsers;
    /**
     * @var
     */
    public $IsVirtualClient;
    /**
     * @var
     */
    public $DiskSpace;
    /**
     * @var
     */
    public $Company;
    /**
     * @var
     */
    public $TotalSharedFiles;
    /**
     * @var
     */
    public $Contacted;
    /**
     * @var
     */
    public $FullName;
    /**
     * @var
     */
    public $ReferredBy;
    /**
     * @var
     */
    public $FirstName;
    /**
     * @var
     */
    public $LastName;
    /**
     * @var
     */
    public $DateCreated;
    /**
     * @var
     */
    public $FullNameShort;
    /**
     * @var
     */
    public $Emails;
    /**
     * @var
     */
    public $IsConfirmed;
    /**
     * @var
     */
    public $Roles;
    /**
     * @var
     */
    public $AffiliatedPartnerUserId;
    /**
     * @var
     */
    public $Email;
    /**
     * @var
     */
    public $Username;
    /**
     * @var
     */
    public $Domain;
    /**
     * @var
     */
    public $Id;
    /**
     * @var
     */
    public $url;
}