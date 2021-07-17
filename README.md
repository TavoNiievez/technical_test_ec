# Start local environment
```sh
docker-compose up --build
```

# Tests
## Unit
```
docker exec -w /app -it technical_test_ec_php ./bin/phpunit --testsuite Unit
```

## Coverage
### Unit
```
docker exec -w /app -it technical_test_ec_php ./bin/phpunit --testsuite Unit --coverage-html coverage
```
### Functional
Coverage report generated at `app/codeception/_output/coverage/index.html`

```
docker exec -w /app -it technical_test_ec_php sh -c "./vendor/bin/codecept build && ./vendor/bin/codecept run --coverage-html"
```