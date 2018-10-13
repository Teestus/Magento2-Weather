<?php
/**
 * @author    Leszek Kruk
 */

namespace CrowSoft\Weather\Model\Config\Source;

use Magento\Framework\Option\ArrayInterface;

/**
 * Class City
 *
 * @package CrowSoft\Weather\Model\Config\Source
 */
class City implements ArrayInterface
{
    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        return [
            [
                'value' => '274231',
                'label' => __('Lublin')
            ]
        ];
    }
}
