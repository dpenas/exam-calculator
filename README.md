## Getting Started

Start the Docker container:

```bash
docker-compose up -d
```

Enter the PHP container:

```bash
docker exec -it exam-calculator-app-1 bash
```

Install the project dependencies:

```bash
composer install
```

## Running the Analysis

Run the following command to analyse the provided Excel file:

```bash
php bin/paragin_analyse.php data/exam_results.xlsx
```

After the command finishes, the generated report can be found in the `output/` directory.

## Running the Tests

Execute the PHPUnit test suite with:

```bash
php vendor/bin/phpunit tests
```
