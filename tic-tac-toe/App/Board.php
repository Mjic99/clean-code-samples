<?php

require_once('Checker.php');
require_once('DTO/CheckResult.php');

class Board {
  private array $slots;
  private Checker $checker;
  private CheckResult $result;

  public function __construct(int $size)
  {
    $this->generateEmptyBoard($size);
    $this->checker = new Checker();
  }

  private function generateEmptyBoard(int $size)
  {
    $this->slots = array();
    for ($i=0; $i < $size; $i++) { 
      $this->slots[] = $this->generateEmptyRow($size);
    }
  }

  private function generateEmptyRow(int $size)
  {
    $row = array();
    for ($i=0; $i < $size; $i++) { 
      $row[] = " ";
    }

    return $row;
  }

  public function getRows()
  {
    return $this->slots;
  }

  public function setValueForSlot(string $value, array $slot)
  {
    // User's representation of the matrix starts on 1, so we shift back by 1
    $this->slots[$slot[0] - 1][$slot[1] - 1] = $value;
  }

  public function updateResult()
  {
    $results = [
      $this->checker->hasHorizontalMatch($this->slots),
      $this->checker->hasVerticalMatch($this->slots),
      $this->checker->hasDiagonalMatch($this->slots)
    ];

    foreach ($results as $result) {
      if ($result->hasWinner) {
        $this->result = $result;
        return;
      }
    }
    
    $this->result = new CheckResult(false);
  }

  public function hasWinner()
  {
    return $this->result->hasWinner;
  }

  public function getWinner()
  {
    return $this->result->winner;
  }
}
