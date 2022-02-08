.PHONY: pg dump import
include .env

PG_CONTAINER_NAME = ${PROJECT_NAME}-postgre
PHP_CONTAINER_NAME = ${PROJECT_NAME}-php
NGINX_CONTAINER_NAME = ${PROJECT_NAME}-nginx
DB_NAME = ${DB_DATABASE}
PG_USER = root
PG_PASS = root

EXEC_PG = docker exec -it $(PG_CONTAINER_NAME) bash
EXEC_PHP = docker exec -it $(PHP_CONTAINER_NAME) bash
EXEC_NGINX = docker exec -it $(NGINX_CONTAINER_NAME) bash

pg_container:
	$(EXEC_PG)

dump:
	pg_dump $(DB_NAME) > dump/new_dump.sql

import:
	psql $(DB_NAME) < dump/new_dump.sql

php_container:
	$(EXEC_PHP)

nginx_container:
	$(EXEC_NGINX)
