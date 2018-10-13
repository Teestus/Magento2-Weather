<?php
/**
 * @author    Leszek Kruk
 */

namespace CrowSoft\Weather\Model\Config\Source;

use Magento\Framework\Option\ArrayInterface;

/**
 * Class Units
 *
 * @package CrowSoft\Weather\Model\Config\Source
 */
class Units implements ArrayInterface
{
    /** Units */
    const METRICAL_UNIT = 'celsius';
    const IMPERIAL_UNIT = 'fahrenheit';

    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        return [
            [
                'value' => self::METRICAL_UNIT,
                'label' => __('Celsius')
            ],
            [
                'value' => self::IMPERIAL_UNIT,
                'label' => __('Fahrenheit')
            ]
        ];
    }
}
