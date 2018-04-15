<?php
/**
 * Dice game 100 route.
 */
$app->router->any(['POST', 'GET'], "dice/start", function () use ($app) {

    /**
     * Start a session
     */
    session_name('Dice100');
    session_start();

    /**
     * Recieve posted game actions
     */
    $do = isset($_POST['do']) ? htmlentities($_POST['do']) : null;

    /**
     * Create/recieve players
     */
    $_SESSION['PLAYERp1'] = isset($_SESSION['PLAYERp1']) ? $_SESSION['PLAYERp1'] : new Peal\Dice100\Diceplayer('You');
    $PLAYERp1 = $_SESSION['PLAYERp1'];
    $_SESSION['PLAYERai'] = isset($_SESSION['PLAYERai']) ? $_SESSION['PLAYERai'] : new Peal\Dice100\Diceplayer('Ai');
    $PLAYERai = $_SESSION['PLAYERai'];

    /**
     * Create/recieve sessioned turn variable
     */
    $_SESSION['turn'] = isset($_SESSION['turn']) ? $_SESSION['turn'] : 1;
    $turn = $_SESSION['turn'];

    /**
     * Set current diceroll to 0
     */
    $rollP1 = 0;
    $rollAi = 0;

    /**
     * Game actions based on turn and form submit
     */
    if ($turn == 1) {
        switch ($do) {
            /**
             * Player1 cases
             */
            case 'Roll':
                $rollP1 = $PLAYERp1->roll();
                if ($rollP1 == 1) {
                    $_SESSION['turn'] = 0;
                    $turn = $_SESSION['turn'];
                } elseif ($rollP1 == 100) {
                    $_SESSION['PLAYERp1'] = $PLAYERp1->newgame();
                    $_SESSION['PLAYERai'] = $PLAYERai->newgame();
                    $_SESSION['turn'] = 1;
                    $turn = $_SESSION['turn'];
                    $rollP1 = 0;
                }
                break;
            case 'Stop':
                $PLAYERp1->stop();
                $_SESSION['turn'] = 0;
                $turn = $_SESSION['turn'];
                break;
            case 'New game':
                $_SESSION['PLAYERp1'] = $PLAYERp1->newgame();
                $_SESSION['PLAYERai'] = $PLAYERai->newgame();
                $_SESSION['turn'] = 1;
                $turn = $_SESSION['turn'];
                break;
        }
    } elseif ($turn == 0) {
        /**
         * Extend Ais intelligens
         */
        if (array_sum($PLAYERp1->gamevalues()) > array_sum($PLAYERai->gamevalues())
            && array_sum($PLAYERp1->gamevalues()) > 92
        ) {
            $aiadd = 100;
        } else {
            $aiadd = 9;
        }

        /**
         * Ai cases
         */
        switch ($PLAYERai->ai($aiadd)) {
            case 'Roll':
                $rollAi = $PLAYERai->roll();
                if ($rollAi == 1) {
                    $_SESSION['turn'] = 1;
                    $turn = $_SESSION['turn'];
                } elseif ($rollAi == 100) {
                    $_SESSION['PLAYERp1'] = $PLAYERp1->newgame();
                    $_SESSION['PLAYERai'] = $PLAYERai->newgame();
                    $_SESSION['turn'] = 1;
                    $turn = $_SESSION['turn'];
                    $rollAi = 0;
                }
                break;
            case 'Stop':
                $PLAYERai->stop();
                $_SESSION['turn'] = 1;
                $turn = $_SESSION['turn'];
                break;
        }
    }

    /**
     * Set view elements with Gameview object
     */
    $elem = new Peal\Dice100\Gameview();

    $data = [
        'title' => 'Dice 100',
        'buttons' => $elem->buttons($turn),
        'p1Protocol' => $elem->protocol($PLAYERp1->gamevalues(), $PLAYERp1->name()),
        'aiProtocol' => $elem->protocol($PLAYERai->gamevalues(), $PLAYERai->name()),
        'p1Diceround' => $elem->round($PLAYERp1->roundvalues(), $rollP1, $PLAYERp1->name(), $turn, 1),
        'aiDiceround' => $elem->round($PLAYERai->roundvalues(), $rollAi, $PLAYERai->name(), $turn, 0),
        'aiScript' => $elem->refresh(1000, $turn),
    ];

    /**
     * Render view
     */
    $app->view->add("content/dice100/game", $data);
    $app->page->render($data);


});
