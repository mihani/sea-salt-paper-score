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
	$(DC) down
	$(DC) up -d --remove-orphans --build

	$(RUN-PHP) composer install
	#$(RUN-NODE) sh -c "npm install && npm run build"
	$(MAKE) init-git-hook

init-git-hook:	## Installe les git-hook
	./tools/install/init-git-hook.sh
npm-install:	## Lance un npm install
	$(RUN-NODE) npm install
npm-build:	## Lance un npm run build
	$(RUN-NODE) npm run build
npm-watch:	## Lance un npm run watch
	$(RUN-NODE) npm run watch
npm-install-build: npm-install npm-build	## Lance un npm-install suivi d'un npm-build

##Containers :
php:		## Se connecte au container php
	$(EXEC-PHP) bash

php-root:	## Se connecte au container php en root
	$(EXEC-PHP-ROOT) bash

##Quality :
all-quality: php-cs-fixer psalm	## Lance php-cs-fixer et psalm

php-cs-fixer:	## Lance php-cs-fixer
	$(RUN-PHP-NO-TTY) tools/php-cs-fixer/vendor/bin/php-cs-fixer fix --verbose --show-progress=none --config=.php-cs-fixer.dist.php

psalm:	## Lance psalm
	$(RUN-PHP-NO-TTY) ./tools/psalm/psalm.phar --no-cache

##HELP
help:                                                        ## show the help
	@grep -E '(^[0-9a-zA-Z_-]+:.*?##.*$$)|(^##)' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[32m%-30s\033[0m %s\n", $$1, $$2}' | sed -e 's/\[32m##/[33m/'
.DEFAULT_GOAL := help
