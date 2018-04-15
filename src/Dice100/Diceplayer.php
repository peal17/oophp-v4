<?php
namespace Peal\Dice100;

/**
 * A class for playing dicegame
 */
class Diceplayer
{
    /**
     * @var array $gamerounds   Stores values from each round
     * @var int $roundsum   Sum of dice rolls each round
     * @var obj $dice   Dice object, rolls dices
     * @var string $name    Player name
     */
    private $gamerounds = [];
    private $roundsum = 0;
    private $dice;
    private $name;

    /**
     * Constructor to initiate the object with current game settings,
     * if available. Sets player name and creates dice object
     *
     * @param string $name Player name
     */
    public function __construct(string $name)
    {
        $this->dice = new Dice();
        $this->name = $name;
    }

    /**
     * Roll dice and test values
     * Updates roundsum, adds to gamerounds if dice roll is 1
     * Runs js if summed values reach 100
     *
     * @return int result from dice roll
     */
    public function roll()
    {
        $res = $this->dice->roll();
        if ($res == 1) {
            $this->dice->reset();
            $this->gamerounds[] = 0;
        }
        $this->roundsum = array_sum($this->dice->rolls());

        if (array_sum($this->gamerounds) + $this->roundsum >= 100) {
            $this->gamerounds[] = $this->roundsum;
            echo "<script>alert('$this->name won')</script>";
            $res = 100;
        }

        return $res;
    }

    /**
     * Adds roundsum to gameround array
     * Resets roundsum and dice array
     *
     * @return void
     */
    public function stop()
    {
        $this->gamerounds[] = $this->roundsum;
        $this->roundsum = 0;
        $this->dice->reset();
    }
    /**
     * Return player name
     *
     * @return string Player name
     */
    public function name()
    {
        return $this->name;
    }
    /**
     * Reset dice, gamerounds and roundsum
     *
     * @return void
     */
    public function newgame()
    {
        $this->gamerounds = [];
        $this->roundsum = 0;
        $this->dice = new Dice();
    }
    /**
     * Return round values
     *
     * @return array dice rolls in round
     */
    public function roundvalues()
    {
        return $this->dice->rolls();
    }
    /**
     * Return gamerounds values
     *
     * @return array roundsums in game
     */
    public function gamevalues()
    {
        return $this->gamerounds;
    }
    /**
     * Set ai for dice roll decision
     * @param int roundsum to stop at, 12 default
     *
     * @return string Roll or Stop
     */
    public function ai(int $until = 10)
    {
        $message = '';
        switch (true) {
            case ($this->roundsum < $until):
                $message = 'Roll';
                break;
            case ($this->roundsum >= $until):
                $message = 'Stop';
                break;
        }
        return $message;
    }
}
