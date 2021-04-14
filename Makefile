.PHONY: build
build:
	docker build -t tinkoff-invest-api .

.PHONY: bash
bash:
	docker run --rm -it --volume=${PWD}:/app --workdir=/app tinkoff-invest-api bash

.PHONY: test
test:
	docker run --rm -it --volume=${PWD}:/app --workdir=/app tinkoff-invest-api bash -c "vendor/bin/phpunit"

.PHONY: coverage
coverage:
	docker run --rm -it --volume=${PWD}:/app --workdir=/app tinkoff-invest-api bash -c "vendor/bin/phpunit --coverage-html var/coverage"
