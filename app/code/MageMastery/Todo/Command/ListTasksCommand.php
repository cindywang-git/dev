<?php
declare(strict_types=1);

namespace MageMastery\Todo\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Magento\Framework\Console\Cli;
use Symfony\Component\Console\Input\InputArgument;

class ListTasksCommand extends \Symfony\Component\Console\Command\Command
{
    const NAME = 'magemastery:todo:task-list';

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
        $output->writeln('Hello from CLI');
        return Cli::RETURN_SUCCESS;
    }
}
