<?php

namespace Anax\View;

/**
 * Dice game view
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());
?>
<title> <?= $title ?> </title>

<div class="$dicegame">
    <div> <?=$buttons?> </div>

    <div style='width:400px; float:left;'>
        <div style='min-height:130px;  float:left;'> <?=$p1Diceround?> </div>
        <br style='clear:both;'>
        <div style='min-height:130px; float:left;'> <?=$aiDiceround?> </div>
    </div>

    <div style='float:left; margin:0 50px;'> <?=$p1Protocol?> </div>
    <div style='float:left;'> <?=$aiProtocol?> </div>
    <br style='clear:both;'>

<div> <?=$aiScript?> </div>
</div>
