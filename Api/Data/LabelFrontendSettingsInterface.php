<?php

declare(strict_types=1);

namespace Krexik\Label\Api\Data;

interface LabelFrontendSettingsInterface
{
    public const STORE_ID = 'store_id';
    public const PAGE_TYPE = 'page_type';
    public const VIEW_TYPE = 'view_type';
    public const LABEL_TEXT = 'label_text';
    public const TEXT_SIZE = 'text_size';
    public const TEXT_COLOR = 'text_color';
    public const IMAGE = 'image';
    public const IMAGE_SIZE = 'image_size';
    public const POSITION = 'position';
    public const TOOLTIP_STATUS = 'tooltip_status';
    public const TOOLTIP_TEXT = 'tooltip_text';
    public const TOOLTIP_TYPE = 'tooltip_type';
    public const TOOLTIP_MOBILE_TYPE = 'tooltip_mobile_type';
    public const TOOLTIP_COLOR = 'tooltip_color';
    public const TOOLTIP_TEXT_COLOT = 'tooltip_text_color';

    public const IS_ENABLED = 'is_enabled';
    public const PRIORITY = 'priority';
    public const USE_FOR_PARENTS = 'use_for_parents';
    public const SCHEDULED_FROM = 'scheduled_from';
    public const SCHEDULED_TO = 'scheduled_to';
    public const CONDITIONS_SERIALIZED = 'conditions_serialized';
}
