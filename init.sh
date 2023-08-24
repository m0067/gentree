#!/usr/bin/env bash

docker-compose up -d
docker-compose exec gentree_php composer install
