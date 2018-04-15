<?php
namespace Peal\Dice100;

/**
 * A dice class storing an array of rolls
 */
class Dice
{
    /**
     * @var array $rollArr   Rolled dices
     */
    protected $rollArr = [];

    /**
     * Rolls dice
     *
     * @return int value between 1-6
     */
    public function roll()
    {
        $diceVal = rand(1, 6);
        $this->rollArr[] = $diceVal;
        return $diceVal;
    }

    /**
     * Get array of dice rolls
     *
     * @return array array of rolls
     */
    public function rolls()
    {
        return $this->rollArr;
    }

    /**
     * Reset array
     *
     * @return void
     */
    public function reset()
    {
        $this->rollArr = [];
    }
}
