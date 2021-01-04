<?php

declare(strict_types=1);

namespace MageMastery\Todo\Service;

use MageMastery\Todo\Api\CustomerTaskListInterface;
use MageMastery\Todo\Api\TaskRepositoryInterface;
use Magento\Framework\Api\FilterBuilder;
use Magento\Framework\Api\SearchCriteriaBuilder;

class CustomerTaskList implements CustomerTaskListInterface
{
    /**
     * @var TaskRepositoryInterface
     */
    private $taskRepository;

    /**
     * @var SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;

    /**
     * CustomerTaskList constructor.
     * @param TaskRepositoryInterface $taskRepository
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     */
    public function __construct(
        TaskRepositoryInterface $taskRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        FilterBuilder $filterBuilder
    ) {
        $this->taskRepository = $taskRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->filterBuilder = $filterBuilder;
    }

    /**
     * @inheritDoc
     */
    public function getList(int $customerId): array
    {
        $this->searchCriteriaBuilder->addFilter(
            $this->filterBuilder->create()
                ->setField('customer_id')
                ->setValue($customerId)
        );
        $searchCriteria = $this->searchCriteriaBuilder->create();
        return $this->taskRepository
            ->getList($searchCriteria)
            ->getItems();
    }
}
