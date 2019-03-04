<?php

namespace Citrix\Endpoints;

use ait\guzzle\Client;
use ait\guzzle\Exception\RequestException;
use ait\guzzle\HandlerStack;
use Citrix\CitrixApi;
use Citrix\Traits\GetMethodsPropertiesTrait;
use Citrix\Traits\SetPropertiesTrait;

/**
 * Class BaseEndpoint
 * @package src\Endpoints
 */
abstract class BaseEndpoint
{
    use SetPropertiesTrait;
    use GetMethodsPropertiesTrait;

    /**
     * @var CitrixApi
     */
    protected $api;
    /**
     * @var string
     */
    protected $endpoint = '';

    /**
     * BaseEndpoint constructor.
     *
     * @param CitrixApi $api
     */
    public function __construct(CitrixApi $api)
    {
        $this->api = $api;
    }

    /**
     * @param string $endpoint_extension
     * @param array $options
     * @return \Psr\Http\Message\ResponseInterface
     */
    protected function get($endpoint_extension = '', $options = [])
    {
        return $this->api->get($this->endpoint . $endpoint_extension, $options);
    }

    /**
     * @param string $endpoint_extenstion
     * @param array $options
     * @return \Psr\Http\Message\ResponseInterface
     */
    protected function post($endpoint_extenstion = '', $options = [])
    {
        return $this->api->post($this->endpoint . $endpoint_extenstion, $options);
    }

    /**
     * @param string $endpoint_extension
     * @param array $options
     * @return \Psr\Http\Message\ResponseInterface
     */
    protected function put($endpoint_extension = '', $options = [])
    {
        return $this->api->put($this->endpoint . $endpoint_extension, $options);
    }

    /**
     * @param string $endpoint_extenstion
     * @param array $options
     * @return \Psr\Http\Message\ResponseInterface
     */
    protected function patch($endpoint_extenstion = '', $options = [])
    {
        return $this->api->patch($this->endpoint . $endpoint_extenstion, $options);
    }

    /**
     * @param string $endpoint_extension
     * @param array $options
     * @return \Psr\Http\Message\ResponseInterface
     */
    protected function delete($endpoint_extension = '', $options = [])
    {
        return $this->api->delete($this->endpoint . $endpoint_extension, $options);
    }

    /**
     * @param string $request
     * @param array $options
     * @return null
     * @throws \Exception
     */
    protected function postRequest($request = '', array $options)
    {
        try {
            $response = $this->post($request, $options);
            if (empty($response)) {
                throw new \Exception('Bad Request');
            }
            $code = $response->getStatusCode();
            $body_stream = $response->getBody();
            if ($size = $body_stream->getSize()) {
                $body_stream->rewind();
                $body = $body_stream->read($size);
                $response = \ait\guzzle\json_decode($body);

                if ($code < 400) {
                    return $response;
                }

                throw new \Exception($response->messsage->value);
            }
            throw new \Exception($response->getReasonPhrase());
        } catch (RequestException $e) {
            $response = $e->getResponse();
            if (isset($response)) {
                $body_stream = $response->getBody();
                if ($size = $body_stream->getSize()) {
                    $body_stream->rewind();
                    $body = $body_stream->read($size);
                    $response = \ait\guzzle\json_decode($body);
                    throw new \Exception($response->message->value);
                } else {
                    throw $e;
                }
            } else {
                throw $e;
            }
        }
    }

    /**
     * @param string $request
     * @param array $options
     * @return null
     * @throws \Exception
     */
    protected function patchRequest($request = '', array $options)
    {
        try {
            $response = $this->patch($request, $options);
            if (empty($response)) {
                throw new \Exception('Bad Request');
            }
            $code = $response->getStatusCode();
            $body_stream = $response->getBody();
            if ($size = $body_stream->getSize()) {
                $body_stream->rewind();
                $body = $body_stream->read($size);
                $response = \ait\guzzle\json_decode($body);

                if ($code < 400) {
                    return $response;
                }

                throw new \Exception($response->messsage->value);
            }
            throw new \Exception($response->getReasonPhrase());
        } catch (RequestException $e) {
            $response = $e->getResponse();
            if (isset($response)) {
                $body_stream = $response->getBody();
                if ($size = $body_stream->getSize()) {
                    $body_stream->rewind();
                    $body = $body_stream->read($size);
                    $response = \ait\guzzle\json_decode($body);
                    throw new \Exception($response->message->value);
                } else {
                    throw $e;
                }
            } else {
                throw $e;
            }
        }
    }

    /**
     * @param string $request
     * @param array $options
     * @return null
     * @throws \Exception
     */
    protected function putRequest($request = '', array $options)
    {
        try {
            $response = $this->put($request, $options);
            if (empty($response)) {
                throw new \Exception('Bad Request');
            }
            $code = $response->getStatusCode();
            $body_stream = $response->getBody();
            if ($size = $body_stream->getSize()) {
                $body_stream->rewind();
                $body = $body_stream->read($size);
                $response = \ait\guzzle\json_decode($body);

                if ($code < 400) {
                    return $response;
                }

                throw new \Exception($response->messsage->value);
            }
            throw new \Exception($response->getReasonPhrase());
        } catch (RequestException $e) {
            $response = $e->getResponse();
            if (isset($response)) {
                $body_stream = $response->getBody();
                if ($size = $body_stream->getSize()) {
                    $body_stream->rewind();
                    $body = $body_stream->read($size);
                    $response = \ait\guzzle\json_decode($body);
                    throw new \Exception($response->message->value);
                } else {
                    throw $e;
                }
            } else {
                throw $e;
            }
        }
    }

    /**
     * @param string $request
     * @param array $options
     * @return null
     * @throws \Exception
     */
    protected function postFileRequest($request = '', array $options)
    {
        try {
            $client_options = null;
            $stack = HandlerStack::create();
            $client_options['handler'] = $stack;

            $client = new Client($client_options);
            $response = $client->post($request, $options);
            if (empty($response)) {
                throw new \Exception('Bad Request');
            }
            $code = $response->getStatusCode();
            $body_stream = $response->getBody();
            if ($size = $body_stream->getSize()) {
                $body_stream->rewind();
                $body = $body_stream->read($size);

                if ($code < 400) {
                    return $body;
                }

                $response = \ait\guzzle\json_decode($body);
                throw new \Exception($response->messsage->value);
            }
            throw new \Exception($response->getReasonPhrase());
        } catch (RequestException $e) {
            $response = $e->getResponse();
            if (isset($response)) {
                $body_stream = $response->getBody();
                if ($size = $body_stream->getSize()) {
                    $body_stream->rewind();
                    $body = $body_stream->read($size);
                    $response = \ait\guzzle\json_decode($body);
                    throw new \Exception($response->message->value);
                } else {
                    throw $e;
                }
            } else {
                throw $e;
            }
        }
    }

    /**
     * @param string $request
     * @param array $options
     * @return bool|null
     * @throws \Exception
     */
    protected function deleteRequest($request = '', array $options)
    {
        try {
            $response = $this->delete($request, $options);
            if (empty($response)) {
                throw new \Exception('Bad Request');
            }
            $code = $response->getStatusCode();
            if ($code < 400) {
                return true;
            }
            throw new \Exception($response->getReasonPhrase());
        } catch (RequestException $e) {
            $response = $e->getResponse();
            if (isset($response)) {
                $body_stream = $response->getBody();
                if ($size = $body_stream->getSize()) {
                    $body_stream->rewind();
                    $body = $body_stream->read($size);
                    $response = \ait\guzzle\json_decode($body);
                    throw new \Exception($response->message->value);
                } else {
                    throw $e;
                }
            } else {
                throw $e;
            }
        }
    }

    /**
     * @param array $request
     * @param array $options
     * @return null
     * @throws \Exception
     */
    protected function getRequest($request = ['request' => '', 'response_type' => 'body'], array $options = [])
    {
        extract($request);
        /**
         * @var $request ;
         * @var $response_type ;
         */
        try {
            $response = $this->get($request, $options);
            if (empty($response)) {
                throw new \Exception('Bad Request');
            }
            $code = $response->getStatusCode();
            $body_stream = $response->getBody();
            if ($size = $body_stream->getSize()) {
                $body_stream->rewind();
                if ($code < 400) {
                    switch ($response_type) {
                        case 'body':
                            $body = $body_stream->read($size);
                            $response = $body;
                            break;
                        case 'stream':
                            $response = $body_stream;
                            break;
                        case 'parsed_body':
                            $body = $body_stream->read($size);
                            $response = \ait\guzzle\json_decode($body);
                            break;
                    }
                    return $response;
                }

                $body = $body_stream->read($size);
                $response = \ait\guzzle\json_decode($body);
                throw new \Exception($response->message->value);
            }

            throw new \Exception($response->getReasonPhrase());
        } catch (RequestException $e) {
            $response = $e->getResponse();
            if (isset($response)) {
                $body_stream = $response->getBody();
                if ($size = $body_stream->getSize()) {
                    $body_stream->rewind();
                    $body = $body_stream->read($size);
                    $response = \ait\guzzle\json_decode($body);
                    throw new \Exception($response->message->value);
                } else {
                    throw $e;
                }
            } else {
                throw $e;
            }
        }
    }

    /**
     * @param string $request
     * @param array $options
     * @return null
     */
    protected function getRequestBody($request = '', array $options = [])
    {
        $request = ['request' => $request, 'response_type' => 'body'];
        return $this->getRequest($request, $options);
    }

    /**
     * @param string $request
     * @param $options
     * @return null
     */
    protected function getRequestBodyStream($request = '', array $options = [])
    {
        $request = ['request' => $request, 'response_type' => 'stream'];
        return $this->getRequest($request, $options);
    }

    /**
     * @param string $request
     * @param array $options
     * @return null
     */
    protected function getRequestParsedBody($request = '', array $options = [])
    {
        $request = ['request' => $request, 'response_type' => 'parsed_body'];
        return $this->getRequest($request, $options);
    }
}
