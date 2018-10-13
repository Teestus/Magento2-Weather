<?php
/**
 * @author    Leszek Kruk
 */

namespace CrowSoft\Weather\Ui\Component\Listing\Column;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\UrlInterface;

/**
 * Class GridActions
 *
 * prepare action column buttons for Weather Grid
 *
 * CrowSoft\Weather\Ui\Component\Listing\Column
 */
class GridActions extends Column
{
    /** Action paths */
    const WEATHER_DELETE = 'weather/grid/delete';

    /**
     * @var UrlInterface
     */
    protected $urlBuilder;

    /**
     * @var string
     */
    private $delete;

    /**
     * GridActions constructor.
     *
     * @param ContextInterface   $context
     * @param UiComponentFactory $uiComponentFactory
     * @param UrlInterface       $urlBuilder
     * @param string             $delete
     * @param array              $components
     * @param array              $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface $urlBuilder,
        $delete = self::WEATHER_DELETE,
        array $components = [],
        array $data = []
    ) {
        $this->urlBuilder = $urlBuilder;
        $this->delete     = $delete;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     *
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                $name = $this->getData('name');
                if (isset($item['entity_id'])) {
                    $item[$name]['delete'] = [
                        'href'  => $this->urlBuilder->getUrl($this->delete, ['id' => $item['entity_id']]),
                        'label' => __('Delete')
                    ];
                }
            }
        }

        return $dataSource;
    }
}
