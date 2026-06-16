# Local tooling — ephemeral standard images only, no build, no custom Dockerfile.
# PHP tooling/tests run on a PINNED php:8.1-cli (NOT the latest the composer image ships).
# composer install runs in the official composer image; dependency resolution is
# governed by config.platform.php (8.1.0) in composer.json, so it stays consistent.
PHP_IMAGE      ?= php:8.1-cli
COMPOSER_IMAGE ?= composer:2

RUN_OPTS := --rm -v "$(CURDIR)":/app -w /app -u $$(id -u):$$(id -g)
PHP      := docker run $(RUN_OPTS) $(PHP_IMAGE)
COMPOSER := docker run $(RUN_OPTS) -e COMPOSER_HOME=/tmp/composer $(COMPOSER_IMAGE)

.PHONY: help install rector rector-fix cs cs-fix lint test shell

help: ## Show this help
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | \
		awk 'BEGIN {FS = ":.*?## "}; {printf "  \033[36m%-12s\033[0m %s\n", $$1, $$2}'

install: ## composer install (ephemeral composer image)
	$(COMPOSER) composer install

rector: ## Rector dry-run (report only, changes nothing)
	$(PHP) vendor/bin/rector process --dry-run

rector-fix: ## Apply Rector changes
	$(PHP) vendor/bin/rector process

cs: ## PHP-CS-Fixer dry-run with diff (changes nothing)
	$(PHP) vendor/bin/php-cs-fixer fix --dry-run --diff

cs-fix: ## Apply PHP-CS-Fixer changes
	$(PHP) vendor/bin/php-cs-fixer fix

lint: cs rector ## Run both checks in dry-run mode

test: ## Run PHPUnit
	$(PHP) vendor/bin/phpunit

shell: ## Open a shell in the PHP container
	$(PHP) bash
