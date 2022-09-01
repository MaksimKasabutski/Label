<?php

declare(strict_types=1);

namespace Krexik\Label\Ui\Component\Listing;

use Krexik\Label\Api\Data\LabelFrontendSettingsInterface;
use Krexik\Label\Model\Label\Parts\FrontendSettings\GetLabelImageUrl;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;

class Image extends Column
{
    /**
     * @var GetLabelImageUrl
     */
    private GetLabelImageUrl $getLabelImageUrl;

    public function __construct(
        GetLabelImageUrl $getLabelImageUrl,
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        array $components = [],
        array $data = [])
    {
        parent::__construct(
            $context,
            $uiComponentFactory,
            $components,
            $data
        );
        $this->getLabelImageUrl = $getLabelImageUrl;
    }

    public function prepareDataSource(array $dataSource): array
    {
        foreach ($dataSource['data']['items'] as &$item) {
            $imageName = $this->getName();
            if (isset($item[$imageName])) {
                $pageType = $this->getData()['config']['pageType'];
                $item[$imageName] = sprintf(
                    '<img src="%s" title="%s"/>',
                    $this->getLabelImageUrl->execute($item[$imageName]),
                    $item[$pageType . '_' . LabelFrontendSettingsInterface::LABEL_TEXT] ?? ''
                );
            }
        }

        return $dataSource;
    }
}
