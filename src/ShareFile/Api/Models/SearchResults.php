<?php

namespace Citrix\ShareFile\Api\Models;

/**
 * Class SearchResults
 * @package src\ShareFile\Api\Models
 */
class SearchResults extends BaseModel
{
    /**
     * @var
     */
    public $PartialResults;
    /**
     * @var
     */
    public $Results;
    /**
     * @var
     */
    public $TimedOut;

    /**
     * @param $value
     */
    protected function setResultsAttribute($value)
    {
        if (isset($value) && is_array($value)) {
            $results = [];
            foreach ($value as $result) {
                if (!empty($result->{'odata.type'})) {
                    $class = 'Citrix\\'.str_replace('.', '\\', $result->{'odata.type'});
                    $results[] = new $class($result);
                } else {
                    $results[] = $result;
                }
            }
            $this->Results = $results;
        } else {
            $this->Results = $value;
        }
    }
}
