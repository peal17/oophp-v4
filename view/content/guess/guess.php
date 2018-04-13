<?php

namespace Anax\View;

/**
 * Guess game view
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());
?>

<title> <?= $title ?> </title>


<div class="$guessgame">

    <div> <?=$info?> </div>
    <div> <?=$gameform?> </div>
    <p> <?=$viewRes?> </p>

</div>
