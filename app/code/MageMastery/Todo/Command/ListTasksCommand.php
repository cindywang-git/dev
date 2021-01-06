<?php
declare(strict_types=1);

namespace MageMastery\Todo\Command;

use Symfony\Component\Console\Command\Command;

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
}
