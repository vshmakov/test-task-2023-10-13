# Test task

[Task description](https://github.com/vshmakov/test-task-2023-10-13/blob/master/docs/task.md)

Docker environment is configured with [dunglas/symfony-docker](https://github.com/dunglas/symfony-docker)

## Run the project

1. Run `docker compose build --no-cache` to build fresh images
2. Run `docker compose up --pull -d --wait` to start the project
3. Use `docker compose exec php sh -c 'bin/console doctrine:migrations:migrate -n'` to run migrations
4. Run `docker compose exec php sh -c 'bin/console doctrine:fixtures:load -n'` to load fixtures
5. Run `docker compose down --remove-orphans` to stop the Docker containers.

## Additional commands

1. Use `docker compose exec php sh -c 'bin/phpunit'` to run tests
2. Use `docker compose exec php sh -c 'vendor/bin/phpstan'` to run static analysis
3. Run `docker compose exec php sh -c 'vendor/bin/php-cs-fixer fix --allow-risky=yes'` to style code

## Test endpoints

See curl commands at [/docs/curl](https://github.com/vshmakov/test-task-2023-10-13/blob/master/docs/curl)
