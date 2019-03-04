<?php

namespace Citrix\Endpoints;

use GuzzleHttp\Psr7\Stream;
use Citrix\ShareFile\Api\Models\File;
use Citrix\ShareFile\Api\Models\Folder;
use Citrix\ShareFile\Api\Models\Item;
use Citrix\ShareFile\Api\Models\ItemInfo;
use Citrix\ShareFile\Api\Models\Link;
use Citrix\ShareFile\Api\Models\Note;
use Citrix\ShareFile\Api\Models\SearchQuery;
use Citrix\ShareFile\Api\Models\SimpleSearchQuery;

/**
 * @property Zones
 * @property Zone
 *
 * @method Zones setId($value)
 * @method Zones setIncludeDeleted($value)
 * @method Zones setSecret($value)
 *
 */
class Zones extends BaseEndpoint
{

    /**
     * @var null
     */
    protected $id = null;
    /**
     * @var string
     */
    protected $endpoint = '/sf/v3/Zones';
    /**
     * @var bool
     */
    protected $include_deleted = false;
    /**
     * @var bool
     */
    protected $secret = false;

    /**
     * @return array
     */
    public function getZones()
    {
        $options = [];
        $query = null;
        $query['includeDeleted'] = $this->include_deleted ? 'true' : 'false';
        if (!empty($query)) $options['query'] = $query;
        $res = $this->getRequestParsedBody('', $options);
        $zones = [];
        if (isset($res->value)) {
            foreach ($res->value as $zone) {
                $class = 'Citrix\\' . str_replace('.', '\\', $zone->{'odata.type'});
                $zones[] = new $class($zone);

            }
        }
        return $zones;
    }

    /**
     * @return mixed
     */
    public function getZone()
    {
        $options = [];
        $query = null;
        $query['secret'] = $this->secret ? 'true' : 'false';
        if (!empty($query)) $options['query'] = $query;
        $request = (!empty($this->id)) ? '(' . $this->id . ')' : '';
        $res = $this->getRequestParsedBody($request, $options);
        $class = 'Citrix\\' . str_replace('.', '\\', $res->{'odata.type'});
        return new $class($res);
    }

}
