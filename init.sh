#!/usr/bin/env bash

docker-compose up -d
docker-compose exec optimacros_php composer install
