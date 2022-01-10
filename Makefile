DOCKER_COMPOSE_RUN_APP=docker-compose run --rm

.PHONY: require require-dev update-42
vendor: ## composer install
	$(DOCKER_RUN_ONCE_MAC_WITH_SSH_AGENT) composer install

require: ## composer require
	$(DOCKER_RUN_ONCE_MAC_WITH_SSH_AGENT) composer require $(package)

require-dev: ## composer require --dev
	$(DOCKER_RUN_ONCE_MAC_WITH_SSH_AGENT) composer require $(package) --dev

.PHONY: shell
shell: ##spawns shell in container
	$(DOCKER_COMPOSE_RUN) app bash

.PHONY: run
run: ## start application
	$(DOCKER_COMPOSE_RUN) app ./vendor/bin/bref local --handler=index.php --file=event.json

.PHONY: psalm
psalm:
	$(DOCKER_COMPOSE_RUN) app ./vendor/bin/psalm

.PHONY: coverage
coverage:
	$(DOCKER_COMPOSE_RUN) coverage php -dpcov.enabled=1 -dpcov.directory=.  -dpcov.exclude="~vendor~" ./vendor/bin/phpunit --coverage-html ./var/coverageReport

.PHONY: test
test: ## Runs all tests
	$(DOCKER_COMPOSE_RUN) app ./vendor/bin/phpunit
