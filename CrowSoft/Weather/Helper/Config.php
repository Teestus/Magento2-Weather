<?php
/**
 * @author    Leszek Kruk
 */

namespace CrowSoft\Weather\Helper;

use Magento\Framework\App\Helper\AbstractHelper;

/**
 * Class Config
 *
 * @package CrowSoft\Weather\Helper
 */
class Config extends AbstractHelper
{
    /** Config paths */
    const WEATHER_GENERAL_API_KEY      = 'weather/general/api_key';
    const WEATHER_GENERAL_CITY         = 'weather/general/city';
    const WEATHER_GENERAL_LANGUAGE     = 'weather/general/language';
    const WEATHER_GENERAL_UNITS        = 'weather/general/units';
    const WEATHER_GENERAL_CRON         = 'weather/general/cron_enabled';
    const WEATHER_GENERAL_API_ENDPOINT = 'weather/general/api_endpoint';

    /**
     * @return mixed
     */
    public function getApiKey()
    {
        return $this->scopeConfig->getValue(self::WEATHER_GENERAL_API_KEY);
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->scopeConfig->getValue(self::WEATHER_GENERAL_CITY);
    }

    /**
     * @return mixed
     */
    public function getLanguage()
    {
        return $this->scopeConfig->getValue(self::WEATHER_GENERAL_LANGUAGE);
    }

    /**
     * @return mixed
     */
    public function getUnits()
    {
        return $this->scopeConfig->getValue(self::WEATHER_GENERAL_UNITS);
    }

    /**
     * @return mixed
     */
    public function isCronEnabled()
    {
        return $this->scopeConfig->isSetFlag(self::WEATHER_GENERAL_CRON);
    }

    /**
     * @return mixed
     */
    public function getApiEndpoint()
    {
        return $this->scopeConfig->getValue(self::WEATHER_GENERAL_API_ENDPOINT);
    }
}
