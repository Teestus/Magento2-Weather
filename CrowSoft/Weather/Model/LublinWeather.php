<?php
/**
 * @author    Leszek Kruk
 */

namespace CrowSoft\Weather\Model;

use Magento\Framework\Model\AbstractModel;
use CrowSoft\Weather\Api\Data\WeatherInterface;

/**
 * Class LublinWeather
 *
 * @package CrowSoft\Weather\Model
 */
class LublinWeather extends AbstractModel implements WeatherInterface
{
    /**
     *
     */
    const CACHE_TAG = 'crowsoft_weather_lublinweather';

    /**
     * @var string
     */
    protected $_cacheTag = 'crowsoft_weather_lublinweather';

    /**
     * @var string
     */
    protected $_eventPrefix = 'crowsoft_weather_lublinweather';

    /**
     *
     */
    protected function _construct()
    {
        $this->_init(ResourceModel\LublinWeather::class);
    }

    /**
     * @param int $id
     *
     * @return $this
     */
    public function setId($id)
    {
        return $this->setData(self::ENTITY_ID, $id);
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->getData(self::ENTITY_ID);
    }

    /**
     * @param string $text
     *
     * @return $this
     */
    public function setWeatherText($text)
    {
        return $this->setData(self::WEATHER_TEXT, $text);
    }

    /**
     * @return string
     */
    public function getWeatherText()
    {
        return $this->getData(self::WEATHER_TEXT);
    }

    /**
     * @param string $metric
     *
     * @return $this
     */
    public function setMetric($metric)
    {
        return $this->setData(self::METRIC, $metric);
    }

    /**
     * @return string
     */
    public function getMetric()
    {
        return $this->getData(self::METRIC);
    }

    /**
     * @param string $imperial
     *
     * @return $this
     */
    public function setImperial($imperial)
    {
        return $this->setData(self::IMPERIAL, $imperial);
    }

    /**
     * @return string
     */
    public function getImperial()
    {
        return $this->getData(self::IMPERIAL);
    }

    /**
     * @param $createdAt
     *
     * @return $this
     */
    public function setCreatedAt($createdAt)
    {
        return $this->setData(self::CREATED_AT, $createdAt);
    }

    /**
     * @return string
     */
    public function getCreatedAt()
    {
        return $this->getData(self::CREATED_AT);
    }
}
