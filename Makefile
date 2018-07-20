install:
	composer install
test:
	composer run-script phpunit
run:
	./bin/run
lint:
	composer run-script phpcs -- --standard=PSR2 src bin
