<?php
declare(strict_types=1);

namespace MageMastery\Todo\Command;

use MageMastery\Todo\Api\TaskRepositoryInterface;
use Magento\Framework\Api\Search\SearchCriteriaBuilder;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Magento\Framework\Console\Cli;
use Symfony\Component\Console\Input\InputArgument;

class ListTasksCommand extends Command
{
    const NAME = 'magemastery:todo:task-list';

    /**
     * @var TaskRepositoryInterface
     */
    private $taskRespository;

    private $searchCriteriaBuilder;

    public function __construct(
        TaskRepositoryInterface $taskRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        String $name = null
    )
    {
        $this->taskRespository = $taskRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        parent::__construct($name);
    }

    protected function configure()
    {
        $this->setName(self::NAME);
        $this->setDescription(
            'provide a list of task'
        );
        parent::configure();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $taskSearchResult = $this->taskRespository->getList($this->searchCriteriaBuilder->create());
        foreach($taskSearchResult->getItems() as $task){
            $output->writeln($task->getTaskId().' '.$task->getLabel().'('.$task->getStatus().')');
        }
        return Cli::RETURN_SUCCESS;
    }
}
