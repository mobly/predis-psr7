<?php

namespace Mobly\Cache\Adapter\Predis\Exception;

use Psr\Cache\CacheException;

/**
 * Class PredisConnectionException
 *
 * @package Mobly\Cache\Adapter\Redis\Exception
 */
class PredisConnectionException extends \RuntimeException implements CacheException
{

}