<?php


namespace Hngl\Snakes\Game;

class Game
{
    private $board;

    /** @var int */
    private $currentIndex;

    public function __construct(array $board)
    {
        $this->board = $board;
        $this->currentIndex = 0;
    }

    public function isDone() {
        return $this->currentIndex > 24;
    }

    public function doTurn(): string
    {
        $throw = $this->throwDice();
        $newIndex = $this->currentIndex + $throw;

        if($this->isStable($newIndex)) {
            $this->currentIndex = $newIndex;
            return sprintf("Player threw %s, moved to square %d", $throw, $this->currentIndex + 1);
        }

        if($this->hasSnake($newIndex)) {
            $this->currentIndex = $this->board[$newIndex] - 1;
            return sprintf("Player threw %s --I'VE HAD IT WITH THESE SNAKES!-- moved to square %d", $throw, $this->currentIndex + 1);
        }
        if($this->hasLadder($newIndex)) {
            $this->currentIndex = $this->board[$newIndex] - 1;
            return sprintf("Player threw %s --GOING UP!-- moved to square %d", $throw, $this->currentIndex + 1);
        }
    }

    private function throwDice()
    {
        return \random_int(1,6);
    }

    private function hasSnake($index)
    {
        return null !== $this->board[$index] && $this->board[$index] < $index;
    }

    private function isStable(int $index)
    {
        return null === $this->board[$index];
    }

    private function hasLadder(int $index)
    {
        return null !== $this->board[$index] && $this->board[$index] > $index;
    }
}