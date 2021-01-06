<?php
declare(strict_types=1);

namespace MageMastery\Todo\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Magento\Framework\Console\Cli;

class ListTasksCommand extends Command
{
    const NAME = 'magemastery:todo:task-list';

    protected function configure()
    {
        $this->setName(self::NAME)
            ->setDefinition(
                'Provides a list of tasks'
            );
        parent::configure();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Hello from CLI');
        return Cli::RETURN_SUCCESS;
    }
}
