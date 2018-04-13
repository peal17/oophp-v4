<?php
/**
 * View page for gu
 */
include(__DIR__ . '/functions.php');
/**
 * Print htmlhead
 */
$game->viewHead('Guess game (SESSION)');

/**
 * Print game elements
 */
tt('div class="guess"');
echo $game->viewInfo('Guess game (SESSION)');
echo $game->viewForm('POST', true);
tt('p', $viewRes);
tt('/div');
