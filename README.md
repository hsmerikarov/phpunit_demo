# First attempts for PHP Unit tests

To run tests properly few dependencies have to be resolved:
- [x] ```php``` should be installed on the machine
- [x] ```composer``` is needed to bootstrap the project and install dependecies - using ```composer install``` and ```composer update``` will download and install all needed phpunit dependencies
- [x] ```composer.phar``` should be added to project's path

command ```vendor/bin/phpunit tests``` will execute unit tests

Further development should include
* Enchance Data Provider logic - use external source - csv,xml,json or db
* Implement negative test cases
