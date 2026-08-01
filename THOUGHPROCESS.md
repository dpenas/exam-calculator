- What kind of libraries/frameworks do I need?
    - I thought about using something like Laravel (already includes a console, test framework...), but it seems too heavy for this, since I wouldn't need most of it. I will keep it simple without a framework.
    - These libraries can help in the beginning:
        - For the Excel file: https://github.com/PHPOffice/PhpSpreadsheet 
        - PHPUnit for testing
        - php-cs-fixer for code standards
        - This library has the PCC formula: https://github.com/markrogoyski/math-php, it seems active and there could be other useful functions. PHP includes stats_stat_correlation, but some people in the comments complained about getting errors. Might consider it (or just make the formula myself).
- Main Structure
    - I want to keep it simple. I will have a main function that will receive the input (the excel file), another class that will parse it (allowing other future implementations that are not excel), another ones that will deal with the logic of the formulas and some domain classes that will help keep things clean (on top of tests, docker stuff, etc.)

- Assumptions
    - I interpolated the grade that someone gets if they fall in between two of the percentages. I basically calculated it as a straight line.

- Improvements
    - I created a ParaginExcelParser directly in the ParaginExamReader. This should be in a construct or passed using DI.
    - Extra logs and sanitization (in cases the data might not be there correctly, which could cause issues).
    - I have repeated some logic in the tests. Might be nice having it somewhere else to avoid repeated code.