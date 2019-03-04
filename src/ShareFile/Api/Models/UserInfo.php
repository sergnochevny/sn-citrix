<?php

namespace Citrix\ShareFile\Api\Models;

/**
 * Class UserInfo
 * @package src\ShareFile\Api\Models
 */
class UserInfo extends BaseModel
{
    /**
     * @var
     */
    public $CompanyName;
    /**
     * @var
     */
    public $PlanName;
    /**
     * @var
     */
    public $PlanFeatures;
    /**
     * @var
     */
    public $ApplicationUrl;
    /**
     * @var
     */
    public $StorageCenterUrl;
    /**
     * @var
     */
    public $url;

    /**
     * @param $value
     */
    protected function setPlanFeaturesAttribute($value)
    {
        if (isset($value) && !empty($value->{'odata.type'})) {
            $class = 'Citrix\\' . str_replace('.', '\\', $value->{'odata.type'});
            $this->PlanFeatures = new $class($value);
        } else {
            $this->PlanFeatures = $value;
        }
    }
}
