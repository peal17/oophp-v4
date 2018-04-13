<?php
/**
 * View page for gu
 */
include(__DIR__ . '/functions.php');
/**
 * Print htmlhead
 */
$game->viewHead('Guess game (POST)');

/**
 * Print game elements
 */
tt('div class="guess"');
echo $game->viewInfo('Guess game (POST)');
echo $game->viewForm('POST');
tt('p', $viewRes);
tt('/div');
