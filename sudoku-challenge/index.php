<?php

require 'vendor/autoload.php';

// test input
$input = array(
    array(0, 3, 0, 0, 5, 6, 0, 0, 0),
    array(0, 0, 5, 0, 0, 0, 6, 0, 0),
    array(4, 1, 6, 0, 0, 0, 2, 5, 0),
    array(1, 0, 0, 0, 0, 0, 0, 7, 0),
    array(0, 5, 7, 0, 1, 3, 8, 9, 0),
    array(0, 0, 8, 0, 6, 0, 0, 0, 0),
    array(0, 8, 0, 2, 0, 0, 0, 0, 0),
    array(0, 2, 0, 6, 7, 1, 0, 4, 0),
    array(0, 0, 1, 8, 0, 0, 0, 0, 0)
);
// create instance of Sudoku class
$sudoku = new \App\Sudoku();

// provide input
try {
    $sudoku->input($input);
} catch (Exception $e) {
    echo $e->getMessage();
    die();
}

// Solve the puzzle
try {
    $solvedSudoku = $sudoku->solve();
} catch (Exception $e) {
    echo $e->getMessage();
    die();
}

// visualise the Input
echo 'INPUT Matrix:';
echo $sudoku->generateHTML($input);

echo '<br/>';

// visualise the output
echo 'OUTPUT Matrix:';
echo $sudoku->generateHTML($solvedSudoku);



