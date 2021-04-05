.PHONY: build
build:
	docker-compose build

.PHONY: run
run:
	docker-compose run --rm php bash

.PHONY: test
test:
	docker-compose run --rm php bash -c "vendor/bin/phpunit"

.PHONY: coverage
coverage:
	docker-compose run --rm php bash -c "vendor/bin/phpunit --coverage-html var/coverage"
