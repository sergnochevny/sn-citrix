<?php

namespace Citrix\ShareFile\Api\Models;

/**
 * Class SearchQuery
 * @package src\ShareFile\Api\Models
 */
class SearchQuery extends BaseModel
{
    /**
     * @var SimpleQuery
     */
    public $Query;
    /**
     * @var QueryPaging
     */
    public $Paging;
    /**
     * @var QuerySorting
     */
    public $Sort;
    /**
     * @var
     */
    public $TimeoutInSeconds;

    /**
     * SimpleSearchQuery constructor.
     * @param null $query
     * @param null $paging
     * @param null $sort
     */
    public function __construct($query = null, $paging = null, $sort = null)
    {
        $this->Query = new Query($query);
        $this->Paging = new QueryPaging($paging);
        $this->Sort = new QuerySorting($sort);
    }
}
