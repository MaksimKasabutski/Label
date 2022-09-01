<?php

declare(strict_types=1);

namespace Krexik\Label\Model\ResourceModel\Label\Grid;

use Krexik\Label\Api\Data\LabelFrontendSettingsInterface;
use Krexik\Label\Api\Data\LabelInterface;
use Krexik\Label\Model\Label;
use Krexik\Label\Model\ResourceModel\Label as LabelResource;
use Krexik\Label\Model\ResourceModel\Label\Collection as LabelsCollection;
use Magento\Framework\Data\Collection\Db\FetchStrategyInterface as FetchStrategy;
use Magento\Framework\Data\Collection\EntityFactoryInterface as EntityFactory;
use Magento\Framework\Event\ManagerInterface as EventManager;
use Magento\Framework\View\Element\UiComponent\DataProvider\SearchResult;
use Magento\Store\Model\StoreManagerInterface;
use Psr\Log\LoggerInterface as Logger;

class Collection extends SearchResult
{
    public const PRODUCT_PREFIX = 'product';
    public const CATEGORY_PREFIX = 'category';

    public const LABEL_VIEW_COLUMNS = [
        LabelFrontendSettingsInterface::IMAGE,
        LabelFrontendSettingsInterface::POSITION
    ];

    public const LABEL_VIEW_PROPERTY_COLUMNS = [
        LabelFrontendSettingsInterface::IS_ENABLED
    ];

    public function __construct(
        StoreManagerInterface $storeManager,
        EntityFactory $entityFactory,
        Logger $logger,
        FetchStrategy $fetchStrategy,
        EventManager $eventManager,
        $mainTable,
        $resourceModel = null,
        $identifierName = null,
        $connectionName = null)
    {
        $this->storeManager = $storeManager;

        parent::__construct(
            $entityFactory,
            $logger,
            $fetchStrategy,
            $eventManager,
            $mainTable,
            $resourceModel,
            $identifierName,
            $connectionName
        );
    }

    protected function _construct()
    {
        $this->_init(Label::class,LabelResource::class);
    }

    public function _beforeLoad()
    {
        $this->joinViewParts();
        $this->joinViewPropertyParts();

        return parent::_beforeLoad();
    }

    private function joinViewParts(): void
    {
        $select = $this->getSelect();
        $tableName = $this->getTable(LabelResource::LABEL_VIEW_TABLE);
        $columns = $this->getViewColumns($tableName);
        $pageTypes = [
            self::CATEGORY_PREFIX => LabelsCollection::PAGE_TYPE_PLP,
            self::PRODUCT_PREFIX => LabelsCollection::PAGE_TYPE_PDP
        ];

        foreach ($pageTypes as $typeName => $typeCode) {
            $joinColumns = [];

            foreach ($columns as $columnName) {
                $joinColumns["{$typeName}_{$columnName}"] = $columnName;
            }

            $select->join(
                [$typeName => $tableName],
                sprintf(
                    'main_table.%1$s = %2$s.%1$s and %2$s.%3$s = %4$d and %2$s.%5$s = 0',
                    LabelInterface::LABEL_ID,
                    $typeName,
                    LabelFrontendSettingsInterface::PAGE_TYPE,
                    $typeCode,
                    LabelFrontendSettingsInterface::STORE_ID
                ),
                $joinColumns
            );
        }
    }

    private function joinViewPropertyParts(): void
    {
        $select = $this->getSelect();
        $tableName = $this->getTable(LabelResource::LABEL_VIEW_PROPERTY_TABLE);
        $joinColumns = $this->getViewPropertyColumns($tableName);

        $select->join(
            $tableName,
            sprintf('main_table.%1$s = %2$s.%1$s',LabelInterface::LABEL_ID, $tableName),
            $joinColumns
        );
    }

    private function getViewColumns(string $tableName): array
    {
        $columns = $this->getConnection()->describeTable($tableName);

        return array_reduce(array_keys($columns), function (array $carry, string $columnName): array {
            if (in_array($columnName, self::LABEL_VIEW_COLUMNS)) {
                $carry[] = $columnName;
            }

            return $carry;
        }, []);
    }

    private function getViewPropertyColumns(string $tableName): array
    {
        $columns = $this->getConnection()->describeTable($tableName);

        return array_reduce(array_keys($columns), function (array $carry, string $columnName): array {
            if (in_array($columnName, self::LABEL_VIEW_PROPERTY_COLUMNS)) {
                $carry[] = $columnName;
            }

            return $carry;
        }, []);
    }
}
