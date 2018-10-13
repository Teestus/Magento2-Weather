<?php
/**
 * @author    Leszek Kruk
 */

namespace CrowSoft\Weather\Model\ResourceModel\LublinWeather;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use CrowSoft\Weather\Model\LublinWeather as LublinWeatherModel;
use CrowSoft\Weather\Model\ResourceModel\LublinWeather;
use CrowSoft\Weather\Api\Data\WeatherInterface;

/**
 * Class Collection
 *
 * @package CrowSoft\Weather\Model\ResourceModel\LublinWeather
 */
class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(LublinWeatherModel::class, LublinWeather::class);
        $this->_idFieldName = WeatherInterface::ENTITY_ID;
    }
}
