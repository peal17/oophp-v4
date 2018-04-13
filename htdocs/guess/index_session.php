<?php
namespace Peal\Guess;

/**
 * A guess game
 */
include(__DIR__ . '/config.php');
include(__DIR__ . '/../../vendor/autoload.php');

/**
 * Start a session
 */
session_name('Guess');
session_start();



/**
 * Set form results to variables
 */
$guess  = isset($_POST['guess'])  ? htmlentities($_POST['guess'])  : null;
$do     = isset($_POST['do'])     ? htmlentities($_POST['do'])     : null;

/**
 * Create game object
 */
$_SESSION['game'] = isset($_SESSION['game']) ? $_SESSION['game'] : new Guess();
$game = $_SESSION['game'];
$viewRes ='';

/**
 * Perform game actions based on submit type
 */
switch ($do) {
    case 'Make a guess':
        $viewRes = $game->makeGuess($guess, $game->tries());
        break;
    case 'Cheat':
        $viewRes = $game->number();
        break;
    case 'Reset':
        $_SESSION['game'] = new Guess();
        $game = $_SESSION['game'];
        break;
}

/**
 * Present game
 */
include(__DIR__ . '/view/session_guess.php');
