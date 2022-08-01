<?php

namespace tests;

use App\Sudoku;
use App\SudokuException;
use PHPUnit\Framework\TestCase;

class SudokuTest extends TestCase
{
    protected Sudoku $sudoku;

    protected function setUp(): void
    {
        parent::setUp();

        $this->sudoku = new Sudoku();
    }

    /**
     * @return void
     * @throws SudokuException
     */
    public function testInput()
    {
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

        $this->assertEquals($input, $this->sudoku->input($input));
    }

    /**
     * @throws SudokuException
     */
    public function testInputWithEmptyData()
    {
        // Empty input
        $this->expectException(SudokuException::class);
        $this->sudoku->input([]);
    }

    public function testInputWithInvalidData()
    {
        $input = array(
            array(0, 3, 0, 'a', 5, 6, 0, 0, 0),
            array(0, 0, 5, 0, 0, 0, 6, 0, 0),
            array(4, 1, 6, 0, 0, 0, 2, 5, 0),
            array(1, 0, 0, 0, 0, 0, 0, 7, 0),
            array(0, 5, 7, 0, 1, 3, 8, 9, 0),
            array(0, 0, 8, 0, 6, 0, 0, 0, 0),
            array(0, 8, 0, 2, 0, 0, 0, 0, 0),
            array(0, 2, 0, 6, 7, 1, 0, 4, 0),
            array(0, 0, 1, 8, 0, 0, 0, 0, 0)
        );

        // Empty input
        $this->expectException(SudokuException::class);
        $this->sudoku->input($input);
    }

    public function testArrayValueCount()
    {
        $input = array(
            array(0, 3, 0, 0, 5, 6, 0, 0, 0),
            array(0, 0, 5, 0, 0, 0, 6, 0),
            array(4, 1, 6, 0, 0, 0, 2, 5, 0),
            array(1, 0, 0, 0, 0, 0, 0, 7, 0),
            array(0, 5, 7, 0, 1, 3, 8, 9, 0),
            array(0, 0, 8, 0, 6, 0, 0, 0, 0),
            array(0, 8, 0, 2, 0, 0, 0, 0, 0),
            array(0, 2, 0, 6, 7, 1, 0, 4, 0),
            array(0, 0, 1, 8, 0, 0, 0, 0, 0)
        );

        $this->expectException(SudokuException::class);
        $this->sudoku->input($input);
    }

    public function testDuplicateValuesExceptZeros()
    {
        $duplicateInputRow = array(
            array(0, 3, 0, 0, 5, 6, 5, 0, 0),
            array(0, 0, 5, 0, 0, 0, 6, 0, 0),
            array(4, 1, 6, 0, 0, 0, 2, 5, 0),
            array(1, 0, 0, 0, 0, 0, 0, 7, 0),
            array(0, 5, 7, 0, 1, 3, 8, 9, 0),
            array(0, 0, 8, 0, 6, 0, 0, 0, 0),
            array(0, 8, 0, 2, 0, 0, 0, 0, 0),
            array(0, 2, 0, 6, 7, 1, 0, 4, 0),
            array(0, 0, 1, 8, 0, 0, 0, 0, 0)
        );

        $this->sudoku->input($duplicateInputRow);
        $this->expectException(SudokuException::class);
        $this->sudoku->solve();

        $duplicateInputColumn = array(
            array(4, 3, 0, 0, 5, 6, 0, 0, 0),
            array(0, 0, 5, 0, 0, 0, 6, 0, 0),
            array(4, 1, 6, 0, 0, 0, 2, 5, 0),
            array(1, 0, 0, 0, 0, 0, 0, 7, 0),
            array(0, 5, 7, 0, 1, 3, 8, 9, 0),
            array(0, 0, 8, 0, 6, 0, 0, 0, 0),
            array(0, 8, 0, 2, 0, 0, 0, 0, 0),
            array(0, 2, 0, 6, 7, 1, 0, 4, 0),
            array(0, 0, 1, 8, 0, 0, 0, 0, 0)
        );

        $this->sudoku->input($duplicateInputColumn);
        $this->expectException(SudokuException::class);
        $this->sudoku->solve();
    }

    public function testPreSetValuesInOutput(): bool|array
    {
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

        $this->sudoku->input($input);
        $solved = $this->sudoku->solve();

        $this->assertEquals($input[2][1], $solved[2][1]);
        $this->assertEquals($input[8][2], $solved[8][2]);

        return $solved;
    }
}
