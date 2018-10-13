<?php
/**
 * @author    Leszek Kruk
 */

namespace CrowSoft\Weather\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\AlreadyExistsException;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\InputException;
use Magento\Framework\Exception\NoSuchEntityException;
use CrowSoft\Weather\Api\Data\WeatherInterface;

/**
 * Interface LublinWeatherRepositoryInterface
 *
 * @package CrowSoft\Weather\Api
 */
Interface LublinWeatherRepositoryInterface
{
    /**
     * Create or update an Changelog
     *
     * @param WeatherInterface $model
     *
     * @return WeatherInterface
     * @throws CouldNotSaveException
     * @throws InputException
     * @throws AlreadyExistsException
     */
    public function save(WeatherInterface $model);

    /**
     * Returns WeatherInterface
     *
     * @param int $id
     *
     * @return WeatherInterface
     * @throws NoSuchEntityException
     */
    public function getById($id);

    /**
     * @param WeatherInterface $model
     *
     * @return bool
     * @throws NoSuchEntityException
     * @throws CouldNotDeleteException
     */
    public function delete(WeatherInterface $model);

    /**
     * Delete an Record by Id
     *
     * @param int $id
     *
     * @return bool
     * @throws NoSuchEntityException
     * @throws CouldNotDeleteException
     */
    public function deleteById($id);

    /**
     * @param SearchCriteriaInterface $searchCriteria
     *
     * @return WeatherInterface[]
     */
    public function getList(SearchCriteriaInterface $searchCriteria);
}
