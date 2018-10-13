<?php
/**
 * @author    Leszek Kruk
 */

namespace CrowSoft\Weather\Api\Data;

Interface WeatherInterface
{
    /** table name */
    const TABLE_NAME = 'weather_lublin';

    /** Table fields */
    const ENTITY_ID    = 'entity_id';
    const WEATHER_TEXT = 'weather_text';
    const METRIC       = 'metric';
    const IMPERIAL     = 'imperial';
    const CREATED_AT   = 'created_at';

    /**
     * @param int $id
     *
     * @return $this
     */
    public function setId($id);

    /**
     * @return int
     */
    public function getId();

    /**
     * @param string $text
     *
     * @return $this
     */
    public function setWeatherText($text);

    /**
     * @return string
     */
    public function getWeatherText();

    /**
     * @param string $metric
     *
     * @return $this
     */
    public function setMetric($metric);

    /**
     * @return string
     */
    public function getMetric();

    /**
     * @param string $imperial
     *
     * @return $this
     */
    public function setImperial($imperial);

    /**
     * @return string
     */
    public function getImperial();

    /**
     * @param $createdAt
     *
     * @return $this
     */
    public function setCreatedAt($createdAt);

    /**
     * @return string
     */
    public function getCreatedAt();
}
