<?php

namespace Mobly\Cache\Adapter\Predis;

/**
 * Interface PredisAdapterInterface
 *
 * @package Mobly\Cache\Adapter\Predis
 */
interface PredisAdapterInterface
{
    const DEFAULT_DB = 0;

    const DELETE_KEY_OK = 1;

    const DELETE_KEY_NOT_FOUND = 0;

    const SCHEME_PARAMETER = 'scheme';

    const HOST_PARAMETER = 'host';

    const PORT_PARAMETER = 'port';

    const CONNECTION_TIMEOUT_PARAMETER = 'connection_timeout';

    const READ_WRITE_TIMEOUT_PARAMETER = 'read_write_timeout';

    const TIMEOUT_PARAMETER = 'timeout';

    const PERSISTENT_PARAMETER = 'persistent';

    const CLUSTER_OPTION = 'cluster';

    const REDIS_CLUSTER = 'redis';
}