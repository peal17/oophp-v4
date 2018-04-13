<?php
/**
 * View page for guess game
 */
include(__DIR__ . '/functions.php');
/**
 * Print htmlhead
 */
$game->viewHead('Guess game (GET)');

/**
 * Print game elements
 */
tt('div class="guess"');
echo $game->viewInfo('Guess game (GET)');
echo $game->viewForm('GET');
tt('p', $viewRes);
tt('/div');
