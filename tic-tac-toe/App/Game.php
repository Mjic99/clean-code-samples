<?php

require_once('StringGenerator.php');
require_once('Board.php');

class Game {
  private bool $running = true;
  private string $currentTurn = 'X';
  private StringGenerator $stringGenerator;
  private Board $board;

  public function __construct()
  {
    $this->stringGenerator = new StringGenerator();
    $this->board = new Board(3);
  }

  public function runLoop()
  {
    echo $this->stringGenerator->getBoardString($this->board->getRows());
    while ($this->running) {
      $this->runGameIteration();
    }
    echo $this->board->getWinner() . " is the winner!\n";
  }

  private function runGameIteration()
  {
    $this->runPlayerTurn();
    $this->updateGameStatus();
  }

  private function runPlayerTurn()
  {
    $slot = $this->getInput();
    $this->processCurrentInput($slot);
  }

  private function updateGameStatus()
  {
    echo $this->stringGenerator->getBoardString($this->board->getRows());
    $this->checkForWinner();
    $this->changeTurn();
  }

  private function getInput()
  {
    echo "It's " . $this->currentTurn . "'s turn! Input your slot in x,y format!\n";
    $input = rtrim(fgets(STDIN));

    [$x, $y] = explode(",", $input);

    return [(int) $x, (int) $y];
  }

  private function checkForWinner() {
    $this->board->updateResult();
    if ($this->board->hasWinner()) {
      $this->running = false;
    }
  }

  private function processCurrentInput(array $slot)
  {
    $this->board->setValueForSlot($this->currentTurn, $slot);
  }

  private function changeTurn()
  {
    if ($this->currentTurn == 'X') {
      $this->currentTurn = 'O';
    } else {
      $this->currentTurn = 'X';
    }
  }
}