<?php

declare(strict_types=1);

namespace Krexik\Label\Api\Data;

use Magento\Framework\Api\ExtensibleDataInterface;

/**
 * @api
 */
interface LabelInterface extends ExtensibleDataInterface
{
    public const LABEL_ID = 'label_id';
}
