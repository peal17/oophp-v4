<?php

namespace Anax\View;

/**
 * Template file to render a view.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());

?>

<!-- NAVBAR <?php// __FILE__ ?> <br> -->

<navbar>
    <a href="<?= url("") ?>">Hem</a> |
    <a href="<?= url("redovisning") ?>">Redovisning</a> |
    <a href="<?= url("om") ?>">Om</a> |
    <a href="<?= url("lek") ?>">Lek</a> |
    <a href="<?= url("gissa") ?>">Gissa</a> |
    <a href="<?= url("dice100") ?>">Dice100</a> |
    <a href="<?= url("debug") ?>">Debug</a>
</navbar>
