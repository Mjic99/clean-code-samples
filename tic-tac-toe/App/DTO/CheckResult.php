<?php

class CheckResult {
  public bool $hasWinner;
  public ?string $winner;

  public function __construct(bool $hasWinner, string $winner = null)
  {
    $this->hasWinner = $hasWinner;
    $this->winner = $winner;
  }
}
