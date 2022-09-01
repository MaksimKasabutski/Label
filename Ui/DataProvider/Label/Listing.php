<?php

namespace Krexik\Label\Ui\DataProvider\Label;

use Magento\Framework\Api\Search\SearchResultInterface;
use Magento\Framework\View\Element\UiComponent\DataProvider\DataProvider;

class Listing extends DataProvider
{
    protected function searchResultToOutput(SearchResultInterface $searchResult)
    {
        $itemsData = array_reduce($searchResult->getItems(), function (array $carry, $item): array {
            $carry[] = $item->getData();

            return $carry;
        }, []);

        return [
            'items' => $itemsData,
            'totalRecords' => $searchResult->getTotalCount()
        ];
    }
}
