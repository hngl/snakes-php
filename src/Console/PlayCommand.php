<?php

namespace Hngl\Snakes\Console;

use Hngl\Snakes\Game\Game;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class PlayCommand extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'app:play';

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $board = [
            9, null, 7, null, null,
            17, null, 5, null, null,
            null, 18, 10, null, null,
            null, null, null, 23, 15,
            null, null, null, 16, null,
        ];

        $game = new Game($board);

        while (!$game->isDone()) {
            $output->writeln($game->doTurn());
        }
        $output->writeln('Game over');
    }
}
