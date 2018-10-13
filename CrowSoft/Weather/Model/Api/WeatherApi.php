<?php
/**
 * @author    Leszek Kruk
 */

namespace CrowSoft\Weather\Model\Api;

use CrowSoft\Weather\Helper\Config;
use CrowSoft\Weather\Exception\ApiException;
use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;
use Magento\Framework\Serialize\Serializer\Json;
use CrowSoft\Weather\Logger\Logger;
use CrowSoft\Weather\Model\LublinWeatherRepository;
use CrowSoft\Weather\Api\Data\WeatherInterface;
use CrowSoft\Weather\Api\Data\WeatherInterfaceFactory;

/**
 * Class WeatherApi
 *
 * @package CrowSoft\Weather\Model\Api
 */
class WeatherApi
{
    /** @var Config */
    protected $configHelper;

    /** @var Json */
    protected $json;

    /** @var Logger */
    protected $logger;

    /** @var WeatherInterfaceFactory  */
    protected $weatherInterfaceFactory;

    /** @var LublinWeatherRepository  */
    protected $lublinWeatherRepository;

    /**
     * WeatherApi constructor.
     *
     * @param Config                  $configHelper
     * @param Json                    $json
     * @param Logger                  $logger
     * @param WeatherInterfaceFactory $weatherInterfaceFactory
     * @param LublinWeatherRepository $lublinWeatherRepository
     */
    public function __construct(
        Config $configHelper,
        Json $json,
        Logger $logger,
        WeatherInterfaceFactory $weatherInterfaceFactory,
        LublinWeatherRepository $lublinWeatherRepository
    ) {
        $this->configHelper            = $configHelper;
        $this->json                    = $json;
        $this->logger                  = $logger;
        $this->weatherInterfaceFactory = $weatherInterfaceFactory;
        $this->lublinWeatherRepository = $lublinWeatherRepository;
    }

    /**
     * @throws ApiException
     */
    public function request()
    {
        $baseUri = $this->configHelper->getApiEndpoint();

        if (!$baseUri) {
            throw new ApiException(__("Api Endpoint is not Specified"));
        }

        $client  = new Client(['base_uri' => $this->configHelper->getApiEndpoint()]);
        $options = $this->prepareOptions();

        try {
            $response = $client->request('GET', $this->configHelper->getCity(), $options);
            $this->processResponse($response);
        } catch (\Exception $e) {
            $this->logger->addError($e->getMessage());
        }
    }

    /**
     * @return array
     */
    public function prepareOptions()
    {
        return [
            'query' => [
                'apikey'   => $this->configHelper->getApiKey(),
                'language' => $this->configHelper->getLanguage(),
            ]
        ];
    }

    /**
     * @param ResponseInterface $response
     */
    public function processResponse(ResponseInterface $response)
    {
        $statusCode = $response->getStatusCode();
        if (200 !== $statusCode) {
            $this->logger->addDebug($response->getReasonPhrase());
            return;
        }

        $body    = $response->getBody();
        $content = $body->getContents();

        $unserializedContent = $this->json->unserialize($content);

        try {
            $this->saveRecord($unserializedContent[0]);
        } catch (\Exception $e) {
            $this->logger->addError($e->getMessage());
        }
    }

    /**
     * @param $data
     *
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     */
    public function saveRecord($data)
    {
        /** @var WeatherInterface $weather */
        $weather = $this->weatherInterfaceFactory->create();
        $weather->setWeatherText($data['WeatherText']);
        $weather->setMetric($data['Temperature']['Metric']['Value']);
        $weather->setImperial($data['Temperature']['Imperial']['Value']);

        $this->lublinWeatherRepository->save($weather);
    }
}
