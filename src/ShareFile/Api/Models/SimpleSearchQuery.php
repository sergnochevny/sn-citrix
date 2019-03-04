<?php
/**
 * Created by PhpStorm.
 * User: Serg
 * Date: 05.01.2017
 * Time: 17:32
 */

namespace Citrix\ShareFile\Api\Models;

/**
 * Class SimpleSearchQuery
 * @package src\ShareFile\Api\Models
 */
class SimpleSearchQuery extends BaseModel
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
     * @param array $attributes
     * @internal param null $query
     * @internal param null $paging
     * @internal param null $sort
     */
    public function __construct($attributes = [])
    {
        extract($attributes);
        /**
         * @var $query = null,
         * @var $paging = null,
         * @var $sort = null
         */
        parent::__construct($attributes);
        $this->Query = new SimpleQuery(isset($query) ? $query : []);
        $this->Paging = new QueryPaging(isset($paging) ? $paging : []);
        $this->Sort = new QuerySorting(isset($sort) ? $sort : []);
    }
}
