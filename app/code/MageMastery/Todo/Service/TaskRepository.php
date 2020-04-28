<?php
namespace MageMastery\Todo\Service;

use MageMastery\Todo\Api\Data\TaskSearchResultInterface;
use MageMastery\Todo\Api\Data\TaskSearchResultInterfaceFactory;
use MageMastery\Todo\Api\TaskRepositoryInterface;
use MageMastery\Todo\Model\ResourceModel\Task;
use MageMastery\Todo\Model\TaskFactory;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;

class  TaskRepository implements TaskRepositoryInterface
{
    /**
     * @var \MageMastery\Todo\Model\ResourceModel\Task
     */
    private $resource;

    /**
     * @var \MageMastery\Todo\Model\TaskFactory
     */
    private $taskFactory;

    /**
     * @var TaskSearchResultInterface
     */
    private $searchResultFactory;

    /**
     * @var CollectionProcessorInterface
     */
    private $collectionProcessor;

    /**
     * TaskRepository constructor.
     * @param Task $resource
     * @param TaskFactory $taskFactory
     * @param CollectionProcessorInterface $collectionProcessor
     * @param TaskSearchResultInterfaceFactory $taskSearchResult
     */
    public function __construct(
        \MageMastery\Todo\Model\ResourceModel\Task $resource,
        \MageMastery\Todo\Model\TaskFactory $taskFactory,
        CollectionProcessorInterface $collectionProcessor,
        TaskSearchResultInterfaceFactory $searchResultFactory
    )
    {
        $this->resource = $resource;
        $this->taskFactory = $taskFactory;
        $this->collectionProcessor = $collectionProcessor;
        $this->searchResultFactory = $searchResultFactory;
    }

    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria): TaskSearchResultInterface
    {
        $searchResult = $this->searchResultFactory->create();
        $searchCriteria->setSearchCriteria($searchCriteria);
        $this->collectionProcessor->process($searchCriteria, $searchResult);
        return $searchResult;
    }
    public function get(int $taskId)
    {
        $object = $this->taskFactory->create();
        $this->resource->load($object, $taskId);
        return $object;
    }
}
