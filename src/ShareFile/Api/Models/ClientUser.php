<?php

namespace Citrix\ShareFile\Api\Models;


/**
 *
 * Class ClientUser
 * @package src\ShareFile\Api\Models
 *
 * @method ClientUser setEmail($value)
 * @method ClientUser setCompany($value)
 * @method ClientUser setFirstName($value)
 * @method ClientUser setLastName($value)
 * @method ClientUser setPassword($value)
 * @method ClientUser setPreferences($value)
 * @method ClientUser setDefaultZone($value)
 *
 */

class ClientUser extends BaseModel
{
    /**
     * @var
     */
    public $Email;
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
    public $Company;
    /**
     * @var
     */
    public $Password;
    /**
     * @var UserPreferences
     */
    public $Preferences;
    /**
     * @var Zone
     */
    public $DefaultZone;


    /**
     * @param $value
     */
    protected function setPreferencesAttribute($value)
    {
        if (!empty($value) && is_array($value)) {
            if (!empty($this->Preferences)) unset($this->Preferences);
            $this->Preferences = new UserPreferences($value);
        }
    }

    /**
     * @param $value
     */
    protected function setDefaultZoneAttribute($value)
    {
        if (!empty($value) && in_array($value)) {
            if (!empty($this->DefaultZone)) unset($this->DefaultZone);
            $this->DefaultZone = new Zone($value);
        }
    }

}