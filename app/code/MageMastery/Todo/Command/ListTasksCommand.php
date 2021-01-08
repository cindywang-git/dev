<?php
declare(strict_types=1);

namespace MageMastery\Todo\Command;

use MageMastery\Todo\Api\TaskRepositoryInterface;
use Magento\Framework\Api\Search\SearchCriteriaBuilder;
use Magento\Framework\Api\FilterBuilder;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Magento\Framework\Console\Cli;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Helper\TableCell;

class ListTasksCommand extends Command
{
    const NAME = 'magemastery:todo:task-list';

    /**
     * @var TaskRepositoryInterface
     */
    private $taskRespository;

    /**
     * @var SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;

    /**
     * @var
     */
    private $filterBuilder;

    public function __construct(
        TaskRepositoryInterface $taskRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        FilterBuilder $filterBuilder,
        String $name = null
    )
    {
        $this->taskRespository = $taskRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->filterBuilder = $filterBuilder;
        parent::__construct($name);
    }

    protected function configure()
    {
        $this->setName(self::NAME);
        $this->setDescription(
            'provide a list of task'
        )->addOption(
            'customer_id',
            'c',
            InputOption::VALUE_OPTIONAL,
            'Filter tasks by customer'
        );
        parent::configure();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $customerId = (int)$input->getOption('customer_id');
        if(!empty($customerId)){
            $this->searchCriteriaBuilder->addFilter(
                $this->filterBuilder->create()
                ->setField('customer_id')
                ->setValue($customerId)
            );
        }
        $output->writeln('Customer ID: '.$customerId);
        $taskSearchResult = $this->taskRespository->getList($this->searchCriteriaBuilder->create());
        $table = new Table($output);
        $table->setHeaders(['ID','Label','Status','Customer ID']);
        $tasks = $taskSearchResult->getItems();
        $rows = [];
        if(empty($tasks)){
            $rows[] = [new TableCell('There are no tasks fo rthe customer.',['colspan'=>4])];
        }else{
            foreach($tasks as $task){
                $rows[]=[$task->getTaskId(),$task->getLabel(),$task->getStatus(),$task->getData('customer_id')];
            }
        }

        $table->setRows($rows);
        $table->setStyle('box-double');
        $table->render();
        return Cli::RETURN_SUCCESS;
    }
}
