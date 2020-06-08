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

use Symfony\Component\Process\Process;

/**
 * The open utility.
 *
 * @author Florian Voutzinos <florian@voutzinos.com>
 */
class Open
{
    /**
     * Opens the given path or url with the default or given application.
     *
     * @param string      $path The path to open
     * @param string|null $app  The application name
     *
     * @throws \RuntimeException If the process failed
     */
    public static function open($path, $app = null)
    {
        switch (php_uname('s')) {
            case 'Darwin':
                $command = null === $app ? 'open' : sprintf('open -a %s', escapeshellarg($app));
                break;

            case 'Windows':
            case 'Windows NT':
                $command = null === $app ? 'start ""' : sprintf('start "" %s', escapeshellarg($app));
                break;

            default:
                $command = null === $app ? __DIR__.'/Resources/bin/xdg-open' : $app;
                break;
        }

        $process = new Process(sprintf('%s %s', $command, escapeshellarg($path)));
        $process->run();

        if (!$process->isSuccessful()) {
            throw new \RuntimeException($process->getErrorOutput());
        }
    }
}
