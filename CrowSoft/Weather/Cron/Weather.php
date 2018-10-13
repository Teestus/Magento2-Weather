<?php
/**
 * @author    Leszek Kruk
 */

namespace CrowSoft\Weather\Cron;

use CrowSoft\Weather\Model\Api\WeatherApi;
use CrowSoft\Weather\Logger\Logger;

/**
 * Class Weather
 *
 * @package CrowSoft\Weather\Cron
 */
class Weather
{
    /** @var WeatherApi */
    protected $api;

    /** @var Logger */
    protected $logger;

    /**
     * Weather constructor.
     *
     * @param Logger     $logger
     * @param WeatherApi $api
     */
    public function __construct(
        Logger $logger,
        WeatherApi $api
    ) {
        $this->logger = $logger;
        $this->api    = $api;
    }

    /**
     * Cron execute method
     */
    public function execute()
    {
        try {
            $this->api->request();
        } catch (\Exception $e) {
            $this->logger->addError($e->getMessage());
        }
    }
}
