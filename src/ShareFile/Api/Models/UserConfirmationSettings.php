<?php

namespace Citrix\ShareFile\Api\Models;


/**
 *
 * Class UserConfirmationSettings
 * @package src\ShareFile\Api\Models
 *
 * @method setFirstName($value)
 * @method setLastName($value)
 * @method setCompany($value)
 * @method setPassword($value)
 * @method setSecurityQuestion($value)
 * @method setSecurityQuestionAnswer($value)
 * @method setDayLightName($value)
 * @method setUTCOffset($value)
 * @method setDateFormat($value)
 * @method setTimeFormat($value)
 * @method setEmailInterval($value)
 * @method setUserNotificationLocale($value)
 *
 */
class UserConfirmationSettings extends BaseModel
{
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
     * @var
     */
    public $SecurityQuestion;
    /**
     * @var
     */
    public $SecurityQuestionAnswer;
    /**
     * @var
     */
    public $DayLightName;
    /**
     * @var
     */
    public $UTCOffset;
    /**
     * @var
     */
    public $DateFormat;
    /**
     * @var
     */
    public $TimeFormat;
    /**
     * @var
     */
    public $EmailInterval;
    /**
     * @var
     */
    public $UserNotificationLocale;
}