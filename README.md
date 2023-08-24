# Gentree app with self-written tiny console framework

## Init project

Run

```bash
./init.sh
```

## Tests

### Run tests

```bash
docker-compose exec gentree_php ./vendor/bin/phpunit
```

## Gen tree

```bash
docker-compose exec gentree_php ./bin/console gen-tree /var/www/gentree/tests/data/input.csv /var/www/gentree/output2.json
```
