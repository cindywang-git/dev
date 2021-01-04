<?php

declare(strict_types=1);

namespace MageMastery\Todo\Service;

use MageMastery\Todo\Api\TaskStatusManagementInterface;
use MageMastery\Todo\Api\TaskManagementInterface;
use MageMastery\Todo\Api\TaskRepositoryInterface;
use MageMastery\Todo\Model\Task;

class TaskStatusManagement implements TaskStatusManagementInterface
{
    /**
     * @var TaskRepositoryInterface
     */
    private $taskRepository;

    /**
     * @var TaskManagementInterface
     */
    private $taskManagement;

    /**
     * TaskStatusManagement constructor.
     * @param TaskRepositoryInterface $taskRepository
     * @param TaskManagementInterface $taskManagement
     */
    public function __construct(
        TaskRepositoryInterface $taskRepository,
        TaskManagementInterface $taskManagement
    ){
        $this->taskRepository = $taskRepository;
        $this->taskManagement = $taskManagement;
    }

    public function change(int $customerId, int $taskId, string $status): bool
    {
        if(!in_array($status, ['open','complete'])){
            return false;
        }
        $task = $this->taskRepository->get($taskId);
        $task->setData(Task::STATUS, $status);
        $this->taskManagement->save($customerId, $task);

        return true;
    }
}
