all: composer-install restore-db install-sqlite3 run-server

composer-install:
	composer install

restore-db:
	cd database && php restore_db.php

install-sqlite3:
	sudo apt install php7.4-sqlite3

run-server:
	php -S localhost:8080 -t public

test:
	@cd tests && php bootstrap.php