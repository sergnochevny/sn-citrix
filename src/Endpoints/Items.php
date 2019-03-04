<?php

namespace Citrix\Endpoints;

use ait\utilities\helpers\MIMEHelper;
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
 * @property Items Items
 * @property Items Root
 * @property Items Tree
 * @property Items Parent
 * @property Items Children
 * @property Items ItemsByPath
 * @property ItemInfo ItemAccessInfo
 * @property mixed ItemContent
 * @property mixed ItemContentStream
 * @property mixed StStream
 * @property mixed ThumbnailStream
 * @property mixed Thumbnail
 *
 * @method Items setId($value)
 * @method Items setFilter($value)
 * @method Items setExpandChildren($value)
 * @method Items setIncludeDeleted($value)
 * @method Items setTreemode($value)
 * @method Items setOrderBy($value)
 * @method Items setIncludeAllVersions($value)
 * @method Items setRedirect($value)
 * @method Items setThumbnailSize($value)
 * @method Items setOverwrite($value)
 * @method Items setPassthrough($value)
 * @method Items setUploadMethod($value)
 * @method Items setUploadRaw($value)
 * @method Items setSingleVersion($value)
 * @method Items setForceSync($value)
 * @method Items setCanCreateRootFolder($value)
 * @method Items setPath($value)
 * @method Items setNotify($value)
 * @method Items setHomeFolderOnly($value)
 * @method Items setMaxResults($value)
 * @method Items setSkip($value)
 *
 */
class Items extends BaseEndpoint
{
    /**
     *
     */
    const SHORT_FORMAT = ['Id', 'Name', 'odata.type', 'Children', 'Children/Id', 'Children/Name', 'Children/odata.type'];
    /**
     *
     */
    const FOLDER_FORMAT = ['FileCount', 'Id', 'Name', 'odata.type', 'CreationDate', 'Children', 'Children/Id', 'Children/Name', 'Children/CreationDate', 'Children/FileSizeInKB', 'Children/odata.type'];
    /**
     *
     */
    const FULL_FORMAT = '';
    /**
     *
     */
    const TREEMODE_COPY = 'copy';
    /**
     *
     */
    const TREEMODE_MOVE = 'move';
    /**
     *
     */
    const TREEMODE_MANAGE = 'manage';
    /**
     *
     */
    const THUMBNAIL_SMALL = 75;
    /**
     *
     */
    const THUMBNAIL_MIDDLE = 600;
    /**
     *
     */
    const UPLOAD_METHOD_STANDART = 'standart';
    /**
     *
     */
    const UPLOAD_METHOD_STREAMED = 'streamed';
    /**
     *
     */
    const UPLOAD_METHOD_THREADED = 'threaded';

    /**
     * @var null
     */
    protected $id = null;
    /**
     * @var null
     */
    protected $filter = null;
    /**
     * @var string
     */
    protected $endpoint = '/sf/v3/Items';
    /**
     * @var bool
     */
    protected $expand_children = false;
    /**
     * @var bool
     */
    protected $include_deleted = false;
    /**
     * @var string
     */
    protected $treemode = 'manage';
    /**
     * @var string
     */
    protected $source_id = '';
    /**
     * @var bool
     */
    protected $can_create_root_folder = false;
    /**
     * @var string
     */
    protected $order_by = '';
    /**
     * @var string
     */
    protected $path = '/';
    /**
     * @var bool
     */
    protected $include_all_versions = false;
    /**
     * @var bool
     */
    protected $redirect = true;
    /**
     * @var int
     */
    protected $thumbnail_size = 75;
    /**
     * @var bool
     */
    protected $force_sync = true;
    /**
     * @var bool
     */
    protected $single_version = false;
    /**
     * @var bool
     */
    protected $overwrite = false;
    /**
     * @var bool
     */
    protected $passthrough = false;
    /**
     * @var string
     */
    protected $upload_method = 'standart';
    /**
     * @var bool
     */
    protected $upload_raw = false;
    /**
     * @var bool
     */
    protected $notify = false;
    /**
     * @var bool
     */
    protected $home_folder_only = false;
    /**
     * @var string
     */
    protected $max_results = '';
    /**
     * @var string
     */
    protected $skip = '';

    /**
     * @return mixed
     */
    public function getRoot()
    {
        $options = [];
        $query = null;
        $this->id = '';
        $query['includeDeleted'] = $this->include_deleted ? 'true' : 'false';
        if ($this->expand_children) $query['$expand'] = 'Children';
        if (!empty($this->filter)) {
            if (is_string($this->filter)) $query['$select'] = $this->filter;
            if (is_array($this->filter) && (count($this->filter) > 0)) $query['$select'] = implode(',', array_map('trim', $this->filter));
        }
        if (!empty($this->order_by)) $query['$orderby'] = $this->order_by;
        if (!empty($query)) $options['query'] = $query;
        $res = $this->getRequestParsedBody('', $options);
        $class = 'Citrix\\'.str_replace('.', '\\', $res->{'odata.type'});
        return new $class($res);
    }

    /**
     * @return mixed
     */
    public function getItems()
    {
        $options = [];
        $query = null;
        $query['includeDeleted'] = $this->include_deleted ? 'true' : 'false';
        if ($this->expand_children) $query['$expand'] = 'Children';
        if (!empty($this->filter)) {
            if (is_string($this->filter)) $query['$select'] = $this->filter;
            if (is_array($this->filter) && (count($this->filter) > 0)) $query['$select'] = implode(',', array_map('trim', $this->filter));
        }
        if (!empty($this->order_by)) $query['$orderby'] = $this->order_by;
        if (!empty($query)) $options['query'] = $query;
        $request = (!empty($this->id)) ? '(' . $this->id . ')' : '';
        $res = $this->getRequestParsedBody($request, $options);
        $class = 'Citrix\\'.str_replace('.', '\\', $res->{'odata.type'});
        return new $class($res);
    }

    /**
     * @return mixed
     */
    public function getTree()
    {
        $options = [];
        $query = null;
        $query['treemode'] = $this->treemode;
        if (!empty($this->source_id)) $query['sourceId'] = $this->source_id;
        $query['canCreateRootFolder'] = $this->can_create_root_folder ? 'true' : 'false';
        if ($this->expand_children) $query['$expand'] = 'Children';
        if (!empty($this->filter)) {
            if (is_string($this->filter)) $query['$select'] = $this->filter;
            if (is_array($this->filter) && (count($this->filter) > 0)) $query['$select'] = implode(',', array_map('trim', $this->filter));
        }
        if (!empty($this->order_by)) $query['$orderby'] = $this->order_by;
        if (!empty($query)) $options['query'] = $query;
        $request = (!empty($this->id)) ? '(' . $this->id . ')' : '';
        $res = $this->getRequestParsedBody($request, $options);
        $class = 'Citrix\\'.str_replace('.', '\\', $res->{'odata.type'});
        return new $class($res);
    }

    /**
     * @return mixed
     */
    public function getParent()
    {
        $options = [];
        $query = null;
        $query['includeDeleted'] = $this->include_deleted ? 'true' : 'false';
        if ($this->expand_children) $query['$expand'] = 'Children';
        if (!empty($this->filter)) {
            if (is_string($this->filter)) $query['$select'] = $this->filter;
            if (is_array($this->filter) && (count($this->filter) > 0)) $query['$select'] = implode(',', array_map('trim', $this->filter));
        }
        if (!empty($this->order_by)) $query['$orderby'] = $this->order_by;
        if (!empty($query)) $options['query'] = $query;
        $request = (!empty($this->id)) ? '(' . $this->id . ')' : '';
        $request .= '/Parent';
        $res = $this->getRequestParsedBody($request, $options);
        $class = 'Citrix\\'.str_replace('.', '\\', $res->{'odata.type'});
        return new $class($res);
    }

    /**
     * @return mixed
     */
    public function getChildren()
    {
        $options = [];
        $query = null;
        $query['includeDeleted'] = $this->include_deleted ? 'true' : 'false';
        if ($this->expand_children) $query['$expand'] = 'Children';
        if (!empty($this->filter)) {
            if (is_string($this->filter)) $query['$select'] = $this->filter;
            if (is_array($this->filter) && (count($this->filter) > 0)) $query['$select'] = implode(',', array_map('trim', $this->filter));
        }
        if (!empty($this->order_by)) $query['$orderby'] = $this->order_by;
        if (!empty($query)) $options['query'] = $query;
        $request = (!empty($this->id)) ? '(' . $this->id . ')' : '';
        $request .= '/Children';
        $res = $this->getRequestParsedBody($request, $options);
        $class = 'Citrix\\'.str_replace('.', '\\', $res->{'odata.type'});
        return new $class($res);
    }

    /**
     * @return mixed
     */
    public function getItemsByPath()
    {
        $options = [];
        $query = null;
        $query['path'] = $this->path;
        $query['includeDeleted'] = $this->include_deleted ? 'true' : 'false';
        if ($this->expand_children) $query['$expand'] = 'Children';
        if (!empty($this->filter)) {
            if (is_string($this->filter)) $query['$select'] = $this->filter;
            if (is_array($this->filter) && (count($this->filter) > 0)) $query['$select'] = implode(',', array_map('trim', $this->filter));
        }
        if (!empty($this->order_by)) $query['$orderby'] = $this->order_by;
        if (!empty($query)) $options['query'] = $query;
        $request = (!empty($this->id)) ? '(' . $this->id . ')' : '';
        $request .= '/ByPath';
        $res = $this->getRequestParsedBody($request, $options);
        $class = 'Citrix\\'.str_replace('.', '\\', $res->{'odata.type'});
        return new $class($res);
    }

    /**
     * @return mixed
     */
    public function getItemAccessInfo()
    {
        $options = [];
        $request = (!empty($this->id)) ? '(' . $this->id . ')' : '';
        $request .= '/Info';
        $res = $this->getRequestParsedBody($request, $options);
        $class = 'Citrix\\'.str_replace('.', '\\', $res->{'odata.type'});
        return new $class($res);
    }

    /**
     * @return null
     */
    public function getItemContent()
    {
        $options = [];
        $query['includeAllVersions'] = $this->include_all_versions ? 'true' : 'false';
        $query['redirect'] = $this->redirect ? 'true' : 'false';
        if (!empty($query)) $options['query'] = $query;
        $request = (!empty($this->id)) ? '(' . $this->id . ')' : '';
        $request .= '/Download';
        return $this->redirect ? $this->getRequestBody($request, $options) : $this->getRequestParsedBody($request, $options);
    }

    /**
     * @return null
     */
    public function getItemContentStream()
    {
        $options = [];
        $query['includeAllVersions'] = $this->include_all_versions ? 'true' : 'false';
        $query['redirect'] = $this->redirect ? 'true' : 'false';
        if (!empty($query)) $options['query'] = $query;
        $request = (!empty($this->id)) ? '(' . $this->id . ')' : '';
        $request .= '/Download';
        return $this->getRequestBodyStream($request, $options);
    }

    /**
     * @return null
     */
    public function getStream()
    {
        $options = [];
        $query['includeDeleted'] = $this->include_deleted ? 'true' : 'false';
        if (!empty($query)) $options['query'] = $query;
        $request = (!empty($this->id)) ? '(' . $this->id . ')' : '';
        $request .= '/Stream';
        return $this->getRequestParsedBody($request, $options);
    }

    /**
     * @return null
     */
    public function getThumbnailStream()
    {
        $options = [];
        $query['size'] = $this->thumbnail_size;
        $query['redirect'] = $this->redirect ? 'true' : 'false';
        if (!empty($query)) $options['query'] = $query;
        $request = (!empty($this->id)) ? '(' . $this->id . ')' : '';
        $request .= '/Thumbnail';
        return $this->getRequestBodyStream($request, $options);
    }

    /**
     * @return null
     */
    public function getThumbnail()
    {
        $options = [];
        $query['size'] = $this->thumbnail_size;
        $query['redirect'] = 'false';
        if (!empty($query)) $options['query'] = $query;
        $request = (!empty($this->id)) ? '(' . $this->id . ')' : '';
        $request .= '/Thumbnail';
        return $this->getRequestParsedBody($request, $options);
    }

    /**
     * @return bool|null
     */
    public function DeleteItem()
    {
        $options = [];
        $query['forceSync'] = $this->force_sync ? 'true' : 'false';
        $query['singleVersion'] = $this->single_version ? 'true' : 'false';
        if (!empty($query)) $options['query'] = $query;
        $request = (!empty($this->id)) ? '(' . $this->id . ')' : '';
        return $this->deleteRequest($request, $options);
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
    public function CreateNote(Item $note)
    {
        $options = ['json' => $note->toArray()];
        $request = (!empty($this->id)) ? '(' . $this->id . ')' : '';
        $request .= '/Note';
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

    /**
     * @param Item $item
     * @return mixed
     */
    public function UpdateItem(Item $item)
    {
        $options = ['json' => $item->toArray()];
        $query['overwrite'] = $this->overwrite ? 'true' : 'false';
        if (!empty($query)) $options['query'] = $query;
        $request = (!empty($this->id)) ? '(' . $this->id . ')' : '';
        $res = $this->patchRequest($request, $options);
        $class = 'Citrix\\'.str_replace('.', '\\', $res->{'odata.type'});
        return new $class($res);
    }

    /**
     * @param $local_file
     * @return null
     * @throws \Exception
     */
    public function UploadFile($local_file)
    {
        $options = [];
        if (file_exists($local_file) && is_readable($local_file)) {
//            $file = new File(['fileName' => basename($local_file), 'fileSize' => filesize($local_file)]);
            $query['method'] = $this->upload_method;
            $query['raw'] = $this->upload_raw ? 'true' : 'false';
            $query['fileName'] = basename($local_file);
            $query['fileSize'] = filesize($local_file);
            if (!empty($query)) $options['query'] = $query;
            $request = (!empty($this->id)) ? '(' . $this->id . ')' : '';
            $request .= '/Upload';
            $res = $this->getRequestParsedBody($request, $options);
            if (isset($res->ChunkUri)) {
                $url = $res->ChunkUri;
                $options = [
                    'multipart' => [
                        [
                            'name' => 'File1',
                            'filename' => $local_file,
                            'contents' => \GuzzleHttp\Psr7\stream_for(fopen($local_file, 'rb')),
                            'headers' => ['Content-Type' => MIMEHelper::getFileType($local_file)]
                        ]
                    ]
                ];
                $res = $this->postFileRequest($url, $options);
                return $res;
            } else throw new \Exception('Error Upload');
        } else throw new \Exception('File not exist!');
    }

    /**
     * @param $value
     * @return mixed
     */
    public function Search($value)
    {
        $query['query'] = $value;
        $query['homeFolderOnly'] = $this->home_folder_only ? 'true' : 'false';
        if (!empty($this->skip)) $query['skip'] = $this->skip;
        if (!empty($this->max_results)) $query['maxResults'] = $this->max_results;
        if (!empty($query)) $options['query'] = $query;
        $request = (!empty($this->id)) ? '(' . $this->id . ')' : '';
        $request .= '/Search';
        $res = $this->getRequestParsedBody($request, $options);
        $class = 'Citrix\\'.str_replace('.', '\\', $res->{'odata.type'});
        return new $class($res);
    }

    /**
     * @param SimpleSearchQuery $query
     * @return mixed
     */
    public function AdvansedSimpleSearch(SimpleSearchQuery $query)
    {
        $options = ['json' => $query->toArray()];
        $request = '/AdvancedSimpleSearch';
        $res = $this->postRequest($request, $options);
        $class = 'Citrix\\'.str_replace('.', '\\', $res->{'odata.type'});
        return new $class($res);
    }

    /**
     * @param SearchQuery $query
     * @return mixed
     */
    public function AdvansedSearch(SearchQuery $query)
    {
        $options = ['json' => $query->toArray()];
        $request = '/AdvancedSearch';
        $res = $this->postRequest($request, $options);
        $class = 'Citrix\\'.str_replace('.', '\\', $res->{'odata.type'});
        return new $class($res);
    }
}
