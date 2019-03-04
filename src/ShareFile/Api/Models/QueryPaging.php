<?php

namespace Citrix\ShareFile\Api\Models;


/**
 * Class QueryPaging
 * @package src\ShareFile\Api\Models
 */
class QueryPaging extends BaseModel
{
    /**
     * @var
     */
    public $PageNumber;
    /**
     * @var
     */
    public $PageSize;
    /**
     * @var
     */
    public $Count;
    /**
     * @var
     */
    public $Skip;
}