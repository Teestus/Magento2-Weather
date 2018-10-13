<?php
/**
 * @author    Leszek Kruk
 */

namespace CrowSoft\Weather\Logger;

use Monolog\Logger as MonologLogger;

/**
 * Class Logger
 *
 * @package CrowSoft\Weather\Logger
 */
class Logger extends MonologLogger
{
    /**
     * Logger constructor.
     *
     * @param string $name
     * @param array  $handlers
     * @param array  $processors
     */
    public function __construct(string $name, $handlers = array(), $processors = array())
    {
        parent::__construct($name, $handlers, $processors);
    }
}
