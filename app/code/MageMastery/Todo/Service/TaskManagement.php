<?php

declare(strict_types=1);

namespace MageMastery\Todo\Service;

use MageMastery\Todo\Api\Data\TaskInterface;
use MageMastery\Todo\Api\TaskManagementInterface;
use MageMastery\Todo\Model\ResourceModel\Task;
use Magento\Framework\Exception\AlreadyExistsException;

class TaskManagement implements TaskManagementInterface
{
    private $resource;

    public function __construct(Task $resource)
    {
        $this->resource = $resource;
    }

    /**
     * @inheritDoc
     */
    public function save(int $customerId, TaskInterface $task): int
    {
        $task->setData('customer_id', $customerId);
        $this->resource->save($task);
        return $task->getTaskId();
    }

    /**
     * @param TaskInterface $task
     * @return bool
     * @throws \Exception
     */
    public function delete(TaskInterface $task): bool
    {
        $this->resource->delete($task);
        return true;
    }
}
