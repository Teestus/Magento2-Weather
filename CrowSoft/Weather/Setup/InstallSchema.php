<?php
/**
 * @author    Leszek Kruk
 */

namespace CrowSoft\Weather\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;
use CrowSoft\Weather\Api\Data\WeatherInterface;

/**
 * Class InstallSchema
 */
class InstallSchema implements InstallSchemaInterface
{
    /**
     * @param SchemaSetupInterface   $setup
     * @param ModuleContextInterface $context
     *
     * @throws \Zend_Db_Exception
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        $tableName = $setup->getTable(WeatherInterface::TABLE_NAME);
        if (!$setup->getConnection()->isTableExists($tableName)) {
            $table = $setup->getConnection()
                ->newTable($tableName)
                ->addColumn(
                    WeatherInterface::ENTITY_ID,
                    Table::TYPE_INTEGER,
                    null,
                    [
                        'identity' => true,
                        'unsigned' => true,
                        'nullable' => false,
                        'primary'  => true
                    ],
                    'Entity ID'
                )
                ->addColumn(
                    WeatherInterface::WEATHER_TEXT,
                    Table::TYPE_TEXT,
                    null,
                    ['nullable' => false],
                    'Weather Text'
                )
                ->addColumn(
                    WeatherInterface::METRIC,
                    Table::TYPE_TEXT,
                    null,
                    ['nullable' => false],
                    'Metric temperature value'
                )
                ->addColumn(
                    WeatherInterface::IMPERIAL,
                    Table::TYPE_TEXT,
                    null,
                    ['nullable' => false],
                    'Imperial temperature value'
                )
                ->addColumn(
                    'created_at',
                    Table::TYPE_TIMESTAMP,
                    null,
                    [
                        'nullable' => false,
                        'default'  => Table::TIMESTAMP_INIT
                    ],
                    'Created At'
                )
                ->setComment('Lublin Weather');
            $setup->getConnection()->createTable($table);
        }
        $setup->endSetup();
    }
}
