<?php

namespace App;

use App\SudokuException;

class Sudoku
{

    /**
     *  Row / Column count
     */
    const MAX_COUNT = 9;

    /**
     * Input variable
     * @var array|mixed
     */
    protected ?array $input = [];

    /**
     * FInal solve Sudoku matrix
     * @var array
     */
    public array $solvedSudoku = [];


    /**
     * Input Method
     *
     * Explicitly assign a new input array. If It's not already loaded in
     * the constructor. If already provided in the constructor then
     * it will be replaced
     *
     * @param array $input
     * @return array|mixed|null
     * @throws SudokuException
     */
    public function input(array $input): mixed
    {
        if (!$input) {
            throw new SudokuException("Input cannot be empty");
        }

        if (!$this->validateInput($input)) {
            throw new SudokuException("Input has invalid values");
        }

        $this->input = $input;
        return $this->input;
    }

    /**
     * Check the input has numerics only and each row has 9 values
     * @param array $input
     * @return bool
     */
    private function validateInput(array $input): bool
    {
        if (!$input) {
            return false;
        }

        foreach ($input as $row) {
            if (!$this->checkRowCount($row)) {
                return false;
            }

            foreach ($row as $value) {
                if (!is_numeric($value)) {
                    return false;
                }
            }
        }
        return true;
    }

    /**
     * Check row has 9 values or not
     * @param array $row
     * @return bool
     */
    private function checkRowCount(array $row): bool
    {
        return count($row) === self::MAX_COUNT;
    }

    /**
     * Solve sudoku puzzle
     * @return bool|array $solvedSudoku
     * @throws SudokuException
     */
    public function solve(): bool|array
    {
        $this->solvedSudoku = $this->solveSudoku($this->input);
        return $this->solvedSudoku;
    }

    /**
     * Sudoku solver by row
     * @param $matrix
     * @return false|mixed|void
     * @throws SudokuException
     */
    private function solveSudoku($matrix)
    {
        if (!$matrix) {
            throw new SudokuException("Input cannot be empty");
        }

        while (true) {
            $options = array();
            foreach ($matrix as $rowIndex => $row) {
                if ($this->checkDuplicatesInArray($row)) {
                    throw new SudokuException("Row: $rowIndex has duplicates");
                }
                foreach ($row as $columnIndex => $cell) {
                    if (!empty($cell)) {
                        continue;
                    }
                    $possibilities = $this->getPossibleValues($matrix, $rowIndex, $columnIndex);
                    if (count($possibilities) == 0) {
                        return false;
                    }
                    $options[] = array(
                        'rowIndex' => $rowIndex,
                        'columnIndex' => $columnIndex,
                        'possibilities' => $possibilities
                    );
                }
            }
            if (count($options) == 0) {
                return $matrix;
            }
            // sort values to get most eligible value on top
            usort($options, array($this, 'sortByPossibilities'));
            if (count($options[0]['possibilities']) == 1) {
                $matrix[$options[0]['rowIndex']][$options[0]['columnIndex']] = current($options[0]['possibilities']);
                continue;
            }

            // if no single choose then choose second value with first suggestion
            foreach ($options[0]['possibilities'] as $value) {
                $tmp = $matrix;
                $tmp[$options[0]['rowIndex']][$options[0]['columnIndex']] = $value;
                if ($result = $this->solveSudoku($tmp)) {
                    return $result;
                }
            }
            return false;
        }
    }

    /**
     * Check Duplicate values in an array
     * @param array $array
     * @return bool
     */
    private function checkDuplicatesInArray(array $array): bool
    {
        if (!$array) {
            return false;
        }

        $array = array_filter($array);
        return count($array) !== count(array_unique($array));
    }

    /**
     * Get possible values for the row
     * @throws SudokuException
     */
    private function getPossibleValues($matrix, $rowIndex, $columnIndex): array
    {
        $valid = range(1, 9);
        $invalid = $matrix[$rowIndex];
        $column = [];
        for ($i = 0; $i < 9; $i++) {
            $column[] = $matrix[$i][$columnIndex];
            $invalid[] = $matrix[$i][$columnIndex];
        }

        if ($this->checkDuplicatesInArray($column)) {
            throw new SudokuException("Column: $columnIndex  has duplicates");
        }

        $box_row = $rowIndex % 3 == 0 ? $rowIndex : $rowIndex - $rowIndex % 3;
        $box_col = $columnIndex % 3 == 0 ? $columnIndex : $columnIndex - $columnIndex % 3;

        $invalid = array_unique(
            array_merge(
                $invalid,
                array_slice($matrix[$box_row], $box_col, 3),
                array_slice($matrix[$box_row + 1], $box_col, 3),
                array_slice($matrix[$box_row + 2], $box_col, 3)
            )
        );

        $valid = array_diff($valid, $invalid);
        shuffle($valid);
        return $valid;
    }

    /**
     * Sort possibilities with the array count
     * @param $optionA
     * @param $optionB
     * @return int
     */
    private function sortByPossibilities($optionA, $optionB): int
    {
        $optionA = count($optionA['possibilities']);
        $optionB = count($optionB['possibilities']);
        if ($optionA == $optionB) {
            return 0;
        }
        return ($optionA < $optionB) ? -1 : 1;
    }

    /**
     * Generate HTML to view the sudoku matrix
     * @param array $array
     * @return string
     */
    public function generateHTML(array $array): string
    {
        $html = '<table border="1" id="table-id"><tbody>';
        for ($row = 0; $row < 9; $row++) {
            $html .= '<tr>';
            for ($column = 0; $column < 9; $column++) {
                $html .= '<td>' . $array[$row][$column] . '</td>';
            }
            $html .= '</tr>';
        }
        $html .= '</tbody></table>';

        return $html;
    }

}
