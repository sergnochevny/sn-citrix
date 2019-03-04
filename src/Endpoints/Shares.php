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
 * @method Items setId($value)
 * @method Items setIncludeDeleted($value)
 *
 */
class Shares extends BaseEndpoint
{

    /**
     * @var null
     */
    protected $id = null;
    /**
     * @var string
     */
    protected $endpoint = '/sf/v3/Shares';
    /**
     * @var bool
     */
    protected $include_deleted = false;

    /**
     * @return mixed
     */
    public function getZones()
    {
        $query = null;
        $query['includeDeleted'] = $this->include_deleted ? 'true' : 'false';
        if (!empty($query)) $options['query'] = $query;
        $request = (!empty($this->id)) ? '(' . $this->id . ')' : '';
        $res = $this->getRequestParsedBody($request, $options);
        $class = 'Citrix\\'.str_replace('.', '\\', $res->{'odata.type'});
        return new $class($res);
    }

    /**
     * @param Folder $folder
     * @return mixed
     */
    public function CreateFolder(Folder $folder)
    {
        $options = ['json' => $folder->toArray()];
        $query['overwrite'] = $this->overwrite ? 'true' : 'false';
        $query['passthrough'] = $this->passthrough ? 'true' : 'false';
        if (!empty($query)) $options['query'] = $query;
        $request = (!empty($this->id)) ? '(' . $this->id . ')' : '';
        $request .= '/Folder';
        $res = $this->postRequest($request, $options);
        $class = 'Citrix\\'.str_replace('.', '\\', $res->{'odata.type'});
        return new $class($res);
    }

    /**
     * @param Item $note
     * @return mixed
     */
    public function UpdateNote(Item $note)
    {
        $options = ['json' => $note->toArray()];
        $query['notify'] = $this->notify ? 'true' : 'false';
        if (!empty($query)) $options['query'] = $query;
        $request = '/Note';
        $request .= (!empty($this->id)) ? '(' . $this->id . ')' : '';
        $res = $this->patchRequest($request, $options);
        $class = 'Citrix\\'.str_replace('.', '\\', $res->{'odata.type'});
        return new $class($res);
    }

}
