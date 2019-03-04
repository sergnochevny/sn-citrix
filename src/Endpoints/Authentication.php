<?php

namespace Citrix\Endpoints;

/**
 * Class Authentication
 * @package src\Endpoints
 *
 * @property string token
 */
use ait\guzzle\Exception\RequestException;

/**
 * Class Authentication
 * @package src\Endpoints
 *
 * @property object token
 * @method Authentication setClientId($value)
 * @method Authentication setClientSecret($value)
 * @method Authentication setEndpoint($value)
 * @method Authentication setUsername($value)
 * @method Authentication setPassword($value)
 */
class Authentication extends BaseEndpoint
{

    /**
     * @var array
     */
    private static $avail_grant_types = ["password"];
    /**
     * @var string
     */
    protected $endpoint = '/oauth';
    /**
     * @var string
     */
    protected $grant_type = "password";
    /**
     * @var string
     */
    protected $client_id = '';
    /**
     * @var string
     */
    protected $client_secret = '';
    /**
     * @var string
     */
    protected $username = '';
    /**
     * @var string
     */
    protected $password = '';

    /**
     * @return null
     * @throws \Exception
     */
    public function getToken()
    {
        $grant_type = (in_array($this->grant_type, static::$avail_grant_types)) ? $this->grant_type : "password";
        switch ($grant_type) {
            case "password":
                $client_id = $this->client_id;
                $client_secret = $this->client_secret;
                $username = $this->username;
                $password = $this->password;
                try {
                    $response = $this->post(
                        '/token',
                        [
                            'headers' => ['Content-Type' => 'application/x-www-form-urlencoded'],
                            'form_params' => compact('grant_type', 'client_id', 'client_secret', 'username', 'password')
                        ]
                    );
                    if (empty($response)) {
                        throw new \Exception('Bad Request');
                    }
                    $body_stream = $response->getBody();
                    $code = $response->getStatusCode();
                    if ($code < 400) {
                        if ($size = $body_stream->getSize()) {
                            $body_stream->rewind();
                            $body = $body_stream->read($size);
                            return \ait\guzzle\json_decode($body);
                        }
                    }
                } catch (\Throwable $e) {
                    echo($e->getMessage());
                } catch (RequestException $e) {
                    $response = $e->getResponse();
                    if (isset($response)) {
                        $body_stream = $response->getBody();
                        if ($size = $body_stream->getSize()) {
                            $body_stream->rewind();
                            $body = $body_stream->read($size);
                            $response = \ait\guzzle\json_decode($body);
                            throw new \Exception($response->error_description);
                        } else {
                            throw $e;
                        }
                    } else {
                        throw $e;
                    }
                } catch (\Exception $e) {
                    echo($e->getMessage());
                }
                break;
        }
        return null;
    }
}
