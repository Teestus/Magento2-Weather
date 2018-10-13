<?php
/**
 * @author    Leszek Kruk
 */

namespace CrowSoft\Weather\Block;

use Magento\Framework\View\Element\Template;
use CrowSoft\Weather\Model\ResourceModel\LublinWeather\Collection;
use CrowSoft\Weather\Helper\Config;
use CrowSoft\Weather\Api\Data\WeatherInterface;
use CrowSoft\Weather\Model\Config\Source\Units;

/**
 * Class Lublin
 *
 * @package CrowSoft\Weather\Block
 */
class Lublin extends Template
{
    /** @var Collection */
    protected $collection;

    /** @var Config */
    protected $config;

    /** @var WeatherInterface */
    protected $item;

    /**
     * Lublin constructor.
     *
     * @param Template\Context $context
     * @param Collection       $collection
     * @param Config           $config
     * @param array            $data
     */
    public function __construct(
        Template\Context $context,
        Collection $collection,
        Config $config,
        array $data = []
    ) {
        $this->collection = $collection;
        $this->config     = $config;
        parent::__construct($context, $data);
    }

    /**
     * @return WeatherInterface
     */
    public function getItem()
    {
        if (!$this->item) {
            $this->item = $this->collection->setOrder(WeatherInterface::CREATED_AT)->getFirstItem();
        }

        return $this->item;
    }

    /**
     * @param WeatherInterface $item
     *
     * @return string
     */
    public function getTemperature(WeatherInterface $item)
    {
        $units = $this->config->getUnits();

        switch ($units) {
            case Units::IMPERIAL_UNIT :
                return $item->getImperial()." °F";
            default :
                return $item->getMetric()." °C";
        }
    }
}
