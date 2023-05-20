DC=docker compose
EXEC=$(DC) exec
RUN-PHP-NO-TTY=$(DC) run --rm -T php
EXEC-PHP=$(EXEC) --user=1000 php
EXEC-PHP-ROOT=$(EXEC) php
RUN-PHP=$(DC) run --rm php
RUN-NODE=$(DC) run --rm node

##Install :
install:
	cp -n .env .env.local
	cp -n docker.env docker.env.local
	cp -n docker/data/history.dist docker/data/history

	$(MAKE) --no-print-directory reset
	$(MAKE) --no-print-directory install-quality
	$(MAKE) --no-print-directory init-git-hook

reset:
	$(DC) down
	$(DC) up -d --remove-orphans --build
	$(RUN-PHP) composer install
	$(RUN-NODE) sh -c "npm install && npm run build"

init-git-hook:	## Installe les git-hook
	./tools/install/init-git-hook.sh

install-quality: ## Install quality tools
	$(RUN-PHP) composer install --working-dir=tools

npm-install:	## Lance un npm install
	$(RUN-NODE) npm install

npm-build:	## Lance un npm run build
	$(RUN-NODE) npm run build

npm-watch:	## Lance un npm run watch
	$(RUN-NODE) npm run watch

npm-install-build: npm-install npm-build	## Lance un npm-install suivi d'un npm-build

##Containers :
php:		## Se connecte au container php
	$(RUN-PHP) bash

php-root:	## Se connecte au container php en root
	$(EXEC-PHP-ROOT) bash

##Quality :
all-quality: php-cs-fixer psalm	## Lance php-cs-fixer et psalm

php-cs-fixer:	## Lance php-cs-fixer
	$(RUN-PHP-NO-TTY) ./tools/vendor/bin/php-cs-fixer fix --config=php-cs-fixer-config.php --verbose --show-progress=none

psalm:	## Lance psalm
	$(RUN-PHP-NO-TTY) ./tools/vendor/bin/psalm --no-cache --show-info=true

phpstan:	## Lance psalm
	$(RUN-PHP-NO-TTY) ./tools/vendor/bin/phpstan --memory-limit=1G --configuration=phpstan.neon.dist

phpunit: ## Run phpunit
	$(RUN-PHP) ./vendor/bin/phpunit

##HELP
help:                                                        ## show the help
	@grep -E '(^[0-9a-zA-Z_-]+:.*?##.*$$)|(^##)' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[32m%-30s\033[0m %s\n", $$1, $$2}' | sed -e 's/\[32m##/[33m/'
.DEFAULT_GOAL := help
