<?php

namespace Mobly\Cache\Adapter\Predis;

use Mobly\Cache\CacheAdapterConfiguration;

/**
 * Class PredisConfiguration
 *
 * @package Mobly\Cache\Adapter\Predis
 */
class PredisConfiguration extends CacheAdapterConfiguration
{
    /**
     * @var string
     */
    protected $scheme = 'tcp';

    /**
     * @var string
     */
    protected $host;

    /**
     * @var string
     */
    protected $port;

    /**
     * @var int
     */
    protected $connectionTimeout;

    /**
     * @var int
     */
    protected $readWriteTimeout;

    /**
     * @var int
     */
    protected $timeout;

    /**
     * @var bool
     */
    protected $persistent;

    /**
     * @var array
     */
    protected $options = [];

    /**
     * @return string
     */
    public function getScheme()
    {
        return $this->scheme;
    }

    /**
     * @param string $scheme
     */
    public function setScheme($scheme)
    {
        $this->scheme = $scheme;
    }

    /**
     * @return string
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * @param string $host
     */
    public function setHost($host)
    {
        $this->host = $host;
    }

    /**
     * @return string
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * @param string $port
     */
    public function setPort($port)
    {
        $this->port = $port;
    }

    /**
     * @return int
     */
    public function getConnectionTimeout()
    {
        return $this->connectionTimeout;
    }

    /**
     * @param int $connectionTimeout
     */
    public function setConnectionTimeout($connectionTimeout)
    {
        $this->connectionTimeout = $connectionTimeout;
    }

    /**
     * @return int
     */
    public function getReadWriteTimeout()
    {
        return $this->readWriteTimeout;
    }

    /**
     * @param int $readWriteTimeout
     */
    public function setReadWriteTimeout($readWriteTimeout)
    {
        $this->readWriteTimeout = $readWriteTimeout;
    }

    /**
     * @return int
     */
    public function getTimeout()
    {
        return $this->timeout;
    }

    /**
     * @param int $timeout
     */
    public function setTimeout($timeout)
    {
        $this->timeout = $timeout;
    }

    /**
     * @return bool
     */
    public function isPersistent()
    {
        return $this->persistent;
    }

    /**
     * @param bool $persistent
     */
    public function setPersistent($persistent)
    {
        $this->persistent = $persistent;
    }

    /**
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param $option
     * @param $value
     */
    public function setOptions($option, $value)
    {
        $this->options[$option] = $value;
    }

    /**
     * @return array
     */
    public function getParameters()
    {
        return [
            PredisAdapterInterface::SCHEME_PARAMETER => $this->getScheme(),
            PredisAdapterInterface::HOST_PARAMETER => $this->getHost(),
            PredisAdapterInterface::PORT_PARAMETER => $this->getPort(),
            PredisAdapterInterface::CONNECTION_TIMEOUT_PARAMETER => $this->getConnectionTimeout(),
            PredisAdapterInterface::READ_WRITE_TIMEOUT_PARAMETER => $this->getReadWriteTimeout(),
            PredisAdapterInterface::TIMEOUT_PARAMETER => $this->getTimeout(),
            PredisAdapterInterface::PERSISTENT_PARAMETER => $this->getPersistent(),
        ];
    }

}