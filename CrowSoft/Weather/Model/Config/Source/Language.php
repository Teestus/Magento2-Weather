<?php
/**
 * @author    Leszek Kruk
 */

namespace CrowSoft\Weather\Model\Config\Source;

use Magento\Framework\Option\ArrayInterface;

/**
 * Class Language
 *
 * @package CrowSoft\Weather\Model\Config\Source
 */
class Language implements ArrayInterface
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
                'value' => 'pl-pl',
                'label' => __('Polish')
            ],
            [
                'value' => 'en-us',
                'label' => __('English')
            ]
        ];
    }
}
