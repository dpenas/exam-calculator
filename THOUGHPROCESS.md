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
    - Looking at implementing the Pearson correlation coefficient, I'll assume that if the denominator is 0, we'll also return 0, since one of the most logical explanations is that all students gave the same answer and therefore there is not difference at all. This should already raise some flags about the question with the p-value.
    - I'm also assuming that for the PCC value, we'll use 2 decimals and that we'll not exclude the question itself when we are calculating its PCC (in a real case scenario, it's something I would ask before implementing it, as I put in the refinement document).

- Decisions
    - I decided to implement the PCC formula directly (using Wikipedia and AI) instead of using the math-php package. The main reason is that the formula itself is only a few lines of code and in this assignment I won't use anything else from that package. I don't like reinventing the wheel, but adding extra packages for just a few lines of code can lead to other issues in the future: the package might have CVEs (forcing us to update it during a bad time), the package might become deprecated, future versions of PHP might not work with this package for a while, etc. If other functions were used from it, I would definitely consider using it.

- Improvements
    - I created a ParaginExcelParser directly in the ParaginExamReader. This should be in a construct or passed using DI.
    - Extra logs and sanitization (in cases the data might not be there correctly, which could cause issues).
    - I have repeated some logic in the tests. Might be nice having it somewhere else to avoid repeated code.