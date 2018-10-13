<?php
/**
 * @author    Leszek Kruk
 */

namespace CrowSoft\Weather\Model;

use CrowSoft\Weather\Api\LublinWeatherRepositoryInterface;
use CrowSoft\Weather\Api\Data\WeatherInterface;
use CrowSoft\Weather\Model\ResourceModel\LublinWeather as LublinWeatherResourceModel;
use CrowSoft\Weather\Model\ResourceModel\LublinWeather\CollectionFactory;
use CrowSoft\Weather\Api\Data\WeatherInterfaceFactory;
use CrowSoft\Weather\Api\Data\WeatherSearchResultInterfaceFactory;
use Magento\Framework\Api\SearchCriteria\CollectionProcessor;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\StateException;

/**
 * Class LublinWeatherRepository
 *
 * @package CrowSoft\Weather\Model
 */
class LublinWeatherRepository implements LublinWeatherRepositoryInterface
{
    /**
     * @var WeatherInterface[]
     */
    private $instances = [];

    /** @var WeatherInterfaceFactory  */
    protected $weatherInterfaceFactory;

    /** @var LublinWeatherResourceModel  */
    protected $lublinWeatherResourceModel;

    /** @var CollectionFactory  */
    protected $weatherCollectionFactory;

    /** @var CollectionProcessor  */
    protected $collectionProcessor;

    /** @var WeatherSearchResultInterfaceFactory  */
    protected $weatherSearchResultInterfaceFactory;

    /**
     * LublinWeatherRepository constructor.
     *
     * @param WeatherInterfaceFactory             $weatherInterfaceFactory
     * @param LublinWeatherResourceModel          $lublinWeatherResourceModel
     * @param CollectionFactory                   $weatherCollectionFactory
     * @param CollectionProcessor                 $collectionProcessor
     * @param WeatherSearchResultInterfaceFactory $weatherSearchResultInterfaceFactory
     */
    public function __construct(
        WeatherInterfaceFactory $weatherInterfaceFactory,
        LublinWeatherResourceModel $lublinWeatherResourceModel,
        CollectionFactory $weatherCollectionFactory,
        CollectionProcessor $collectionProcessor,
        WeatherSearchResultInterfaceFactory $weatherSearchResultInterfaceFactory
    ) {
        $this->weatherInterfaceFactory             = $weatherInterfaceFactory;
        $this->lublinWeatherResourceModel          = $lublinWeatherResourceModel;
        $this->weatherCollectionFactory            = $weatherCollectionFactory;
        $this->collectionProcessor                 = $collectionProcessor;
        $this->weatherSearchResultInterfaceFactory = $weatherSearchResultInterfaceFactory;
    }

    /**
     * @param int $id
     *
     * @return WeatherInterface
     * @throws NoSuchEntityException
     */
    public function getById($id)
    {
        if (!isset($this->instances[$id])) {
            /** @var WeatherInterface $weather */
            $weather = $this->weatherInterfaceFactory->create();
            $this->lublinWeatherResourceModel->load($weather, $id);
            if (!$weather->getId()) {
                throw NoSuchEntityException::singleField('entity_id', $id);
            }
            $this->instances[$id] = $weather;
        }

        return $this->instances[$id];
    }

    /**
     * @param WeatherInterface $weather
     *
     * @return WeatherInterface
     * @throws CouldNotSaveException
     */
    public function save(WeatherInterface $weather)
    {
        try {
            $this->lublinWeatherResourceModel->save($weather);
        } catch (\Exception $e) {
            throw new CouldNotSaveException(__('Could not save Changelog'), $e);
        }

        return $weather;
    }

    /**
     * @param int $id
     *
     * @return bool
     * @throws NoSuchEntityException
     * @throws StateException
     */
    public function deleteById($id)
    {
        /** @var WeatherInterface $weather */
        $weather = $this->weatherInterfaceFactory->create();
        $this->lublinWeatherResourceModel->load($weather, $id);

        if (!$weather->getId()) {
            throw new NoSuchEntityException(__('Entity with id "%1" does not exist.', $id));
        }

        $this->delete($weather);

        return true;
    }

    /**
     * @param WeatherInterface $weather
     *
     * @return bool
     * @throws StateException
     */
    public function delete(WeatherInterface $weather)
    {
        try {
            $this->lublinWeatherResourceModel->delete($weather);
        } catch (\Exception $e) {
            throw new StateException(__('Cannot delete entity.'));
        }

        return true;
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     *
     * @return WeatherInterface[]
     */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        $collection = $this->weatherCollectionFactory->create();

        $this->collectionProcessor->process($searchCriteria, $collection);

        $searchResult = $this->weatherSearchResultInterfaceFactory->create();
        $searchResult->setSearchCriteria($searchCriteria);
        $searchResult->setItems($collection->getItems());
        $searchResult->setTotalCount($collection->getSize());

        return $searchResult->getItems();
    }
}
