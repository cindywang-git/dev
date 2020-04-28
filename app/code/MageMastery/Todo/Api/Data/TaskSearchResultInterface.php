<?php

//declare(strict_type=1);

namespace MageMastery\Todo\Api\Data;
use Magento\Framework\Api\SearchResultsInterface;

/**
 * @api
 */
interface TaskSearchResultInterface extends \Magento\Framework\Api\SearchResultsInterface
{
    /**
     * @return TaskInterface[]
     */
    public function getItems();

    /**
     * @param TaskInterface[] $items
     * @return SearchResultsInterface
     */
    public function setItems(array $items);
}
