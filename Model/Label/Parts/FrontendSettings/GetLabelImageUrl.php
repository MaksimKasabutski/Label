<?php

namespace Krexik\Label\Model\Label\Parts\FrontendSettings;

use Magento\Framework\UrlInterface;
use Magento\Store\Model\StoreManagerInterface as StoreManager;

class GetLabelImageUrl implements \Krexik\Label\Api\Label\GetLabelImageUrlInterface
{
    public const IMAGE_MEDIA_PATH = 'krexik/label/';

    /**
     * @var StoreManager
     */
    private StoreManager $storeManager;

    public function __construct(
        StoreManager $storeManager
    ) {
        $this->storeManager = $storeManager;
    }

    public function execute(?string $imageName): ?string
    {
        $baseUrl = $this->storeManager->getStore()->getBaseUrl(UrlInterface::URL_TYPE_MEDIA);

        if ($imageName) {
            $imageName = sprintf('%s%s%s', $baseUrl, self::IMAGE_MEDIA_PATH, $imageName);
        }

        return $imageName;
    }
}
