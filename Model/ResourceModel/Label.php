<?php

declare(strict_types=1);

namespace Krexik\Label\Model\ResourceModel;

use Krexik\Label\Api\Data\LabelInterface;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Label extends AbstractDb
{
    public const TABLE_NAME = 'label_entity';
    public const LABEL_VIEW_TABLE = 'label_view';
    public const LABEL_VIEW_PROPERTY_TABLE = 'label_view_property';
    public const LABEL_CUSTOMER_GROUP_TABLE = 'label_customer_group';
    public const LABEL_INDEX_TABLE = 'label_index';

    protected function _construct()
    {
        $this->_init(self::TABLE_NAME,LabelInterface::LABEL_ID);
    }
}
