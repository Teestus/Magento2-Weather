<?php
/**
 * @author    Leszek Kruk
 */

namespace CrowSoft\Weather\Logger\Handler;

use Magento\Framework\Logger\Handler\Base;

/**
 * Class Handler
 *
 * @package CrowSoft\Weather\Logger\Handler
 */
class Handler extends Base
{
    /**
     * File name
     *
     * @var string
     */
    protected $fileName = '/var/log/lublin_weather.log';

    /**
     * @return string
     */
    public function getFileName(): string
    {
        return $this->fileName;
    }
}
