# Makefile
lint:
	composer run-script phpcs -- --standard=PSR12 src bin

test:
	php tests/DifferTest.php
