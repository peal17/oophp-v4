<?php
namespace Peal\Guess;

/**
 * Guess my number, a class supporting the game through GET, POST and SESSION.
 */
class Guess
{
    /**
     * @var int $number   The current secret number.
     * @var int $tries    Number of tries a guess has been made.
     */
    private $number;
    private $tries;

    /**
     * Constructor to initiate the object with current game settings,
     * if available. Randomize the current number if no value is sent in.
     *
     * @param int $number The current secret number, default -1 to initiate
     *                    the number from start.
     * @param int $tries  Number of tries a guess has been made,
     *                    default 6.
     */
    public function __construct(int $number = -1, int $tries = 6)
    {
        if ($number == -1) {
            $number = rand(1, 100);
        }
        $this->number = $number;
        $this->tries = $tries;
    }


    /**
     * Randomize the secret number between 1 and 100 to initiate a new game.
     *
     * @return void
     */

    public function random()
    {
        $this->number = rand(1, 100);
    }


    /**
     * Get number of tries left.
     *
     * @return int as number of tries remaining.
     */

    public function tries()
    {
        return $this->tries;
    }


    /**
     * Get the secret number.
     *
     * @return int as the secret number.
     */
    public function number()
    {
        return $this->number;
    }


    /**
     * Make a guess, decrease remaining guesses and return a string stating
     * if the guess was correct, too low or to high or if no guesses remains.
     *
     * @throws GuessException when guessed number is out of bounds
     *
     * @return string to show the status of the guess made.
     */
    public function makeGuess(int $number, string $tries)
    {
        $retstring = '';
        switch (true) {
            case (!isset($number)):
            case ($number < 0 ):
            case ($number > 100):
                throw new GuessException('Your guess was out of bounds (0-100)');
                break;
            case ($number == $this->number):
                $retstring = "Your guess was right! The number was {$this->number}.";
                break;
            case ($number > $this->number):
                $this->tries = $tries - 1;
                $retstring = 'The guess was to high.';
                break;
            case ($number < $this->number):
                $this->tries = $tries - 1;
                $retstring = 'The guess was to low.';
                break;
        }
        if ($this->tries < 1) {
            $this->tries = 0;
            $retstring = "Game over, the number was {$this->number}.";
        }
        return $retstring;
    }

    /**
     * Prints htmlform for guessing
     *
     * @param string    $method    form method to use, uses session if null
     * @param bool      $session    form method to use, uses session if null
     *
     * @return void
     */
    public function viewForm(string $method, bool $session = false)
    {
        $hidden = "<input type='hidden' name='number' value='{$this->number}'>"
                . "<input type='hidden' name='tries' value='{$this->tries}'>";
        if ($session == true) {
            $hidden = '';
        }
        $form = "<form id='guessform' method='{$method}'>"
            . $hidden
            . "<input type='text' name='guess'>"
            . "<input type='submit' name='do' value='Make a guess'>"
            . "<input type='submit' name='do' value='Cheat'>"
            . "<br><input type='submit' name='do' value='Reset'>"
            . "</form>";

        return $form;
    }

    /**
     * Prints a htmlhead
     *
     * @param string $title game title
     *
     * @return void
     */
    public function viewHead(string $title)
    {
        echo "<!doctype html>"
            . "<meta charset='utf-8'>"
            . "<title>{$title}</title>";
    }

    /**
     * Prints info
     *
     * @param string $title game title
     *
     * @return void
     */
    public function viewInfo(string $title)
    {
        $text = "<h1 class='guessinfo'>{$title}</h1>"
            . "<p class='guessinfo'>Guess a number between 1 and 100, you have {$this->tries} tries left";
        return $text;
    }
}
