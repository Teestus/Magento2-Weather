<?php
/**
 * @author    Leszek Kruk
 */

namespace CrowSoft\Weather\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

/**
 * Interface WeatherSearchResultInterface
 *
 * @package CrowSoft\Weather\Api\Data
 */
Interface WeatherSearchResultInterface extends SearchResultsInterface
{
    /**
     * Get attributes list.
     *
     * @return WeatherInterface[]
     */
    public function getItems();

    /**
     * Set attributes list.
     *
     * @param WeatherInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
