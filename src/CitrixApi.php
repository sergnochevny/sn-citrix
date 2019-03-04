<?php

namespace Citrix;

use ait\guzzle\Client;
use ait\guzzle\HandlerStack;
use ait\guzzle\MessageFormatter;
use ait\guzzle\Middleware;
use Citrix\Endpoints\Authentication;
use Citrix\Endpoints\Items;
use Citrix\Endpoints\Shares;
use Citrix\Endpoints\Users;
use Citrix\Endpoints\Zones;
use Citrix\Traits\SetPropertiesTrait;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;

/**
 * Class CitrixApi
 * @package src
 */

/**
 * @property \Citrix\Endpoints\Items Items
 * @property \Citrix\Endpoints\Zones Zones
 * @property \Citrix\Endpoints\Users Users
 * @property \Citrix\Endpoints\Shares Shares
 *
 * @method CitrixApi setLogDir($value)
 * @method CitrixApi setSubdomain($value)
 * @method CitrixApi setClientId($value)
 * @method CitrixApi setClientSecret($value)
 * @method CitrixApi setUsername($value)
 * @method CitrixApi setPassword($value)
 * @method CitrixApi setLogging($value)
 * @method CitrixApi setRedirect($value)
 * @method CitrixApi setThumbnailSize($value)
 * @method CitrixApi setOverwrite($value)
 * @method CitrixApi setPassthrough($value)
 * @method CitrixApi setUploadMethod($value)
 * @method CitrixApi setUploadRaw($value)
 * @method CitrixApi setSingleVersion($value)
 * @method CitrixApi setForceSync($value)
 * @method CitrixApi setCanCreateRootFolder($value)
 * @method CitrixApi setPath($value)
 *
 */
class CitrixApi extends Client
{
    use SetPropertiesTrait;


    /**
     *
     */
    const TRUE = true;
    /**
     *
     */
    const FALSE = false;
    /**
     * @var
     */
    public static $Instance;
    /**
     * @var bool
     */
    private $initialized = false;
    /**
     * @var string
     */
    private $subdomain = '';
    /**
     * @var string
     */
    private $client_id = '';
    /**
     * @var string
     */
    private $client_secret = '';
    /**
     * @var string
     */
    private $username = '';
    /**
     * @var string
     */
    private $password = '';
    /**
     * @var array
     */
    private $options = [];
    /**
     * @var string
     */
    protected $base_url;
    /**
     * @var object|null
     */
    protected $token;
    /**
     * @var Logger|null
     */
    protected $logger;


    /**
     * @var null
     */
    public $log = YII_DEBUG ? '@runtime/logs/api-consumer.log' : null;

    /**
     * CitrixApi constructor.
     * @param array $options
     */
    public function __construct($options = [])
    {
        if (!isset($options['handler'])) {
            if (empty($this->log)) {
                $options['handler'] = HandlerStack::create();
            } else {
                $options['handler'] = $this->createLoggingHandlerStack([
                    '{method} {uri} HTTP/{version} {req_body}',
                    'RESPONSE: {code} - {res_body}',
                ]);
            }
        }
        // Convert the base_uri to a UriInterface
        if (isset($options['base_uri'])) {
            $options['base_uri'] = \GuzzleHttp\Psr7\uri_for($options['base_uri']);
        }
        $this->options = array_filter($options);
    }

    /**
     * @return mixed
     */
    public static function getInstance()
    {
        if (empty(self::$Instance)) {
            self::$Instance = new self();
        }
        return self::$Instance;
    }

    /**
     * @return CitrixApi|Logger|null
     */
    private function getLogger()
    {
        if (!$this->logger) {
            $this->logger = (new Logger('api-consumer'))->pushHandler(
                new RotatingFileHandler(\Yii::getAlias($this->log))
            );
        }

        return $this->logger;
    }

    /**
     * @param $messageFormat
     * @return callable
     */
    private function createGuzzleLoggingMiddleware($messageFormat)
    {
        return Middleware::log(
            $this->getLogger(),
            new MessageFormatter($messageFormat)
        );
    }

    /**
     * @param array $messageFormats
     * @return HandlerStack
     */
    private function createLoggingHandlerStack(array $messageFormats)
    {
        $stack = HandlerStack::create();

        foreach ($messageFormats as $messageFormat) {
            // We'll use unshift instead of push, to add the middleware to the bottom of the stack, not the top
            $stack->unshift(
                $this->createGuzzleLoggingMiddleware($messageFormat)
            );
        }

        return $stack;
    }

    /**
     * @return null
     * @throws \Exception
     */
    private function getTokenRequest()
    {
        if (!isset($this->token)) {
            $auth = new Authentication($this);
            $auth->setClientId($this->client_id)
                ->setClientSecret($this->client_secret)
                ->setUsername($this->username)
                ->setPassword($this->password);
            $this->token = $auth->token;
        }
        return $this->token;
    }

    /**
     * @param string $name
     *
     * @return mixed
     */
    public function __get($name = '')
    {
        $method = 'get' . ucwords($name) . 'Service';
        if (method_exists($this, $method)) {
            return $this->$method();
        }
        return $this->$name;
    }

    /**
     *
     */
    public function Initialize()
    {
        if (!$this->initialized) {
            $auth_url = "https://" . $this->subdomain . ".sharefile.com";
            $config = array_merge(['base_uri' => $auth_url], $this->options);
            $this->configureDefaults($config);
            $this->token = $this->getTokenRequest();
            $this->initialized = true;
        }
        $this->base_url = "https://" . $this->subdomain . ".sf-api.com";
        $config = array_merge([
            'base_uri' => $this->base_url,
            'headers' => ["Authorization" => "Bearer " . $this->token->access_token]
        ], $this->options);
        $this->configureDefaults($config);
    }

    /**
     * @return Items
     */
    public function getItemsService()
    {
        return new Items($this);
    }

    /**
     * @return Users
     */
    public function getUsersService()
    {
        return new Users($this);
    }

    /**
     * @return Zones
     */
    public function getZonesService()
    {
        return new Zones($this);
    }

    /**
     * @return Shares
     */
    public function getSharesService()
    {
        return new Shares($this);
    }
}
