<?php

/*
 * This file is part of Open.
 *
 * (c) Florian Voutzinos <florian@voutzinos.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Open;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * The open command.
 *
 * @author Florian Voutzinos <florian@voutzinos.com>
 */
class OpenCommand extends Command
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('open')
            ->setDescription('Opens a file or URL.')
            ->addArgument('path', InputArgument::REQUIRED, 'The file or URL to open')
            ->addArgument('app', InputArgument::OPTIONAL, 'The app to use (eg. firefox, chrome)')
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        Open::open($input->getArgument('path'), $input->getArgument('app'));
    }
}
