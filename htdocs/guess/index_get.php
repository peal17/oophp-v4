<?php
namespace Peal\Guess;

/**
 * A guess game
 */
include(__DIR__ . '/config.php');
include(__DIR__ . '/../../vendor/autoload.php');

/**
 * Set form results to variables
 */
$number = isset($_GET['number']) ? htmlentities($_GET['number']) : -1;
$tries  = isset($_GET['tries'])  ? htmlentities($_GET['tries'])  : 6;
$guess  = isset($_GET['guess'])  ? htmlentities($_GET['guess'])  : null;
$do     = isset($_GET['do'])     ? htmlentities($_GET['do'])     : null;

/**
 * Create game object
 */
$game = new Guess($number, $tries);
$viewRes ='';

/**
 * Perform game actions based on submit type
 */
switch ($do) {
    case 'Make a guess':
        $viewRes = $game->makeGuess($guess, $tries);
        break;
    case 'Cheat':
        $viewRes = $game->number();
        break;
    case 'Reset':
        $game = new Guess();
        break;
}

/**
 * Present game
 */
include(__DIR__ . '/view/get_guess.php');
