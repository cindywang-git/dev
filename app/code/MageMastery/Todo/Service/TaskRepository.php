<?php
namespace MageMastery\Todo\Service;

use MageMastery\Todo\Api\TaskRepositoryInterface;
use MageMastery\Todo\Model\ResourceModel\Task;
use MageMastery\Todo\Model\TaskFactory;

class TaskRepository implements TaskRepositoryInterface
{
    /**
     * @var \MageMastery\Todo\Model\ResourceModel\Task
     */
    private $resource;

    /**
     * @var \MageMastery\Todo\Model\TaskFactory
     */
    private $taskFactory;

    public function __construct(
        \MageMastery\Todo\Model\ResourceModel\Task $resource, 
        \MageMastery\Todo\Model\TaskFactory $taskFactory
    )
    {
        $this->resource = $resource;
        $this->taskFactory = $taskFactory;
    }

    public function getList()
    {

    }

    public function get(int $taskId)
    {
        $object = $this->taskFactory->create();
        $this->resource->load($object, $taskId);
        return $object;
    }
}