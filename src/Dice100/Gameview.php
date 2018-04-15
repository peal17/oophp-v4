<?php
namespace Peal\Dice100;

/**
 * A class for dicegame elements
 */
class Gameview
{


    /**
     * Return html code for displaying dice round and player name
     *
     * @param array $roundvalues from dice round
     * @param int   $rollRes     rolled dice
     * @param string $name       player name
     * @param int   $turn        for deciding player to display
     * @param int $player      player turn value
     *
     * @return string html elements
     */
    public function round(array $roundvalues, int $rollRes, string $name, int $turn, int $player)
    {
        $dice = '';
        $playing = '';
        if ($turn == $player) {
            $playing = '||';
        }
        if ($rollRes != 0) {
            $dice = " <i class='dice-sprite dice-$rollRes'></i>";
        }

        $text = "<h1 class='round'>$name $playing "
            . $dice
            . "</h1><p>";

        foreach ($roundvalues as $r) {
            $text .= "<i class='dice-sprite dice-$r'></i>";
        }

        return $text . '</p>';
    }

    /**
     * Return html code for displaying game protocol
     *
     * @param array $gamevalues Stored round values
     * @param string $name Player name
     *
     * @return string html elements
     */
    public function protocol(array $gamevalues, string $name)
    {
        $text = "<h3 class='protocol'>{$name}: ". array_sum($gamevalues) ."</h3>";
        foreach ($gamevalues as $g) {
            $text .= "<p class='protocol'>$g</p>";
        }
        return $text;
    }

    /**
     * Returns html form buttons
     *
     * @param int    $player    player integer, 0 for ai
     *
     * @return string html form
     */
    public function buttons($player)
    {
        $disabled = '';
        if ($player == 0) {
            $disabled = 'disabled';
        }
        $form = "<form id='rollform' method='POST'>"
            . "<input type='submit' name='do' value='New game' {$disabled}><br><br><br><br>"
            . "<input type='submit' name='do' value='Roll' {$disabled}>"
            . "<input type='submit' name='do' value='Stop' {$disabled}>"
            . "</form>";

        return $form;
    }

    /**
     * Returns html javascript for ai refresh page
     *
     * @param int    $time    milliseconds to wait
     * @param int    $turn    turn integer, 0 for ai
     *
     * @return string html form
     */
    public function refresh($time, $turn)
    {
        $form = '';
        if ($turn == 0) {
            $form = "<script>setTimeout(function(){window.location.assign('./start')}, $time ); </script>";
        }
        return $form;
    }
}
