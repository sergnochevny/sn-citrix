<?php

namespace Citrix\ShareFile\Api\Models;

/**
 * Class Employee
 * @package src\ShareFile\Api\Models
 *
 * @method ClientUser setEmail($value)
 * @method ClientUser setCompany($value)
 * @method ClientUser setFirstName($value)
 * @method ClientUser setLastName($value)
 * @method ClientUser setPassword($value)
 *
 * @method Employee setStorageQuotaLimitGB($value)
 * @method Employee setIsAdministrator($value)
 * @method Employee setCanCreateFolders($value)
 * @method Employee setCanUseFileBox($value)
 * @method Employee setCanManageUsers($value)
 * @method Employee setRoles(array $value)
 *
 */
class Employee extends ClientUser
{
    /**
     * @var int
     */
    public $StorageQuotaLimitGB = 50;
    /**
     * @var bool
     */
    public $IsAdministrator = false;
    /**
     * @var bool
     */
    public $CanCreateFolders = false;
    /**
     * @var bool
     */
    public $CanUseFileBox = true;
    /**
     * @var bool
     */
    public $CanManageUsers = false;
    /**
     * @var array
     * public $Roles = [
     * "CanChangePassword", "CanManageMySettings",
     * "CanUseFileBox", "CanManageUsers", "CanCreateFolders", "CanUseDropBox", "CanSelectFolderZone",
     * "AdminAccountPolicies", "AdminBilling", "AdminBranding", "AdminChangePlan", "AdminFileBoxAccess",
     * "AdminManageEmployees", "AdminRemoteUploadForms", "AdminReporting", "AdminSharedDistGroups",
     * "AdminSharedAddressBook", "AdminViewReceipts", "AdminDelegate", "AdminManageFolderTemplates",
     * "AdminEmailMessages", "AdminSSO", "AdminSuperGroup", "AdminZones", "AdminCreateSharedGroups", "AdminConnectors"
     * ];
     */
    public $Roles = [
        "CanChangePassword", "CanManageMySettings",
        "CanUseFileBox", "CanManageUsers", "CanCreateFolders", "CanUseDropBox", "CanSelectFolderZone",
        "AdminAccountPolicies", "AdminBilling", "AdminBranding", "AdminChangePlan", "AdminFileBoxAccess",
        "AdminManageEmployees", "AdminRemoteUploadForms", "AdminReporting", "AdminSharedDistGroups",
        "AdminSharedAddressBook", "AdminViewReceipts", "AdminDelegate", "AdminManageFolderTemplates",
        "AdminEmailMessages", "AdminSSO", "AdminSuperGroup", "AdminZones", "AdminCreateSharedGroups", "AdminConnectors"
    ];
}