<?php

declare(strict_types=1);

namespace Krexik\Label\Model\Source;

use Magento\Framework\Data\OptionSourceInterface;

class Position implements OptionSourceInterface
{
    public const TOP_LEFT = 0;
    public const TOP_CENTER = 1;
    public const TOP_RIGHT = 2;
    public const MIDDLE_LEFT = 3;
    public const MIDDLE_CENTER = 4;
    public const MIDDLE_RIGHT = 5;
    public const BOTTOM_LEFT = 6;
    public const BOTTOM_CENTER = 7;
    public const BOTTOM_RIGHT = 8;

    public function toOptionArray(): array
    {
        return [
            [
                'value' => self::TOP_LEFT,
                'label' => __('Top Left')
            ],
            [
                'value' => self::TOP_CENTER,
                'label' => __('Top Center')
            ],
            [
                'value' => self::TOP_RIGHT,
                'label' => __('Top Right')
            ],
            [
                'value' => self::MIDDLE_LEFT,
                'label' => __('Middle Left')
            ],
            [
                'value' => self::MIDDLE_CENTER,
                'label' => __('Middle Center')
            ],
            [
                'value' => self::MIDDLE_RIGHT,
                'label' => __('Middle Right')
            ],
            [
                'value' => self::BOTTOM_LEFT,
                'label' => __('Bottom Left')
            ],
            [
                'value' => self::BOTTOM_CENTER,
                'label' => __('Bottom Center')
            ],
            [
                'value' => self::BOTTOM_RIGHT,
                'label' => __('Bottom Right')
            ]
        ];
    }
}
