<?php

require_once('DTO/CheckResult.php');

class Checker {
  public function __construct()
  {
  }

  public function hasHorizontalMatch(array $slots)
  {
    return $this->checkValuesUsingSingleIteration($slots, function(array $slotsToCheck, int $i, int $j) {
      return $slotsToCheck[$i][$j];
    });
  }

  public function hasVerticalMatch(array $slots)
  {
    return $this->checkValuesUsingSingleIteration($slots, function(array $slotsToCheck, int $i, int $j) {
      return $slotsToCheck[$j][$i];
    });
  }

  public function hasDiagonalMatch(array $slots)
  {
    $first = $this->hasFirstDiagonalMatch($slots);
    $second = $this->hasSecondDiagonalMatch($slots);

    if ($first->hasWinner) {
      return $first;
    }

    if ($second->hasWinner) {
      return $second;
    }

    return new CheckResult(false);
  }

  private function checkValuesUsingSingleIteration(array $slots, $getValue)
  {
    for ($i=0; $i < count($slots); $i++) {
      $valuesToCheck = [];
      for ($j=0; $j < count($slots); $j++) {
        $valuesToCheck[] = $getValue($slots, $i, $j);
      }
      if ($this->hasSameValues($valuesToCheck)) {
        return new CheckResult(true, $valuesToCheck[0]);
      }
    }
    return new CheckResult(false);
  }

  private function hasFirstDiagonalMatch(array $slots)
  {
    return $this->checkValuesUsingDoubleIteration($slots, function(array $slotsToCheck, int $i) {
      return $slotsToCheck[$i][$i];
    });
  }

  private function hasSecondDiagonalMatch(array $slots)
  {
    return $this->checkValuesUsingDoubleIteration($slots, function(array $slotsToCheck, int $i) {
      $rowToCheck = count($slotsToCheck) - $i - 1;
      return $slotsToCheck[$rowToCheck][$i];
    });
  }

  private function checkValuesUsingDoubleIteration(array $slots, $getValue)
  {
    $valuesToCheck = [];
    for ($i=0; $i < count($slots); $i++) {
      $valuesToCheck[] = $getValue($slots, $i);
    }
    if ($this->hasSameValues($valuesToCheck)) {
      return new CheckResult(true, $valuesToCheck[0]);
    }
    return new CheckResult(false);
  }

  private function hasSameValues(array $valueList)
  {
    $valueToCompare = $valueList[0];
    $matchExists = true;

    if ($valueToCompare == " ") {
      return false;
    }

    for ($i=1; $i < count($valueList); $i++) { 
      if ($valueToCompare !== $valueList[$i]) {
        $matchExists = false;
        break;
      }
    }

    return $matchExists;
  }
}
