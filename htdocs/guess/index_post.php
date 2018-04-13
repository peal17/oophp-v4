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
$number = isset($_POST['number']) ? htmlentities($_POST['number']) : -1;
$tries  = isset($_POST['tries'])  ? htmlentities($_POST['tries'])  : 6;
$guess  = isset($_POST['guess'])  ? htmlentities($_POST['guess'])  : null;
$do     = isset($_POST['do'])     ? htmlentities($_POST['do'])     : null;

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
include(__DIR__ . '/view/post_guess.php');
