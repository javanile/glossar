

install:
	docker-compose run --rm -u $$(id -u) composer install

update:
	docker-compose run --rm -u $$(id -u) composer update

tdd:
	docker-compose run --rm phpunit --stop-on-failure --filter ::testCheck
