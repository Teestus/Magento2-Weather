<?php
/**
 * @author    Leszek Kruk
 */

namespace CrowSoft\Weather\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use CrowSoft\Weather\Api\Data\WeatherInterface;

/**
 * Class LublinWeather
 *
 * @package CrowSoft\Weather\Model\ResourceModel
 */
class LublinWeather extends AbstractDb
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(WeatherInterface::TABLE_NAME, WeatherInterface::ENTITY_ID);
    }
}