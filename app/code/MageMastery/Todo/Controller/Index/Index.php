<?php

namespace MageMastery\Todo\Controller\Index;

use MageMastery\Todo\Api\TaskManagementInterface;
use MageMastery\Todo\Service\TaskRepository;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use MageMastery\Todo\Model\Task;
use MageMastery\Todo\Model\ResourceModel\Task as TaskResource;
use MageMastery\Todo\Model\TaskFactory;


Class Index extends Action
{
    /**
     * @var TaskResource
     */
	private $taskResource;

    /**
     * @var TaskFactory
     */
	private $taskFactory;

    /**
     * @var
     */
	private $taskRepository;

    /**
     * @var SearchCriteriaBuilder
     */
	private $searchCriteriaBuilder;

    /**
     * @var TaskManagementInterface
     */
	private $taskManagement;

	public function __construct(
	    Context $context,
        TaskFactory $taskFactory,
        TaskResource $taskResource,
        TaskRepository $taskRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        TaskManagementInterface $taskManagement
    )
	{
		$this->taskFactory = $taskFactory;
		$this->taskResource = $taskResource;
		$this->taskRepository = $taskRepository;
		$this->searchCriteriaBuilder = $searchCriteriaBuilder;
		$this->taskManagement = $taskManagement;
		parent::__construct($context);
	}

    public function execute()
    {
        $task = $this->taskRepository->get(1);
        $task->setData('status', 'complete');
        $this->taskManagement->save($task);

        var_dump($this->taskRepository->getList($this->searchCriteriaBuilder->create())->getItems());
        return ;//$this->resultFactory->create(ResultFactory::TYPE_PAGE);
//        $task = $this->taskFactory->create();
//        $task->setData([
//            'label' => 'New Task 22',
//            'status' =>  'open',
//            'customer_id' => 1
//        ]);
//        $this->taskResource->save($task->getData());
        //return $this->resultFactory->create(ResultFactory::TYPE_PAGE);
    }
}
