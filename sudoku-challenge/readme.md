## Sudoku Puzzle
### Task
1. Please write modern standard PHP code that checks if the completed Sudoku (right picture) is solved correctly.

I have created Sudoku code solver program. This will solve the Sudoku. I have added Test cases in PHPUnit to test the solved Sudoku is valid or not.

Not only the Output also, Input also test for valid input.

    ./vendor/bin/phpunit tests/

### Think of a good data structure
I have preferred Multi Array for storing the data.

### Thought process
If you observe the PHPUnit test script. I have followed the general rules only. Tied to apply those in PHP.
1. Each row & column should have 9 numeric values. Strictly Numerics. Checked in **testArrayValueCount** & **testInputWithInvalidData** & **testInputWithEmptyData**
2. There are some preset values. So, I need to cross-check position and values should persist and do not touch those during the possibilities finding. Checked in **testPreSetValuesInOutput**
3. No duplicates in rows and columns. Empty places are filled with zeros. While validating this condition ignored zeros.  Checked Input & output for duplicates. Checked in **testDuplicatesInSudokuRowsAndColumns** & **testDuplicateValuesExceptZerosInInput**
4. After rows & Columns are validated, final test for Grids level check. There are 9 grids (3X3). All these need to be validated for duplicate values in grid. This is accomplished in **testGridsHasDuplicatesOrNot**

### timeline taken
To Solve the Sudoku, it took 12 Hours. To validate the Sudoku output, it took 4 Hours.
