<?php

namespace MageMastery\Todo\Api;
use MageMastery\Todo\Api\Data\TaskSearchResultInterface;
use Magento\Framework\Api\Search\SearchCriteriaInterface;

/**
 * @api
 */
interface TaskRepositoryInterface
{
    public function getList(SearchCriteriaInterface $searchCriteria): TaskSearchResultInterface;
    public function get(int $taskId);
}
