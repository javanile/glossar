

install:
	docker-compose run --rm  composer install

tdd:
	docker-compose run --rm phpunit --stop-on-failure --filter ::testCheck
