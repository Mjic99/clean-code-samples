<?php

class StringGenerator {
  public function __construct()
  {
    
  }

  function getBoardString(array $rows)
  {
    $board = $this->getBoardLimitString() . "\n";
    foreach ($rows as $row) {
      $board = $board . $this->getStringForRow($row) . "\n";
    }
    $board = $board . $this->getBoardLimitString() . "\n";

    return $board;
  }

  function getStringForRow(array $row) {
    return "|" . implode("|", $row) . "|";
  }

  function getBoardLimitString()
  {
    return "-------";
  }
}